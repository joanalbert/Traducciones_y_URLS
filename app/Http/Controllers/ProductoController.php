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

        //una traduccion, la que corresponde al slug de la ruta
        //es "una traduccion" y no la traduccion porque el usuario puede haver cambiado el idioma mientras tenia la pagina
        //de detalle abierta, por eso se "recalcula" la traduccion más abajo. Aun asi es necesario tener esta variable para poder
        //recuperar el producto, y mas abajo se explica porque el producto es necesario
        $unaTraduccion = TraduccionesProducto::where("slug", $slug)->firstOrFail();

        //necesitamos tambien recuperar el producto asociado a la traduccion, 2 motivos
        // 1.- lo tiene que mostrar la vista
        // 2.- necesitamos saber su id para recuperar la traduccion correcta mas abajo (id producto y id idioma)
        $producto = Producto::where("id", $unaTraduccion->productoID)->firstOrFail(); //first or fail es como first, pero si el resultado es null lanza un error 404 not found, asi no tenemos que preocuparnos de ir mirando si las variables son null o no antes de llamar funciones sobre ellas o acceder a propiedades

        //idioma
        $locale = App::currentLocale();

        
        //array para mapear idiomas y id y asi evitar el switch case
        $idiomas = [
            'es' => 1,
            'ca' => 2,
            'en' => 3,
        ];

        //esta variable representa la traduccion correcta que se correponde al idoma actual y al producto
        //es obtenida sabiendo el valor de $locale y del productoID, (que a su vez 'producto' es obtenido a partir de unaTraduccion)
        $traduccion = TraduccionesProducto::where("idiomaID", $idiomas[$locale])->where("productoID", $producto->id)->firstOrFail();

        

        //esto es opcional. Al cambiar el idioma se redirecciona a la ruta con el slug correspondiente al idioma seleccionado
        //no es necesario, se puede eliminar, pero queda bien ir actualizando la ruta de modo que el slug se muestre acorde al idioma.
        //al hacer una redireccion de nota un poco, si no gusta el efecto se elimina o se comenta el condicional
        if($traduccion->slug != $slug){
            return redirect()->route("product_show_by_slug", ['slug' => $traduccion->slug]);
        }

        //mostrar vista con los datos que corresponde
        return view("Producto.DetalleProducto", compact("producto"), compact("traduccion"));
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
