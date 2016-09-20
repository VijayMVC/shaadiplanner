<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class AjaxController extends Controller
{
    //
    public function suggest(){
    	$_ES = new \App\Elasticsearch;
    	$response = $_ES->{$_POST['type'].'Suggest'}($_POST['term']);
    	$response = $response->hits->hits;

    	$data = array();

    	if(count($response)){
			foreach ($response as $t){
				$data[] = array('subcategory'=>current($t->fields->subcategory), 'combined'=>current($t->fields->combined), 'id'=>$t->_id);
			}
		}

		echo json_encode($data);
    }
}
