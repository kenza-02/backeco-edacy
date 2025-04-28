<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panier extends Model
{
    use HasFactory;

    protected $table = 'panier';
    protected $guarded = ['id'];

      public function commandes()
    {
        return $this->hasMany('App\Models\Commande','panier');
    }

   
     public function facture() 
    {
        return $this->belongsTo('App\Models\Facture','id','panier');
    }  
     
     public function inscription()
    {
        return $this->hasOne('App\Models\User','id','inscription');
    }
}
