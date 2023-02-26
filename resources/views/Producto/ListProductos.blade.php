@extends('template.template')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-6">
            <ul class="list-group">
                @foreach($productos as $key => $product)
                <li class="list-group-item">
                    <span class="badge">stock: {{$product->stock}}</span>
                    <p>{{$product->precio}}</p>
                    <p>{{$product->referencia}}</p>
                    <hr>
                    
                    
                    <p><strong>{{$traducciones[$key]['nombre']}}</strong></p>
                    <p>{{$traducciones[$key]['subnombre']}}</p>
                    <p>{{$traducciones[$key]['descripcion']}}</p>

                    <p>slug: {{ $traducciones[$key]['slug'] }}</p>
                    
                    <a href="{{ route('product_show_by_slug', ['slug'=> $traducciones[$key]['slug'] ]) }}" class="btn btn-primary">Ver producto (slug)</a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
@endsection