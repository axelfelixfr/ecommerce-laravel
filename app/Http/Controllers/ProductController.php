<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductsCollection;
use App\Models\Product;
use App\Models\ShoppingCart;
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
    // Muestra una colección del recurso
    public function index(Request $request)
    {
        $products = Product::paginate(10);

        // El método "wantsJson" determina si en la request se espera un resultado en JSON
        if ($request->wantsJson()) {
            // Retornamos el resultado en JSON
            // return $products->toJson();
            return new ProductsCollection($products);
        }

        return view('products.index', ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // Mostramos un formulario para crear un nuevo item
    public function create()
    {
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
    // Se crea el item almacenando en la base de datos
    public function store(Request $request)
    {
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
    // Mostramos algún item
    public function show($id)
    {
        $product = Product::find($id);
        return view('products.show', ['product' => $product]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // Se muestra un formulario para editar un item
    public function edit($id)
    {
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
    // Se actualiza la información del item
    public function update(Request $request, $id)
    {
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
    // Se elimina el item con el id que se le pasa por parámetros
    public function destroy($id)
    {
        Product::destroy($id);
        return redirect('/products');
    }
}
