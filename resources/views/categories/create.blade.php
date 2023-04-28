@extends('layouts.app')
@section('content')
    <div style="border: 3px solid #48484e; margin: 100px auto; width: 350px; border-radius: 5px; padding: 5px;">
    <form method="post" action="{{route('categories.store')}}">
        @csrf
        <div>
            <label>{{__('messages.name')}}</label>
            <input type="text" style="border-radius: 7px ; margin: 5px; border:3px solid grey; " name="name" required>
        </div>
        <div>
            <input type="submit" style="background-color: blueviolet; border-radius: 3px;" value="Create">
        </div>
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
