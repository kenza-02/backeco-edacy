<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Facture;
use App\Http\Controllers\Auth\MyAuthentication;

class FactureController extends Controller
{
     private $auth;

    public function __construct()
    {
        $this->auth = new MyAuthentication();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Facture::with('inscription','panier')
        ->OrderBy('id','DESC')
        ->get(); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'panier'=> 'required|int',
            'montant_recu'=> 'required|int',
            'montant_restant'=> 'required|int'
        ]); 
        $facture = new  Facture([
            'inscription'=> $this->auth->inscription(),
            'panier'=> $request->get('panier'),
            'montant_restant'=> $request->get('montant_restant'),
            'montant_recu'=> $request->get('montant_recu')
        ]);
        $facture->save();
        return $facture;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Facture::with('panier.commandes.produit',
            'panier','inscription')
        ->where('id',$id)
        ->first();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
       //

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
