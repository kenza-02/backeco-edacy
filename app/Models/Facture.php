<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facture extends Model
{
    use HasFactory;

    protected $table = 'facture';
    protected $guarded = ['id'];

 
      public function panier() 
    {
        return $this->hasOne('App\Models\Panier','id','panier');
    }

     public function inscription()
    {
        return $this->hasOne('App\Models\User','id','inscription');
    }
}
