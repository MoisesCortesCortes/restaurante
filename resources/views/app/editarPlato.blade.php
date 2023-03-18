@extends('app')

@section('content')
    
    <div class="container w-25 border p-4">
    <h1>Editar Plato</h1>
    <div class="row mx-auto">
    <form  method="POST" action="{{ route('plato-update', ['id' => $plato->id]) }}">
        @method('PATCH')
        @csrf

        <div class="mb-3 col">
            @error('plato')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            @if (session('success'))
                    <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            <label for="title" class="form-label">Plato:</label>
            <input type="text" class="form-control mb-2" name="plato" id="plato" placeholder="Comprar la cena" value="{{ $plato->plato }}">

             
            <input type="submit" value="Actualizar plato" class="btn btn-primary my-2" />
        </div>
    </form>

    
    </div>
</div>
@endsection