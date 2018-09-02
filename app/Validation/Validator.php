<?php

namespace App\Validation;

use Respect\Validation\Validator as Respect;

class Validator
{
    public function validate($req, array $rules)
    {
        var_dump("works");
        die();
    }
}