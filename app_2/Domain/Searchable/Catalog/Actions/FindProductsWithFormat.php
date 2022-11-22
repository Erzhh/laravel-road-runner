<?php

namespace App\Domain\Searchable\Catalog\Actions;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Searchable\Catalog\Dto\CategoryProductDto;
use Domain\Searchable\Catalog\Services\FindCategoryWithProduct;
use Illuminate\Support\Facades\DB;

class FindProductsWithFormat{

    public function __construct(
        private CategoryProductDto $dto,
        private RequestParamsDTO $request
    ){}

    public function run(){
        $products = (new FindCategoryWithProduct($this->dto,$this->request))->run();

//        $uids_products =  $products->pluck('uid')->toArray();
//        $formats =  DB::table('formats_products')->whereIn('product_uid',$uids_products)->get();
//        $products->each(function ($item, $key) {
//                dd($item);
//        });

        return $products;
    }
}
