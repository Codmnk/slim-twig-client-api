<?php

namespace App\Models;



class Fetch {
    protected $SITE_URL = 'https://www.bigdiscount.com.au/hc/hc-api/public/';
    protected $CATEGORIES_ENDPOINT = 'categories';
    protected $QNA_ENDPOINT = 'category/';


    public function getCategories()
    {
        try{
            $response = file_get_contents($this->SITE_URL . $this->CATEGORIES_ENDPOINT);
            // $response = json_decode($response);
            return $response;
        }catch(Exception $e){
            $response = '{"Error": {"Message": "$e->getMessage"}}';
            return $response; 
        }

    }
    public function getQNA($slug)
    {
        $this->QNA_ENDPOINT .= trim($slug);

        try{
            //FOR E.G.     https://www.bigdiscount.com.au/hc/hc-api/public/category/sales-and-orders
            $response = file_get_contents($this->SITE_URL . $this->QNA_ENDPOINT);
            // $response = json_decode($response);
            return $response;
        }catch(Exception $e){
            $response = '{"Error": {"Message": "$e->getMessage"}}';
            return $response; 
        }

    }
}

