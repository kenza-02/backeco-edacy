<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;

class MyAuthentication
{   
    private static $inscription;

    private $user;

    public function __construct()
    {   
         $this->inscription();
    } 
    
    public function inscription()
    {
        return auth()->id();
    }

    public function user()
    {
        return $this->user;
    }

      public function setinscription($value)
    {
        self::$inscription=$value;
    }
}
