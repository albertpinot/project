<?php

namespace App\Http\Controllers;

use App\User;
use App\Chanson;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class MonControleur extends Controller
{
    public function index() {
        $chansons = Chanson::all();
        return view("index", ['chansons'=>$chansons]);
    }
    public function nouvelle(){
        return view("nouvelle");
    }
    public function create (Request $request){
       /* print_r($_FILES);
        die(1);*/
        $validator = Validator::make($request->all(),[
            'nom' => 'required|min:6'
        ]);
        if ($validator->fails()) {
            return redirect('/nouvelle')
                        ->withErrors($validator)
                        ->withInput()
                        ->with('toastr',['status' => 'error', 'message' => 'problème']);
        }
        if($request->hasFile('chanson') && $request->file('chanson')->isValid()){
            $c = new Chanson();
            $c->nom = $request->input('nom');
            $c->style = $request->input('style');
            $c->utilisateur_id = Auth::id();

            $c->fichier = $request->file('chanson')->store("public/chansons/".Auth::id());
            $c->fichier = str_replace("public/","/storage/",$c->fichier);
            if($request->hasFile('photo') && $request->file('photo')->isValid()){
                $c->photo = $request->file('photo')->store("public/pochette/".Auth::id());
                $c->photo = str_replace("public/","/storage/",$c->photo);
            } else {
                $c->photo = "/img/pochette.png";
            }
            $c->save();
        }
        return redirect("/")->with('toastr',['status' => 'success', 'message' => 'chanson insérée']);
    }
    public function utilisateur($id){
        $utilisateur = User::find($id);

        if($utilisateur==false){
            abort(404);
        }
        return view('utilisateur',["utilisateur" => $utilisateur]);
     }
     public function suivi($id){
        $utilisateur = User::find($id);

        if($utilisateur==false){
           return redirect('/')->with('toastr',['status' => 'error', 'message' => 'problème']);
        }
        Auth::user()->jeLesSuit()->toggle($id);
        return back()->with('toastr',['status' => 'success', 'message' => 'Suivi modifié']);
     }
     public function recherche($s){
        $users = User::whereRaw("name LIKE CONCAT(?,'%')",[$s])->get();
        $chansons = Chanson::whereRaw("nom LIKE CONCAT('%',?,'%')",[$s])->get();

        return view("recherche", ['utilisateurs' => $users, 'chansons' => $chansons]);
        
     }
     public function testajax(){
         return redirect('/recherche/ut');
     }
}
