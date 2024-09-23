<?php

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class User extends Entity
{
    protected $datamap = [];
    protected $dates   = ['created_at', 'updated_at', 'deleted_at'];
    protected $casts   = [];

    function getName(){
        return strtoupper($this->attributes['name']);
    }

    function setName($name){
        $this->attributes['name'] = ucwords($name);
    }
}
