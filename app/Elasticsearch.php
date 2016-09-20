<?php

namespace App;

//use Illuminate\Database\Eloquent\Model;

class Elasticsearch
{
	public $es_client;
	public $index_business;
	public $index_categories;
	public $type;
	public $server;
	public $server_port;
	public $per_page = 20;
	public $no_result_attempt = 0;

	/**
	 * Construct
	 */
	public function __construct()
    {
        $this->server = config('app.elasticsearch_url');
        $this->server_port = config('app.elasticsearch_port');
        $this->index_business = config('app.elasticsearch_business_index');
        $this->index_categories = config('app.elasticsearch_categories_index');
    }

    
     /**
	 * The search function
	 */
	public function search($data, $page = 1, $for_aggs = false) {

		$sort = "distance"; // Default
		$view_type = "default";

		if(isset($data['page']) && is_numeric($data['page'])){
			$page = (($data['page'] > 1) ? $data['page'] : 1);
		}
		if(isset($data['items_per_page']) && is_numeric($data['items_per_page'])){
			// Sets user defined - number of items per page
			$this->per_page = $data['items_per_page'];
			if($this->per_page < 20){ $this->per_page = 20; }
			if($this->per_page > 200){ $this->per_page = 200; }
		}
		if(isset($data['sort']) && in_array($data['sort'], array('distance', 'name', 'rating'))){
			$sort = $data['sort'];
		}


		// use multi_match query for products, so we can search alternative fields
		$q_clause = array( // NOTE: "red jumper" ISSUE is caused by "phrase" queries
			'multi_match' => array(
				'query' => $data['q'],
				'fields' => array(
					"business_name^4",
					"business_name.stemsyn^2",
					"business_name.standard^4",
					//"business_name_concat^2",
					"category_name^1.5"
				),
				'type' => "cross_fields",
				'minimum_should_match' => "90%",
				//'fuzziness' => $this->no_result_attempt
			)
		);


		// The MUST array
		/*$must_array = array(
			array('term' => array('status' => 1))
		);
		if(!empty($brands_clause)){ $must_array[] = $brands_clause; }
		if(!empty($retailers_clause)){ $must_array[] = $retailers_clause; }

		$must_array[] = array(
			'match' => array(
				'country_served' => ((isset($_SESSION['user_country']) && !empty($_SESSION['user_country'])) ? $_SESSION['user_country'] : "GB")
			)
		);*/

		$location_coords = array(
			'lat' => $data['coords']['lat'],
			'lon' => $data['coords']['long']
		);
		

		// construct the query. dis_max should rank product fields separately
		// tie_breaker fudges the issue somewhat :)
		$query = array(
			'query' => array(
				'filtered' => array(
					'query' => $q_clause,
					'filter' => array(
						'geo_distance' => array(
							'distance' => '60mi',
							'location.coords' => $location_coords
						)
					)
				)
			)
		);

		
		if($sort == "distance"){
			$query['sort'] = array(
				'_geo_distance' => array(
					'location.coords' => $location_coords,
					'order' => 'asc',
					'unit' => 'mi',
					'distance_type' => 'plane'
				)
			);
		}

		// add pagination
			//if(!$for_aggs){ // Normal Query
				$query['from'] = ($page - 1) * $this->per_page;
				$query['size'] = $this->per_page;
			/*}
			else{ // Query results for aggregations
				$query['from'] = 0;
				$query['size'] = 100;
			}*/
			$query['timeout'] = 4000; // Timeout at 4 seconds
			//$query['explain'] = true;

		
			$query['highlight'] = array(
				'fields' => array(
					'business_name' => array("term_vector" => "with_positions_offsets")
				)
			);

			$query['aggregations'] = array(
	        	'category_name' => array(
	        		'terms' => array('field' => 'category_name.raw', "size" => 20)
				),
	        	'category_count' => array(
	        		'cardinality' => array('field' => 'category')
				)
			);

			/*$query['suggest'] = array(
				'text' => $first_product_title_searched,
				'corrections' => array(
					'phrase' => array(
						'size' => 1,
						'field' => 'product_name.standard',
						'real_word_error_likelihood' => 0.95,
						'direct_generator' => array(array(
							'field' => 'product_name',
							'suggest_mode' => 'missing',
							'min_word_length' => 1
						)),
						'highlight' => array(
							'pre_tag' => '<b>',
							'post_tag' => '</b>'
						)
					)
				)
			);*/


		// Construct the URL
		$url = '/'.$this->index_business.'/business/_search';

		$req_body = str_replace("\\/", "/", json_encode($query));
		//file_put_contents("/tmp/es_query.json", $req_body); // for debugging

		// Get the ES response for query
		$response = $this->curl_call($url, $req_body);
		//file_put_contents("/tmp/es_response.json", $response); // for debugging

		//var_dump($response);
		
		return json_decode($response);
	} //function "search()"


    /**
	 * Gets all retailers by Feed ID
	 */
	public function searchSuggest($term, $limit = 10){
		$query = array(
		    'fields' => array('subcategory', 'combined'),
		    'query' => array(
		        'bool' => array(
		            'should' => array(
		                'match' => array(
		                    'combined' => array(
		                        'query' => $term,
		                        'minimum_should_match' => 1
		                    )
		                )
		            ),
		        )
		    ),
		    'size' => $limit
		);

		$url = '/'.$this->index_categories.'/categories/_search';

		// CURL IT, AND GET THE RESPONSE !
		$req_body = json_encode($query);
		$response = json_decode($this->curl_call($url, $req_body));

		return $response;
	}


	/**
	 * This function uses curl to get data and returns it
	 */
    private function curl_call($url, $data_string = "", $type = "GET")
    {
		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $this->server.$url);
		curl_setopt($ch, CURLOPT_PORT, $this->server_port);
		curl_setopt($ch, CURLOPT_TIMEOUT, 2000);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_FORBID_REUSE, 0);
		if($data_string){
			curl_setopt($ch, CURLOPT_HTTPHEADER, array(                                                                          
				'Content-Type: application/json',                                                                                
				'Content-Length: ' . strlen($data_string))                                                                       
			);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		}
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST,  $type);
		return curl_exec($ch);
    }//function
}
