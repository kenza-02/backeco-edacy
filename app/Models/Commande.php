<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commande extends Model
{
    use HasFactory;

    protected $table = 'commande';
    protected $guarded = ['id'];
 
 
      public function panier() 
    {
        return $this->hasOne('App\Models\Panier','id','panier');
    }

      public function produit()
    {
        return $this->hasOne('App\Models\Produit','id','produit');
    }
    
     public function inscription()
    {
        return $this->hasOne('App\Models\User','id','inscription');
    }
}
