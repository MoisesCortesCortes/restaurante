<?php

namespace App\Http\Controllers;

use App\Models\Plato;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

    public function index()
    {
        $user=Auth::user();
        if($user->tipo==0){
            return view('app.nopermiso', ['seccion' => 'Administrador','rol'=>'Camarero']);
        }elseif($user->tipo==1){
            return view('app.nopermiso', ['seccion' => 'Administrador','rol'=>'Cocinero']);
        }if($user->tipo==2){
            $platos = Plato::all();
            return view('app.admin', ['platos' => $platos]);
        }else{
            return redirect()->intended(RouteServiceProvider::HOME);
        }
        
    }

    public function addPlato(Request $request)
    {
        $request->validate([
            'plato' => 'required|min:3|max:255|unique:platos,plato'
        ]);

        $plato = new Plato;
        $plato->plato = $request->plato;

        $plato->save();
        return redirect()->route('admin')->with('success', 'Plato creado');
    }

    public function showPlato($id){
        $plato=Plato::find($id);
        return view('app.editarPlato',['plato'=>$plato]);
    }
    
    public function updatePlato($id,Request $request){
        $plato=Plato::find($id);
        $request->validate([
            'plato' => 'required|min:3|max:255|unique:platos,plato'
        ]);
        $plato->plato = $request->plato;
        $plato->save();
        return redirect()->route('admin')->with('success', 'Plato actualizado');
    }

    public function borrarPlato($id){
        $plato=Plato::find($id);
        $plato->delete(); 
        return redirect()->route('admin')->with('success', 'Plato eliminado');
    }
    
}
