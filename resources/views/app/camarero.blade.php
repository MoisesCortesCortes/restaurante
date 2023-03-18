@extends('app')

@section('content')
<h1>Camarero</h1>
<div class="row">
    <div class="container w-25 border p-4 m-1 bg-primary bg-opacity-25">
        <form method="post" action="{{route('camarero')}}">
            @csrf
            <h2>Nueva Comanda</h2>
            @error('mesa')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('cantidad')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            @error('plato')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="mb-3">
                <label for="mesa" class="form-label">Mesa:</label>
                <select class="form-select" aria-label="Default select example" name="mesa">
                    <option selected>Selecciona mesa</option>
                    <option value="1">Mesa 1</option>
                    <option value="2">Mesa 2</option>
                    <option value="3">Mesa 3</option>
                </select>
            </div>
            <div id="platos" class="mb-3">
                <label for="cantidad" class="form-label">Cantidad</label>
                <label for="plato" class="form-label">plato</label>

                <div id="plato0" class="row">
                    <div class="col-md-3">
                        <select class="form-select" aria-label="Default select example" name="cantidad[0]">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                        </select>
                    </div>
                    <div class="col">
                        <select class="form-select" aria-label="Default select example" name="plato[0]">

                            @foreach ($platos as $plato)
                            <option value="{{$plato->id}}">{{$plato->plato}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div id="add" class="col-md-2">
                        <input type="button" onclick="addPlato()" class="rounded-circle" value="+">



                    </div>

                </div>


            </div>

            <button type="submit" class="btn btn-primary">Crear comanda</button>
        </form>
    </div>

    @for ($i=0;$i<count($pedidos);$i++) 
    <div class="col container w-25 border p-4 m-1 bg-secondary bg-opacity-25">
        <h1>Pedido:{{$pedidos[$i]->id}}</h1>
        <h2>Mesa {{$pedidos[$i]->mesa}}</h2>
        @for ($j=0;$j<count($comandas[$i]);$j++) 
            <div class="col container border p-4 m-1 bg-success bg-opacity-25">
            @if ($comandas[$i][$j]->servido)
            <h6 class="alert alert-success">Comanda servida</h6>
            @endif
            <h3>Comanda: {{$comandas[$i][$j]->id}}</h3>
            <ul class="list-group list-group-flush">
                @foreach ($lineas[$i][$j] as $linea)
                <li class="list-group-item">{{$linea->cantidad}} x {{$linea->plato}}</li>
                @endforeach



            </ul>
            @if ($comandas[$i][$j]->preparado and !$comandas[$i][$j]->servido)
            <form method="post" action="{{route('camarero-servido',['id'=>$comandas[$i][$j]->id])}}">

                @csrf

                <button type="submit" class="btn btn-primary">Marcar servido</button>
            </form>
            @endif
</div>
@endfor
@if($todoServido[$i])
<form method="post" action="{{route('camarero-pagado',['id'=>$pedidos[$i]->id])}}">

@csrf

<button type="submit" class="btn btn-primary">Marcar pagado</button>
</form>
@endif
</div>
@endfor




</div>

@endsection