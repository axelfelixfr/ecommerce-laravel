@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card p-2">
            <header>
                <h3 class="text-center">Mi carrito de compras</h3>
            </header>

            <div class="card-body">
                {{-- @foreach ($products as $product)
                    <div>
                        <p>{{ $product->name }}</p>
                    </div>
                @endforeach --}}
                <div class="row">
                    <div class="col-12 col-md-6">
                        <shopping-cart-products-component></shopping-cart-products-component>
                    </div>
                    <div class="col-12 col-md-6 payments">
                        <p>Paga tu total facilmente con cualquiera de estos métodos, a través de Paypal</p>
                        <img src="/images/paypal.png" width="150" alt="Paypal">
                        <img src="/images/creditcardicons.png" width="150" alt="Credit Cards">
                        <div>
                            <a href="/payment" class="btn btn-primary">Proceder a pagar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
