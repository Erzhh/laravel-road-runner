<?php

namespace API\Searchable\Catalog\Controllers;

use API\Catalog\Resources\CategoryShortResource;
use API\Catalog\Resources\PriceHistoryPaginateRecourse;
use API\Catalog\Resources\ProductPaginateResource;
use API\Catalog\Resources\ProductResource;
use API\Searchable\Catalog\Request\CategoriesProductRequest;
use App\Domain\Searchable\Catalog\Actions\FindProductsWithFormat;
use Core\BaseController;
use Domain\Searchable\Catalog\Services\FindCategoryWithProduct;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CategorySearchController extends BaseController
{

    /**
     * Поиск продуктов с помощью категорий
     * @queryParam categories required string Example: 1,2,3
     * @queryParam search string nullable min:3 Example: Алю
     *
     * @response 200
     * [{"type":"categories","id":1,"attributes":{"name":"Материалы"},"included":{"products":[{"type":"products","id":104,"attributes":{"uid":"67e30914-322f-11ec-8106-04d4c4d2bb6f","name":"Алюминиевый профиль оконная рама (6м-3,6кг)","category_id":1,"code":"87000002253"},"included":[]},{"type":"products","id":105,"attributes":{"uid":"784e0010-322f-11ec-8106-04d4c4d2bb6f","name":"Алюминиевый профиль оконный импост (6м-4,2кг)","category_id":1,"code":"87000002254"},"included":[]},{"type":"products","id":106,"attributes":{"uid":"8a009f20-322f-11ec-8106-04d4c4d2bb6f","name":"Алюминиевый штапик пакет (6м-1,33кг)","category_id":1,"code":"87000002255"},"included":[]},{"type":"products","id":7223,"attributes":{"uid":"a07f1de2-4d18-11ec-810c-04d4c4d2bb6f","name":"Стекловата в рулонах без алюминиевой фольги","category_id":1,"code":"87000002435"},"included":[]},{"type":"products","id":17019,"attributes":{"uid":"6167d43c-5074-11ec-810f-04d4c4d2bb6f","name":"Радиатор алюминиевый (1секц) 500х96 Protech","category_id":1,"code":"87000002476"},"included":[]}]}}]
     */
    public function categories_product(CategoriesProductRequest $request)
    {
        $dto = $request->getDto();
        $request = $request->getData();
        $products = (new FindProductsWithFormat($dto,$request))->run();

//        return  ProductResource::collection($products);
        return new ProductPaginateResource($products);
    }
}
