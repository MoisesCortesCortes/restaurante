@extends('app')

@section('content')
<h1>Cocina</h1>
<div class="row">
    @for ($i=0;$i<count($pedidos);$i++) @if (count($comandas[$i])) <div class="col container w-25 border p-4 m-1 bg-secondary bg-opacity-25">
        <h1>Pedido:{{$pedidos[$i]->id}}</h1>
        <h2>Mesa {{$pedidos[$i]->mesa}}</h2>
        @for ($j=0;$j<count($comandas[$i]);$j++) <div class="col container border p-4 m-1 bg-success bg-opacity-25">

            @if ($comandas[$i][$j]->preparado)
            <h6 class="alert alert-success">Listo para servir</h6>
            @endif

            <h3>Comanda: {{$comandas[$i][$j]->id}}</h3>
            <ul class="list-group list-group-flush">
                @foreach ($lineas[$i][$j] as $linea)
                <li class="list-group-item">{{$linea->cantidad}} x {{$linea->plato}}</li>
                @endforeach



            </ul>
            @if (!$comandas[$i][$j]->preparado)
            <form method="post" action="{{route('cocina-listo',['id'=>$comandas[$i][$j]->id])}}">

                @csrf

                <button type="submit" class="btn btn-primary">Listo para servir</button>
            </form>
            @endif

</div>
@endfor
</div>
@endif
@endfor




</div>
@endsection