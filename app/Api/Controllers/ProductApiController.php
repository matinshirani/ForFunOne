<?php

namespace App\Api\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
//use http\Env\Request;
use \Illuminate\Http\Request ;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response as HttpResponse;

class ProductApiController extends Controller
{

    public function __construct(){
        $this->middleware('auth.basic')->only(['store', 'destroy']);
    }

    public function index(){
        $product = Product::with(['user', 'categories'])->get();
        return ['data' => $product];
    }

    public function show($id){
        $product = Product::with(['user', 'categories'])->findOrFail($id);
        return ["data" => $product];
    }


    public function store(Request $request){
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required | numeric",
            "weight" => "required | numeric"
        ]);

        $product = Auth::user()->products()->create($request->except('_token'));
        $productAndCategory = $product->categories()->attach($request->get('category_id'));
        return response()->json(["data" => $productAndCategory] , HttpResponse::HTTP_CREATED);
    }

    public function update(Request $request, $id){
        $product = Product::find($id);
        $productUpdated = $product->update($request->only(['name', 'price', 'weight', 'description']));
        $product->categories()->sync($request->get('category_id'));
        return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();

        return redirect('/products');
    }

}
