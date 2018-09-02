<?php

namespace App\Controllers;

use App\Models\Fetch;


class Controller
{
    protected $container;
    protected $fetch;

    public function __construct($container)
    {
        $this->container = $container;
        $this->fetch = new Fetch;
    }

    public function __get($property)
    {
        if($this->container->{$property}){
            return $this->container->{$property};
        }
    }
}