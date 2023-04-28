@extends('layouts.app')
@section('content')

    <div style="border: 3px solid #48484e; margin: 100px auto; width: 350px; border-radius: 5px; padding: 5px;">
        <form action="{{route('products.update',['id' => $product->id])}}" method="post">
            @csrf
            @method('put')
            <div class="form-group">
                <div>
                <label for="formGroupExampleInput">{{__('messages.name')}}</label>
                </div>
                <input value="{{$product->name}}" style="border-radius: 7px ; margin: 5px; border:3px solid grey; " name="name" type="text" class="form-control" id="formGroupExampleInput" placeholder="Enter your number">
            </div>
            <div class="form-group">
                <div>
                <label for="formGroupExampleInput2">{{__('messages.description')}}</label>
                </div>
                <input value="{{$product->description}}" style="border-radius: 7px ; margin: 5px; border:3px solid grey; "  name="description" type="text" class="form-control" id="formGroupExampleInput2" placeholder="Enter description">
            </div>
            <div class="form-group">
                <div>
                <label for="formGroupExampleInput2">{{__('messages.weight')}}</label>
                </div>
                <input value="{{$product->weight}}" style="border-radius: 7px ; margin: 5px; border:3px solid grey; " name="weight" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Enter weight">
            </div>
            <div class="form-group">
                <div>
                <label for="formGroupExampleInput2">{{__('messages.price')}}</label>
                </div>
                <input value="{{$product->price}}" style="border-radius: 7px ; margin: 5px; border:3px solid grey; " name="price" type="number" class="form-control" id="formGroupExampleInput2" placeholder="Enter price">
            </div >
            <div>
                <div>
                <label>{{__('messages.categories')}}</label>
                </div>
                <select name="category_id[]" multiple style="border: 3px solid grey; border-radius: 7px;">
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"
                        {{$product->categories->contains("id", $category->id) ? 'selected' : ''}}
                        >{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <input type="submit"  style="background-color: blueviolet; border-radius: 3px;" />
        </form>
        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

@endsection
