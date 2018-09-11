<?php

namespace App\Models;



class Fetch {
    protected $SITE_URL = 'https://www.bigdiscount.com.au/hc/hc-api/public/';
    protected $CATEGORIES_ENDPOINT = 'categories';
    protected $QNA_ENDPOINT = 'category/';
    protected $SEARCH_ENDPOINT = 'search/';


    public function getCategories()
    {
        try{
            $response = file_get_contents($this->SITE_URL . $this->CATEGORIES_ENDPOINT);
            $response = json_decode($response);
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
            $response = json_decode($response);
            return $response;

        }catch(Exception $e){
            $response = '{"Error": {"Message": "$e->getMessage"}}';
            return $response; 
        }

    }

    public function getThumbnail($s)
    {
        $catArgs = $this->getCategories();
        for($i=0; $i<count($catArgs); $i++){
            if($catArgs[$i]->url === $s){
                return array(
                    'title' => html_entity_decode( $catArgs[$i]->catTitle ),
                    'catThumbnail' => $catArgs[$i]->catThumbnail
                    );
            }
        }
    }

    // RETUTN SEARCH RESULT
    public function getSearchResult($s)
    {
        $this->SEARCH_ENDPOINT .= trim($s);

        try{
            //FOR E.G.     https://www.bigdiscount.com.au/hc/hc-api/public/search/warranty+policy
            $response = file_get_contents($this->SITE_URL . $this->SEARCH_ENDPOINT);
            $response = json_decode($response);
            
            return $response;

        }catch(Exception $e){
            $response = '{"Error": {"Message": "$e->getMessage"}}';
            return $response; 
        }
    }
}

