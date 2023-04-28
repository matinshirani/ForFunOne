@extends('layouts.app')
@section('content')
    <div style="border: 3px solid #48484e; margin: 100px auto; width: 175px; border-radius: 5px; padding: 5px;">
        <table>

            <tr>
                <th>{{__('messages.name')}}</th>
                <th></th>
            </tr>

            @foreach($categories as $category)
                <tr>
                    <td>
                        {{$category->name}}
                    </td>
                        <form method="post" action="{{route('categories.destroy', ['id' => $category->id])}}">
                            @csrf
                            @method('delete')
                            <td>
                            <button style="color: darkred; padding-left: 10px;">delete</button>
                            </td>
                        </form>
                </tr>
            @endforeach
        </table>
        <div>
            <button style="background-color: blueviolet; border-radius: 3px;">
                <a href="{{route('categories.create')}}">Create</a>
            </button>
        </div>
    </div>

@endsection
