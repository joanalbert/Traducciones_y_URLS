<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use App\Models\Producto;
use App\Models\TraduccionesProducto;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;


class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$results = DB::select('SELECT * FROM producto');
             

        $productos = Producto::all();
        $locale = App::currentLocale();
        $traducciones = array();

        foreach($productos as $producto){
            switch ($locale) {
                case 'es':
                    $traduccion = $this->get_Traduccion_de_Producto($producto, 'Espanol');
                    array_push($traducciones, $traduccion);
                break;
                case 'ca':
                    $traduccion = $this->get_Traduccion_de_Producto($producto, 'Catalan');
                    array_push($traducciones, $traduccion);
                break;
                case 'en':
                    $traduccion = $this->get_Traduccion_de_Producto($producto, 'Ingles');
                    array_push($traducciones, $traduccion);
                break;
            }
        }

        return view('Producto.ListProductos', compact('productos'), compact('traducciones'));
    }


    private function get_Traduccion_de_Producto($producto, $idioma){

  
        $idiomaID   = Idioma::where('idioma', $idioma)->first()->attributesToArray()['id'];    
        $productoID = $producto->attributesToArray()['id']; 
            
        $traduccion = TraduccionesProducto::where('idiomaID', $idiomaID)->where('productoID', $productoID)->first();
        
      

        $traduccion_attr = $traduccion->attributesToArray();

        return $traduccion_attr;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Producto.FormCrearProducto');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /*$a = Idioma::where('idioma', 'Russian')->first();
        if($a != null){
            dd($a->attributesToArray()['id']);
        } else{
            dd('not a valid language');
        }*/

        //campos constantes
        $prod = new Producto();
        $prod->precio = $_POST['precio'];
        $prod->stock = $_POST['stock'];
        $prod->referencia = $_POST['referencia'];


        //campos traduccion es
        $tradES = new TraduccionesProducto();
        $tradES->nombre = $_POST['nombre_es'];
        $tradES->subnombre = $_POST['subnombre_es'];
        $tradES->descripcion = $_POST['descripcion_es'];
        
        
        //campos traduccion ca
        $tradCA = new TraduccionesProducto();
        $tradCA->nombre = $_POST['nombre_ca'];
        $tradCA->subnombre = $_POST['subnombre_ca'];
        $tradCA->descripcion = $_POST['descripcion_ca'];

        
        //campos traduccion en
        $tradEN = new TraduccionesProducto();
        $tradEN->nombre = $_POST['nombre_en'];
        $tradEN->subnombre = $_POST['subnombre_en'];
        $tradEN->descripcion = $_POST['descripcion_en'];

        
        //guardar campos constantes
        $prod->save();

        //definir la clave foranea de las traducciones, hacer que apunte a la id del producto (de campos constantes)
        $tradES->productoID = $prod->id;
        $tradCA->productoID = $prod->id;
        $tradEN->productoID = $prod->id;

        
        //definir la segunda clave foranea de las traducciones, hacer que apunto a la id del idioma
        $tradES->idiomaID = Idioma::where('idioma', 'Espanol')->first()->attributesToArray()['id'];
        $tradCA->idiomaID = Idioma::where('idioma', 'Catalan')->first()->attributesToArray()['id'];
        $tradEN->idiomaID = Idioma::where('idioma', 'Ingles')->first()->attributesToArray()['id'];

        //guardar
        $tradES->save();
        $tradCA->save();
        $tradEN->save();

        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }


    

    //metodo personalizado se 'show' sin productoID
    public function show_by_slug($slug){
        //slug es unico en la tabla traducciones, asi que lo podemos utilizar para recuperar una unica traduccion para este producto, pero no todas, lo cual de carga la traduccion dinamica
        $traduccion = TraduccionesProducto::where("slug", $slug)->firstOrFail();
        //a partir de la traduccion, recuperamos el producto
        $producto   = Producto::where("id", $traduccion->productoID)->firstOrFail();
        
        return view('Producto.DetalleProducto', compact('producto'), compact('traduccion'));
    }

    //metodo personalizado se 'show' con productoID
    public function show_by_slug_id($slug, $productoID){

        $locale = App::currentLocale();
        $producto = Producto::where("id", $productoID)->firstOrFail(); //firstOrFail es como first, pero se asegura de que el resultado no sea null, si es null muestra pagina de 404 not found. Nos es mas conveniente que el first porque no tenemos que ir asegurandonos que las variables no sean null antes de acceder a algunn campo
        $traduccion;

        //dependiendo del locale, recuperamos la traduccion asociada al productoID de la ruta
        switch($locale){
            case 'es':
                $traduccion = TraduccionesProducto::where("idiomaID", 1)->where("productoID", $productoID)->firstOrFail();
                break;
            case 'ca':
                $traduccion = TraduccionesProducto::where("idiomaID", 2)->where("productoID", $productoID)->firstOrFail();
                break;
            case 'en':
                $traduccion = TraduccionesProducto::where("idiomaID", 3)->where("productoID", $productoID)->firstOrFail();
                break;
        }

        //si el slug de la traduccion no es el mismo que el de la ruta, significa que hemos cambiado de idioma y devemos redireccionar a la ruta 
        //con el slug correcto. Esto no es necesario, se puede eliminar y no pasa nada. Pero queda mejor actualizar el slug de la url cada vez que 
        //cambiamos de idioma para mantenerlo tambien en el idioma correcto.
        if($traduccion->slug != $slug)
        {
            return redirect()->route("Producto.show_slug_id", ['slug'=>$traduccion->slug, 'productoID'=>$producto->id]);
        }

        //devolvemos la vista
        return view('Producto.DetalleProducto', compact('producto'), compact('traduccion'));
    }
    

    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        //
    }
}
