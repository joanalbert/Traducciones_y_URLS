<div class="container-fluid p-0">
    <div class="col-12">
        <div class="w-100">
        <nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#"> @lang('messages.titulo') </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class="active">
            <a href="{{route('Producto.create')}}"> @lang('messages.nuevo_producto')</a>
        </li>
        <li>
            <a href="{{route('Producto.index')}}"> @lang('messages.ver_productos') </a>
        </li>
        <li>
          <a href=" {{  route('changeLang', ['lang'=>'es']) }} ">@lang('messages.español')</a>
        </li>
        <li>
          <a href=" {{  route('changeLang', ['lang'=>'ca']) }} ">@lang('messages.catalan')</a>
        </li>
        <li>                  
          <a href=" {{  route('changeLang', ['lang'=>'en']) }} ">@lang('messages.ingles')</a>
        </li>
        
      </ul>
      
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
        </div>
    </div>
</div>