<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CocinaController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user->tipo == 0) {
            return view('app.nopermiso', ['seccion' => 'Cocina', 'rol' => 'Camarero']);
        } elseif ($user->tipo == 1) {
            $queryPedidos='SELECT * FROM pedidos WHERE pagado=false';
        $pedidos=DB::select($queryPedidos);
        $comandas=null;
        $lineas=null;
        for($i=0;$i<count($pedidos);$i++){
            $queryComandas='SELECT * FROM comandas WHERE id_pedido='.$pedidos[$i]->id.' AND servido=false' ;
            $comandas[$i]=DB::select($queryComandas);
            for($j=0;$j<count($comandas[$i]);$j++){
                $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                $out->writeln("antes de validar");
                $queryLinea='SELECT cantidad, plato FROM linea_comandas '. 
                'L JOIN platos P ON L.id_plato=P.id WHERE id_comanda='.$comandas[$i][$j]->id;
                $lineas[$i][$j]=DB::select($queryLinea);
            }
        }

        return view('app.cocina',[
        'pedidos'=>$pedidos,
        'comandas'=>$comandas,
        'lineas'=>$lineas]);
        }
        if ($user->tipo == 2) {
            return view('app.nopermiso', ['seccion' => 'Cocina', 'rol' => 'Administrador']);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        
    }

    public function listo($id){
        $comanda = Comanda::find($id);
        $comanda->preparado=true;
        $comanda->save();
        return redirect()->route('cocina')->with('success', 'Pedido listo para entregar');
    }
}
