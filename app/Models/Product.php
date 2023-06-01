<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'unit_price'];

    public static function searchProducts($params)
    {
        $products = Product::when($params['name'], function($query, $name) {
            return $query->where('products.name', 'LIKE', "%".$name."%");
       })->OrderBy($params['sortColumn'], $params['sortOrder'])->paginate($params['paginate']);

       return $products;
    }
}
