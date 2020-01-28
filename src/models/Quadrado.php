<?php

namespace App\Models;

class Quadrado {
    private $lado1;
    private $lado2;

    function __construct(float $lado1, float $lado2)
    {
        $this->lado1 = $lado1;
        $this->lado2 = $lado2;
    }

    public function getArea():float
    {
        return $this->lado1 * $this->lado2;
    }
}
