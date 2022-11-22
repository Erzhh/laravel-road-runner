<?php

namespace API\Catalog\Controllers;

use API\Catalog\Requests\CategoryRequest;
use API\Catalog\Resources\CategoryPaginateResource;
use API\Catalog\Resources\CategoryResource;
use API\Catalog\Resources\CategoryTreeResource;
use Core\BaseController;
use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\Actions\CategoryGetAllBrandAction;
use Domain\Catalog\Models\Category;
use Domain\Catalog\QueryBuilder\Category\FindCategoryById;
use Domain\Catalog\QueryBuilder\Category\GetAllCategory;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;

class CategoryController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(): AnonymousResourceCollection
    {
//        if ($cached = Cache::get('categories_tree')) return $cached;

        $dto = new RequestParamsDTO([
            'include' => ['children']
        ]);

        $categories = (new GetAllCategory( $dto ))->run();
        $res = CategoryTreeResource::collection($categories);

//        Cache::put('categories_tree', $res, now()->addHours(1));

        return $res;
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function list(CategoryRequest $request): AnonymousResourceCollection
    {
        $dto = $request->getData();
        $categories = (new GetAllCategory(request: $dto))->run();

        return CategoryResource::collection($categories);
    }

    public function brands(CategoryRequest $request): CategoryPaginateResource
    {
        $categories = (new CategoryGetAllBrandAction( $request->getData() ))->run();

        return new CategoryPaginateResource($categories);
    }

    /**
     * Display the specified resource.
     *
     * @param int $category
     * @return CategoryResource
     */
    public function show(CategoryRequest $request ,$category): CategoryResource
    {
        $category = (new FindCategoryById($category, $request->getData()))->run();
        return new CategoryResource($category);
    }

    public function format(Request $request, Category $category){
        $category->formats()->sync($request->input('formats'));
    }

}
