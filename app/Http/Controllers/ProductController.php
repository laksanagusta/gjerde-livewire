<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Http\Services\ProductService;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', $products);
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(ProductRequest $request, ProductService $productService)
    {
        $productService->updateOrCreate($request->all());
        return view('products.index', [
            'products' => Product::paginate(10)
        ]);
    }

    public function show(string $id)
    {
        
    }

    public function edit(string $id)
    {
        $product = Product::find($id);
        return view('products.edit', [
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, string $id)
    {
        
    }

    public function destroy(string $id)
    {
        
    }
}
