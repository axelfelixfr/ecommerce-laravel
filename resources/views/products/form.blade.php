{!! Form::open(['route' => [$product->url(), $product->id ? $product->id : null], 'method' => $product->method()]) !!}

<div>
    {!! Form::label('name', 'Nombre del producto') !!}
    {!! Form::text('name', $product->name, ['class' => 'form-control']) !!}
</div>

<div class="pt-2">
    {!! Form::label('description', 'Descripción del producto') !!}
    {!! Form::textarea('description', $product->description, ['class' => 'form-control']) !!}
</div>

<div class="pt-2">
    {!! Form::label('price', 'Precio del producto') !!}
    {!! Form::number('price', $product->price, ['class' => 'form-control']) !!}
</div>

<div class="text-center pt-2">
    {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
</div>

{!! Form::close() !!}
