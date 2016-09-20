<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ResultsController extends Controller
{
    //
    public function getResults(){

    	// Put valid $_GET variables into $search_vars
            $search_vars = array();
            foreach ($_GET as $key => $value) {
                if(in_array($key, array("q", "cat", "location")) && !empty($value)){
                    $search_vars[$key] = addslashes($value);
                }
            }

    	/*$_ES = new \App\Elasticsearch;
    	$response = $_ES->{$_POST['type'].'Suggest'}($_POST['term']);
    	$response = $response->hits->hits;

    	$data = array();

    	if(count($response)){
			foreach ($response as $t){
				$data[] = array('subcategory'=>current($t->fields->subcategory), 'combined'=>current($t->fields->combined), 'id'=>$t->_id);
			}
		}

		echo json_encode($data);*/
		if(isset($search_vars['q']) && isset($search_vars['location'])){ // Make sure all required fields exist
			$geo = $this->getLatLong($search_vars);
			$search_vars['coords'] = $geo['geo'];

			$_ES = new \App\Elasticsearch;

			$results = $_ES->search($search_vars);
			return view('pages.results', array('geo'=>$geo, 'results'=>$results->hits->hits));
		}
    	
    }


    public function getLatLong($search_vars)
    {
        $res = array("q"=>$search_vars['q']);
        $err = "";

        $latlong = $this->getLocationGeocode($search_vars['location']);
        if($latlong){ // Valid geo-location found
            $res['geo'] = $latlong;
        }
        else{
            $res['error'] = "Invalid Location";
        }

        return $res;
    }


    public function getLocationGeocode($location, $country_specified = false){
        
        $location = $location . (!$country_specified ? " UK" : ""); // Make sure it is a UK city

        $url = "https://maps.googleapis.com/maps/api/geocode/json?address=".urlencode($location)."&key=".config('app.google_api_key');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        $response = curl_exec($ch);
        curl_close($ch);
        $response_a = json_decode($response);
        if($response_a->status == "OK"){
            
            $temp_add_components = array();
            $formatted_address = "";
            foreach ($response_a->results[0]->address_components as $comp) {
                $temp_add_components[$comp->types[0]] = $comp->long_name;
            }

            if(isset($temp_add_components['locality']) && isset($temp_add_components['postal_town']) && ($temp_add_components['locality'] == $temp_add_components['postal_town'])){
                unset($temp_add_components['locality']);
            }
            
            // LETS PUT PIECES IN ORDER
            $t_comp = array();
            if(isset($temp_add_components['locality']) && !empty($temp_add_components['locality'])){ $t_comp[] = $temp_add_components['locality']; }
            if(isset($temp_add_components['postal_town']) && !empty($temp_add_components['postal_town'])){ $t_comp[] = $temp_add_components['postal_town']; }
            if(isset($temp_add_components['administrative_area_level_2']) && !empty($temp_add_components['administrative_area_level_2'])){ $t_comp[] = $temp_add_components['administrative_area_level_2']; }
            $formatted_address = implode(", ", $t_comp);
            if(isset($temp_add_components['postal_code']) && !empty($temp_add_components['postal_code'])){ $formatted_address .= " ".$temp_add_components['postal_code']; }
            //else if(isset($temp_add_components['postal_code_prefix']) && !empty($temp_add_components['postal_code_prefix'])){ $formatted_address .= " ".$temp_add_components['postal_code_prefix']; }
            //if(isset($temp_add_components['country']) && !empty($temp_add_components['country'])){ $formatted_address .= ", ".$temp_add_components['country']; }

            //echo $response_a->results[0]->formatted_address;

            /*var_dump($temp_add_components);
            die();*/

            return array(
                'lat'=>$response_a->results[0]->geometry->location->lat,
                'long'=>$response_a->results[0]->geometry->location->lng,
                //'formatted_address'=>$response_a->results[0]->formatted_address,
                'formatted_address'=>$formatted_address);
        }
        else{
            return false;
        }
    }
}
