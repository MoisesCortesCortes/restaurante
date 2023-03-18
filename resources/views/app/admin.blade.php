@extends('app')

@section('content')
    
    <div class="container w-25 border p-4">
    <h1>Administración</h1>
    <div class="row mx-auto">
    <form  method="POST" action="{{route('admin')}}">
        @csrf

        <div class="mb-3 col">
        @error('plato')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

        @if (session('success'))
                <h6 class="alert alert-success">{{ session('success') }}</h6>
        @endif
            <label for="title" class="form-label">Plato:</label>
            <input type="text" class="form-control mb-2" name="plato" id="plato" placeholder="Arroz con pollo">

            
            <input type="submit" value="Crear plato" class="btn btn-primary my-2" />
        </div>
    </form>

    <div >
        @foreach ($platos as $plato)
        
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a href="{{ route('plato-edit', ['id' => $plato->id]) }}">{{ $plato->plato }}</a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <form action="{{ route('plato-destroy', [$plato->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </div>
            </div>
            
        @endforeach
    </div>
    </div>
</div>
@endsection