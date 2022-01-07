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
                        {{-- {!! Form::open(['method' => 'POST', 'url' => '/shopping_cart']) !!}
                        {!! Form::hidden('product_id', $product->id) !!}
                        {!! Form::submit('Agregar al carrito', ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!} --}}
                        <add-to-cart-component :product='{!! json_encode($product) !!}'></add-to-cart-component>
                        @include('products.delete')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
