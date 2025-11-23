<?php

namespace App\Http\Controllers\Api\v2;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;
use Orion\Concerns\DisableAuthorization;
use Orion\Http\Controllers\Controller;



class CategoryController extends Controller
{
    use DisableAuthorization;
    protected $model = Category::class;
}
