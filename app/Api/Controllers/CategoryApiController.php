<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class CategoryApiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.basic')->only('store');
    }

    public function index(){
        $categories = Category::all();
        return ["data" => $categories];
    }

    public function store(Request $request){
        $request->validate(
            ["name" => "required"]
        );
        $category = Category::create($request->except('_token'));
        return response()->json(["data" => $category, HttpResponse::HTTP_CREATED]);
    }
    public function destroy($id){
        $category = Category::find($id);
        $category->delete();

        return redirect('/categories');
    }
}
