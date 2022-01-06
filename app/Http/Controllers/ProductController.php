<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Muestra una colección del recurso
        $products = Product::paginate(10);

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Mostramos un formulario para crear un nuevo item
        // Primero instanciamos la clase Product
        $product = new Product;
        // Pasamos la instancia del product para que no de error en el form.blade.php
        return view('products.create', ['product' => $product]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Se crea el item almacenando en la base de datos
        // Realizamos el array que contenga la información del $request
        // El $request contiene la información del formulario que se envio
        $product = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
        ];

        // Creamos un nuevo registro en la base de datos con create() pasandole el $product
        if (Product::create($product)) {
            // Si se creo correctamente se va a redireccionar
            return redirect('/products');
        } else {
            // Si hubo un error, nuevamente lo mando al formulario para crear el producto
            return view('products.create');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Mostramos algún item
        $product = Product::find($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Se muestra un formulario para editar un item
        $product = Product::find($id);
        return view('products.edit', ['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Se actualiza la información del item
        // Encontramos el producto al que se debe actualizar
        $product = Product::find($id);
        // Tomando la información que se recogio del formulario, le pasamos cada atributo
        $product->name = $request->name;
        $product->description = $request->description;
        $product->price = $request->price;

        // Con save() podemos actualizar el producto con la nueva información
        if ($product->save()) {
            // Si paso correctamente la actualización podemos redireccionar al inicio
            return redirect('/products');
        } else {
            // Sino nuevamente lo manda al formulario de actualización
            return view('products.edit', ['product' => $product]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Se elimina el item con el id que se le pasa por parámetros
        Product::destroy($id);
        return redirect('/products');
    }
}
