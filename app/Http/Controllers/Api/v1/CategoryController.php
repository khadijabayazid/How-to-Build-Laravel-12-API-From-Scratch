<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;



class CategoryController extends Controller
{
    /**
     * @OA\Get(
     *  path="/categories",
     *  tags={"Categories"},
     *  summary="Get list of categories",
     *  @OA\Response(
     *      response=200,
     *      description="Successful operation",
     *  ),
     *  @OA\Response(
     *      response=401,
     *      description="Unauthenticated",
     *  ),
     *  @OA\Response(
     *      response=403,
     *      description="Forbidden",
     *  )
     * )
     */
    public function index()
    {
        // return Category::all();
        abort_if(!auth()->user()->tokenCan('categories-list'), 403);
        return CategoryResource::collection(Cache::rememberForever('categories', function(){
            return Category::all();
        }));
    }

    public function show(Category $category)
    {
        // return $category;
        abort_if(!auth()->user()->tokenCan('categories-show'), 403);
        return new CategoryResource($category);
    }

    public function list()
    {
        return CategoryResource::collection(Category::all());
    }

    /**
     * Post categories
     * 
     * @bodyParam name string required Name of the category. Example: "Clothing
     */
    public function store(StoreCategoryRequest $request)
    {
        $data = $request->all();
        if ($request->hasFile('photo')) {
            $file = $request->file('photo');
            $name = 'categories/' . Str::uuid() . '.' . $file->extension();
            $file->storePubliclyAs('public', $name);
            $data['photo'] = $name;
        }
        $category = Category::create($data);
        return new CategoryResource($category);
    }

    public function update(Category $category, StoreCategoryRequest $request)
    {
        $category->update($request->all());
        return new CategoryResource($category);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        // return response(null, Response::HTTP_NO_CONTENT);
        return response()->noContent();
    }
}
