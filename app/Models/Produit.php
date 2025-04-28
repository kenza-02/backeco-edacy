<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;

    protected $table = 'produit';
    
    protected $guarded = ['id'];

     public function inscription()
    {
        return $this->hasOne('App\Models\Inscription','id','inscription');
    }

}
