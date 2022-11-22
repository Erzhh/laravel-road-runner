<?php

namespace API\Catalog\Controllers;

use API\Catalog\Collections\ProductCollection;
use API\Catalog\Requests\ProductRequest;
use API\Catalog\Requests\ProductStockRequest;
use API\Catalog\Resources\ProductResource;

use API\Catalog\Resources\ProductWithArticleResource;
use Domain\Catalog\Models\Product;
use Domain\Catalog\QueryBuilder\Product\FetchProductWithStock;
use Domain\Catalog\QueryBuilder\Product\FindProductById;
use Domain\Catalog\QueryBuilder\Product\GetProducts;

use Core\BaseController;
use Illuminate\Http\Request;

class ProductController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return ProductCollection
     */
    public function index(ProductRequest $request)
    {
        $categories = (new GetProducts(
            $request->input('category_id'),
            $request->getData()
        ))->run();

        return new ProductCollection($categories);
    }

    /**
     * @param Product $product
     * @return ProductResource
     */
    public function show(ProductRequest $request, Product $product)
    {
        $product_data = (new FindProductById($product->id, $request->getData()->include))->run();
        return new ProductResource($product_data);
    }

    /**
     * Товары поиск по uid,stock
     * @queryParam include string Example: detail,stock
     *
     * @bodyParam uid array required Example: ['*****','*****']
     * @bodyParam warehouse_id integer required Example: 1
     * @bodyParam quality_id integer required Example: 1
     *
     * @response 200
     * [{"type":"products","id":31377,"attributes":{"name":"Camileo H30"},"included":{"stock":[{"type":"stock","id":null,"attributes":{"warehouse_id":9,"product_id":31377,"quality_id":1,"quantity":14},"included":[]}],"detail":{"type":"product-details","id":35508,"attributes":{"product_id":31377,"product_uid":"2028a7c1-51d1-11e1-bfad-0027133dad0a","name_kz":"Бейнекамера","name_ru":"Видеокамера","article":"","description":""}}}}]
     */
    public function products(ProductStockRequest $request){

        $dto = $request->getDto();

        $products = (new FetchProductWithStock($dto,$request->getData()->include))->run();

        return ProductWithArticleResource::collection( $products );
    }

    public function format(Request $request, Product $product){
        $product->formats()->sync($request->input('formats'));
    }

}
