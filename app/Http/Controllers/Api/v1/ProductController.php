<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

/**
 * @group Products
 * 
 * Managing Products
 */
class ProductController extends Controller
{
    public function index(){
        $products = Product::with('category')->paginate(9);
        return ProductResource::collection($products);
    }
}
