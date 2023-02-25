@extends('template.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12 col-md-6 offset-md-6 bg-success">
            <h1>Detalle producto</h1>
            <form action="">
                <label for="producto">Nombre</label>
                <input id="producto" type="text" value="{{$traduccion->nombre}}" readonly>

                <br>

                <label for="slug">Slug</label>
                <input id="slug" type="text" value="{{$traduccion->slug}}" readonly>

                <br>

                <label for="desc">Descripcion</label>
                <textarea id="desc" cols="30" rows="10" readonly>{{$traduccion->descripcion}}</textarea>

                <br>

                <label for="stock">Stock</label>
                <input id="stock" type="number" value="{{$producto->stock}}" readonly>
            </form>
        </div>
    </div>
</div>
@endsection