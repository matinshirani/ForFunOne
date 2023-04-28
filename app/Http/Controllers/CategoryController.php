<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct(){
        $this->middleware("auth")->except('index');
    }
    public function index(){
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $request->validate([
           "name" => "required"
        ]);

        Category::create($request->except("_token"));
        return redirect('/categories');
    }

    public function destroy($id){
        $category = Category::find($id);
        $category->delete();
        return redirect('/categories');
    }
}
