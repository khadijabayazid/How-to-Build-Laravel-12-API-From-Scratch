<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use F9Web\ApiResponseHelpers;
use phpDocumentor\Reflection\Types\This;

/**
 * @group Products
 * 
 * Managing Products
 */
class ProductController extends Controller
{
    use ApiResponseHelpers;

    public function index(){
        $products = Product::with('category')->paginate(9);
        return $this->respondWithSuccess($products);
    }
}
