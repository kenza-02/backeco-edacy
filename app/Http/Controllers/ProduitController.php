<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produit;
use App\Http\Controllers\Auth\MyAuthentication;

class ProduitController extends Controller
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
        return response(Produit::orderby('id','DESC')->get());
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
            'nom'=> 'required|string',
            'prix'=> 'required|int',
            'image'=> 'required|string',
            'description'=> 'required|string'
        ]);
        $reg = new  Produit([
            'nom'=>  $request->get('nom'),
            'prix'=>  $request->get('prix'),
            'image'=>  $request->get('image'),
            'description'=>  $request->get('description')
        ]);
        $reg->inscription=$this->auth->inscription();
        $reg->save();
  
        return response($reg);
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      return Produit::where('id',$id)->first();
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
        $Produit = Produit::findOrFail($id);
        $Produit->update($request->all());
        return response($Produit);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $item = Produit::findOrFail($id);

      $item->delete();

      return response()->json(['msg' => 'Suppression effectué']);
    }
}
