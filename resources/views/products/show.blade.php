@extends('layouts.app')

@section('content')
    <div class="row justify-content-sm-center">
        <div class="col-12 col-sm-10 col-md-7 col-lg-6">
            <div class="card">
                <header class="text-center p-2 bg-primary"></header>

                <div class="card-body p-2">
                    <h1 class="card-title">{{ $product->name }}</h1>
                    <h4 class="card-subtitle">{{ $product->price }}</h4>

                    <p class="card-text">{{ $product->description }}</p>

                    <div class="card-footer d-flex p-2">
                        <button type="button" class="btn btn-success">Agregar al carrito</button>
                        @include('products.delete')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
