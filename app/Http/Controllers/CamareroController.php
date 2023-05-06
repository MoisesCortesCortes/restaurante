<?php

namespace App\Http\Controllers;

use App\Models\Comanda;
use App\Models\LineaComanda;
use App\Models\Pedido;
use App\Models\Plato;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CamareroController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        if ($user->tipo == 0) {
            $platos = Plato::all();
            $queryPedidos = 'SELECT * FROM pedidos WHERE pagado=false';
            $pedidos = DB::select($queryPedidos);
            $comandas = null;
            $lineas = null;
            $todoServido = null;
            for ($i = 0; $i < count($pedidos); $i++) {
                $queryComandas = 'SELECT * FROM comandas WHERE id_pedido=' . $pedidos[$i]->id;
                $comandas[$i] = DB::select($queryComandas);
                $todoServido[$i] = true;
                for ($j = 0; $j < count($comandas[$i]); $j++) {
                    if (!$comandas[$i][$j]->servido) {
                        $todoServido[$i] = false;
                    }

                    $queryLinea = 'SELECT cantidad, plato FROM linea_comandas ' .
                        'L JOIN platos P ON L.id_plato=P.id WHERE id_comanda=' . $comandas[$i][$j]->id;
                    $lineas[$i][$j] = DB::select($queryLinea);
                }
            }

            return view('app.camarero', [
                'platos' => $platos,
                'pedidos' => $pedidos,
                'comandas' => $comandas,
                'lineas' => $lineas,
                'todoServido' => $todoServido
            ]);
        } elseif ($user->tipo == 1) {
            return view('app.nopermiso', ['seccion' => 'Camarero', 'rol' => 'Cocinero']);
        }
        if ($user->tipo == 2) {
            return view('app.nopermiso', ['seccion' => 'Camarero', 'rol' => 'Administrador']);
        } else {
            return redirect()->intended(RouteServiceProvider::HOME);
        }
    }

    public function newComanda(Request $request)
    {



        $request->validate([
            'mesa' => 'required|numeric',
            'cantidad' => 'required',
            'plato' => 'required'
        ]);

        $query = 'SELECT * FROM pedidos WHERE pagado=false AND mesa =' . $request->mesa;
        $pedidos = DB::select($query);
        if (count($pedidos) > 0) {
            $pedido = reset($pedidos);
        } else {
            $pedido = new Pedido;
            $pedido->mesa = $request->mesa;
            $pedido->pagado = false;
            $pedido->save();
        }
        $comanda = new Comanda;
        $comanda->preparado = false;
        $comanda->servido = false;
        $comanda->id_pedido = $pedido->id;
        $comanda->save();


        for ($i = 0; $i < count($request->cantidad); $i++) {
            $lineaComanda = new LineaComanda;
            $lineaComanda->cantidad = $request->cantidad[$i];
            $lineaComanda->id_plato = $request->plato[$i];
            $lineaComanda->id_comanda = $comanda->id;
            $lineaComanda->save();
        }

        return redirect()->route('camarero')->with('success', 'Comanda creada');
    }
    public function servido($id)
    {
        $comanda = Comanda::find($id);
        $comanda->servido = true;
        $comanda->save();
        return redirect()->route('camarero');
    }

    public function pagado($id)
    {
        $pedido = Pedido::find($id);
        $pedido->pagado = true;
        $pedido->save();
        return redirect()->route('camarero');
    }
}
