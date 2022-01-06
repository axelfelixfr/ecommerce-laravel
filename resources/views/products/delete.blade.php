@auth
    {!! Form::open(['method' => 'DELETE', 'route' => ['products.destroy', $product->id], 'onsubmit' => 'return confirm("¿Estás seguro de eliminar este producto?")']) !!}
    {!! Form::submit('Eliminar producto', ['class' => 'btn btn-danger ms-2']) !!}
    {!! Form::close() !!}
@endauth
