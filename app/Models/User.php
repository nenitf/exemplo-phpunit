<?php

namespace App\Models;

class User {
    public $id;
    public $name;
    public $email;
    public $password;

    public function save($a){
        var_dump('Save implementado');
    }
}
