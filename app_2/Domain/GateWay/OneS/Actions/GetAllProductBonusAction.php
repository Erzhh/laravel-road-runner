<?php
namespace Domain\GateWay\OneS\Actions;

use App\Domain\GateWay\OneS\Services\FetchProductsBonusService;
use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\Product\GetAllProducts;
use Illuminate\Support\Facades\DB;

class GetAllProductBonusAction{

    private int $max_page_count = 2;

    public function __construct(
        private $output = null
    )
    {
        $dto =  new RequestParamsDTO(['page'=> 1]);
        $product_bonus = (new FetchProductsBonusService($dto))->run();
        $count_page = $product_bonus['data']['_meta']['pageCount'];
        $this->max_page_count = $count_page;
    }

    public function run(){

        $dto = new RequestParamsDTO([ 'fields' => ['uid','code'] ]);
        $all_products =  (new GetAllProducts($dto))->run();
        $products_uids = $all_products->pluck('code','uid')->toArray();

        for($i = 1; $i <= $this->max_page_count; $i++ ){
            $apiData = [];

            $dto =  new RequestParamsDTO([
                'page'=> $i
            ]);
            $products = (new FetchProductsBonusService($dto))->run();

            foreach ($products['data']['items'] as $product){

                $code = $this->make_correct_code($product['art_id']);
                $products_uid = $this->ArraySearchOrNullable($code, $products_uids);

                $apiData[] = [
                    'product_uid' => $products_uid,
                    'bonus' => $product['max_cashback']==0?5:$product['max_cashback'],
                ];
            }

            DB::table('product_bonuses')->upsert(
                $apiData, // Данные для вставки
                ['product_uid']
            );

            if($this->output){
                $this->output->progressAdvance();
            }
        }

    }

    private function make_correct_code($article){
        if($article){
            $code = $article;
            $two_letter = $article[0].$article[1];

            if($two_letter == 54){
                $str = mb_substr($article, 2);
                $code = 'HQ'.$str;
            }else if ($two_letter == 98){
                $str = mb_substr($article, 2);
                $code = 'RS'.$str;
            }

            return $code;
        }
        return '';
    }

    private function ArraySearchOrNullable($array, $compare_array): int|string|null
    {
        $found_array = array_search( $array , $compare_array);
        return $found_array>=0?$found_array:null;
    }
}
