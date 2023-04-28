@extends('layouts.app')
@section('content')
    <h1><strong>{{$product->name}}</strong></h1>
    <h3>{{"Price : " . $product->price}}</h3>
    <h3>{{"Weight : " . $product->weight}}</h3>
    <p>{{"Description : " . $product->description}}</p>
    <p>Creator : {{$product->user->name}}</p>
    <p>Categories:</p>
    @foreach($product->categories as $category)
        <em>{{$category->name . ''}}</em>
    @endforeach
@endsection
