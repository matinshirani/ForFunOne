@extends('layouts.app')
@section('content')
    <div style="border: 3px solid #48484e; margin: 100px auto; width: 300px; border-radius: 5px; padding: 5px;">
        <table>

            <tr><span style="color: grey; margin-right: 10px;">Product Name</span></tr>
            <tr><span style="color: grey; margin-right: 10px;">Creator</span></tr>
            <tr><span style="color: grey; margin-right: 10px;"></span></tr>


                @foreach($products as $product)
                    <tr>
                        <td>
                            <a style="color: #2563eb;  margin-right: 10px;" href="{{route('products.show', ['id' => $product->id])}}">{{$product->name}}</a>
                        </td>
                        <td>
                            <p style=" margin-right: 10px;">{{$product->user->name}}</p>
                        </td>
                        @can('update', $product)
                            <td>
                                <button style="color: forestgreen;margin-right: 10px;"><a href="{{route('products.edit', ['id' => $product->id])}}">update</a></button>
                            </td>
                        @endcan
                        @can('delete' , $product)
                            <form action="{{route('products.destroy', ['id' => $product->id])}}" method="post">
                                @method('delete')
                                {{csrf_field()}}
                                <td>
                                    <button style="color: darkred">delete</button>
                                </td>

                            </form>
                        @endcan
                    </tr>
            @endforeach
        </table>
        <div>
            <button style="background-color: blueviolet; border-radius: 3px;">
                <a  href="{{route('products.create')}}">Create</a>
            </button>
        </div>
    </div>
@endsection
