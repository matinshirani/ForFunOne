<?php

namespace App\Http\Controllers;

use App\Mail\SendProductCreated;
use App\Models\Category;
use App\Models\Product;
use App\Providers\ProductCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\HttpFoundation\Response as HttpRseponse ;

class ProductController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->only(['create', 'edit']);
    }

    public function index(){
        $products=Product::with('user')->get();
        return view('products.index', compact('products'));
    }

    public function show($id){
        $product=Product::with('categories')->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function create(){
        $categories=Category::all();
        return view('products.create', compact('categories'));
    }


    public function store(Request $request){
        $request->validate([
            "name" => "required",
            "description" => "required",
            "price" => "required | numeric",
            "weight" => "required | numeric"
        ]);
        $product = Auth::user()->products()->create($request->except('_token'));
        $product->categories()->attach($request->get('category_id'));
        $user=Auth::user();
        event(new ProductCreated($product, $user));
        return redirect('/products');

    }

    public function edit($id){
        $product=Product::find($id);
//        abort_if($product->user_id != Auth::user()->id, HttpRseponse::HTTP_UNAUTHORIZED );
        $this->authorize('update', $product);
        $categories=Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id){
        $product=Product::find($id);
        $product->update($request->only(['name', 'weight', 'price', 'description']));
        $product->categories()->sync($request->get('category_id'));
        return redirect('/products');
    }

    public function destroy($id){
        $product = Product::find($id);
        $product->delete();
        return redirect('/products');
    }


}
