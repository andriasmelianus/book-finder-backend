<?php

namespace App\Http\Controllers;

use App\Utils\Responser2;

abstract class Controller
{
    protected $responser;

    /**
     * Constructor.
     * 
     * @return void
     */
    public function __construct()
    {
        $this->responser=  new Responser2();
    }
}
