<?php

namespace App\Http\Services;
use App\Models\Product;

class ProductService {
    private $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function create($data){
        $this->product->create($data);
    }

    public function findById($id){
        return Product::find($id);
    }

    public function updateOrCreate($data): Product{
        $updatedProduct = $this->product->updateOrCreate(
            ['id' => $data['id'] ?? 0], 
            $data
        );

        return $updatedProduct;
    }
    
}