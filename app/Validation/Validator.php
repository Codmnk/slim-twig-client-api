<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator
{
    protected $errors;
    protected $allowFileTpes = array ( 'image/jpeg', 'image/png', 'video/mpeg', 'video/mp4');

    public function validate($req, array $rules)
    {
        foreach($rules as $field => $rule){
            try{
            $rule->setName(ucfirst($field))->assert($req->getParam($field));                
            } catch(NestedValidationException $e){

                $this->errors[$field] = $e->getMessages();
            }
        }

        if($_FILES['attach']['size'] > 10){
            // FILE VALIDATION
            $fType = $_FILES['attach']['type'];
            $fSize = $_FILES['attach']['size'];
            $finfo = finfo_open(FILEINFO_MIME_TYPE);
            
        

            $allowFileSize = 20971520; //20MB
            if($fSize >  $allowFileSize) {
                $this->errors['attach'] = [ "File is too larg. Do not exceed 20MB file size" ];
            }
            if(!in_array($fType, $this->allowFileTpes)){
                $this->errors['attach'] = [ "Only Image or Video file allowed." ];
            }
        }
        
 
        $_SESSION['errors'] = $this->errors ? $this->errors : '';

        return $this;
    }

    public function validationFailed()
    {
        return !empty($this->errors);
    }
}