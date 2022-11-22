<?php

namespace API\Catalog\Controllers;

use API\Catalog\Requests\StockRequest;
use API\Catalog\Resources\ProductStocksResource;
use Core\BaseController;
use API\Catalog\Resources\StockResource;

use Domain\Catalog\Models\Product;
use Domain\Catalog\QueryBuilder\Stock\FindFormatById;
use Domain\Catalog\QueryBuilder\Stock\FindStocksByProduct;
use Illuminate\Http\Request;

class StockController extends BaseController
{
    public function show($warehouse_id, $product_id, $quality_id, StockRequest $request){
        $stock = (new FindFormatById($warehouse_id, $product_id, $quality_id, $request->getData()->include))->run();
        return new StockResource($stock);
    }

    public function product(Product $product, Request $request){

        $stocks = (new FindStocksByProduct([$product->id],
            $request->input('warehouse_id'),
            $request->input('quality_id'),
        ))->run();

        return ProductStocksResource::collection($stocks);
    }

}
