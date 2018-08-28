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
            
            // RETURNS HTML_ENTITY_DECODED QUESTION AND ANSWER ARRAY
            $htmlEncodedArg = $this->getcleanData($response);
            return $htmlEncodedArg;

        }catch(Exception $e){
            $response = '{"Error": {"Message": "$e->getMessage"}}';
            return $response; 
        }

    }

    public function getcleanData($catArgs)
    {
        $catData = [];//temporary array holder
        for($i=0; $i<count($catArgs); $i++){
            $catData[$i]['question'] =  html_entity_decode($catArgs[$i]->question);
            $catData[$i]['answer'] = html_entity_decode($catArgs[$i]->answer);
            $catData[$i]['imgUri'] = html_entity_decode($catArgs[$i]->answer);
        }

        return $catData;
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
}

