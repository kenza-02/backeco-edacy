<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\MyAuthentication;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Panier;
use App\Models\Commande;

class PanierController extends Controller
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
        return Panier::withCount('commandes')
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
            'nbcommande'=> 'required|int',
            'nom'=> 'required|string',
            'prenom'=> 'required|string',
            'telephone'=> 'required|string',
            'adresse'=> 'required|string',
            'total'=> 'required|int'
        ]); 
        $panier = new  Panier([
            'nom'=> $request->get('nom'),
            'total'=> $request->get('total'),
            'prenom'=> $request->get('prenom'),
            'telephone'=> $request->get('telephone'),
            'adresse'=> $request->get('adresse'),
            'statut'=>'En attente'
        ]);
        $panier->inscription=$this->auth->inscription();
        $nbcommande=$request->get('nbcommande');
        if($request->has('nbcommande') && $request->nbcommande > 0){
          $panier->save();
          for($i = 0; $i < $request->nbcommande; $i++){
            $commande = new  Commande([
                'panier'=>$panier->id,
                'produit'=>$request->get('produit'.$i),
                'quantite'=>$request->get('quantite'.$i),
                'sous_total'=>$request->get('sous_total'.$i)
            ]);
            $commande->inscription=$this->auth->inscription();
            $commande->save();
          }
        }
        
        return $panier;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Panier::with('commandes.produit','facture')
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
        $val= $this->validate($request,[
            'statut'=> 'required|string'
        ]);
        $reg = Panier::findOrFail($id);
        $reg->fill($val)->save();
        return $reg;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table('commande')->where('panier', $id)->delete();
        
        $item = Panier::findOrFail($id);
        $item->delete(); 

        return response()->json(['msg' => 'Suppression effectué']);
    } 
   

}
