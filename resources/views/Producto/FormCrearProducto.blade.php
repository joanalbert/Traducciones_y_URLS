@extends('template.template')

<!-- PRODUCTO
'precio'
'stock'
'referencia
-->

<!-- TRADUCCIONES PRODUCTO
'nombre'
'subnombre'
'descripcion'
-->
@section('content')
<div class="container">
    <div class="col-6 offset-3" bg-dark>
        <form action="{{route('Producto.store')}}" method="POST">
            @csrf
            <label for="precio">@lang('messages.precio'): </label>
            <input type="number" step="any" name="precio" id="precio" required>
            <br>
            <label for="precio">@lang('messages.stock'): </label>
            <input type="number" name="stock" id="stock" required>
            <br>
            <label for="precio">@lang('messages.referencia'): </label>
            <input type="text" name="referencia" id="referencia" required>

            <br>
            <hr>
            <p>@lang('messages.info_es')</p>

            <label for="nombre_es">@lang('messages.nombre_es') </label>
            <input type="text" name="nombre_es" id="nombre_es"  required>
            <br>
            <label for="subnombre_es">@lang('messages.subnombre_es') </label>
            <input type="text" name="subnombre_es" id="subnombre_es"  required>
            <br>
            <label for="descripcion_es">@lang('messages.descripcion_es') </label>
            <input type="text" name="descripcion_es" id="descripcion_es"  required>

            <br>
            <hr>
            <p>{{ trans('messages.info_ca') }}</p>

            <label for="nombre_ca">@lang('messages.nombre_ca') </label>
            <input type="text" name="nombre_ca" id="nombre_ca"  required>
            <br>
            <label for="subnombre_ca">@lang('messages.subnombre_ca') </label>
            <input type="text" name="subnombre_ca" id="subnombre_ca"  required>
            <br>
            <label for="descripcion_ca">@lang('messages.descripcion_ca') </label>
            <input type="text" name="descripcion_ca" id="descripcion_ca"  required>

            <br>
            <hr>
            <p>{{ trans('messages.info_en') }}</p>

            <label for="nombre_en">@lang('messages.nombre_en') </label>
            <input type="text" name="nombre_en" id="nombre_en" required>
            <br>
            <label for="subnombre_en">@lang('messages.subnombre_en') </label>
            <input type="text" name="subnombre_en" id="subnombre_en"  required>
            <br>
            <label for="descripcion_en">@lang('messages.descripcion_en') </label>
            <input type="text" name="descripcion_en" id="descripcion_en"  required>

            <br>
            <hr>
            <input type="submit" value="@lang('messages.añadir')">
        </form>
    </div>
</div>
@endsection