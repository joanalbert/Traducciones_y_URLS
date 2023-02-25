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

                    <p>slug: {{$traducciones[$key]['slug']}}</p>
                    
                    <a href="{{ route('Producto.show_slug', ['slug'=>$traducciones[$key]['slug'] ]) }}" class="btn btn-primary">Ver producto (slug)</a>

                    <a href="{{ route('Producto.show_slug_id', [
                                                                'slug'=>$traducciones[$key]['slug'],
                                                                'productoID'=> $product->id
                                                                ]
                                     )
                             }}" class="btn btn-primary">Ver producto (slug y id)</a>
                </li>
                @endforeach
            </ul>

        </div>
    </div>
</div>
@endsection