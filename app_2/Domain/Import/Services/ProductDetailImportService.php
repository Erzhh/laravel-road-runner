<?php

namespace Domain\Import\Services;

use Domain\Catalog\QueryBuilder\Product\FetchProductsByUid;
use Domain\Import\Interfaces\CatalogRepository;
use Domain\Import\Repositories\CatalogRemoteRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class ProductDetailImportService
{
    private CatalogRemoteRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRemoteRepository::class);
    }

    /**
     * Сохраняет в БД список дополнительных инфо для продуктов
     *
     *  $apiData[0] = [
     *      {
     *          "product": "4c46c1d5-dc79-11ea-80bc-04d4c4d2e516",
     *          "name_kz": "Тоңазытқыштарға арналған аксессуарлар",
     *          "name_ru": "Аксессуары для холодильников",
     *          "description": "Нижняя панель для холодильника BESPOKE RA-B23DBB05GG Графит"
     *      },
     * ];
     *
     * @return void
     */
    public function run(){
        $apiData = $this->repository->getProductsDetail();

        $products_uids = collect( $apiData )->pluck('product')->chunk(2000)->toArray();

        //Импорт продуктов
        try {
                $products_uids_data = [];
                foreach ($products_uids as $products_uid){

                    $products =   (new FetchProductsByUid(
                                        $products_uid,
                                        ['id','uid'],
                                        []
                                    ))->run();
                        foreach ($products as $product){
                            $products_uids_data[] = $product;
                        }
                }
                $pluck_product = collect($products_uids_data)->pluck('uid')->toArray();

        }catch (\Exception $e){
            abort(501, "импорт продуктов (в ProductDetailImportService) прошло неуспешно");
        }

        //Генерация(подбор) данных
        try {
            $dbData = [];
            foreach ($apiData as $item) {

                $product_key =     $this->ArraySearchOrNullable( $item['product'], $pluck_product );

                if($product_key){
                    $dbData[] = [
                        'product_id' => $products_uids_data[$product_key]['id'],
                        'product_uid' => $item['product'],
                        'name_kz'=> $item['name_kz'],
                        'name_ru'=> $item['name_ru'],
                        'article' => $item['vendor_code'],
                        'description'=> $item['description']
                    ];
                }

            }
        }catch (\Exception $e){
            abort(501, "Подбор дополнительных инфо для продуктов прошло неуспешно");
        }

        //Запись дополнительных инфо для продуктов
        try {
            $dbData = collect($dbData)->chunk(2000)->toArray();
            foreach ($dbData  as $readyData){
                DB::table('product_details')->upsert(
                    $readyData, // Данные для вставки
                    ['product_id', 'product_uid'] // Поля для проверки уникальности
                );
            }
        }catch (\Exception $e){
            abort(501, "Запись дополнительных инфо для продуктов прошло неуспешно ".$e);
        }

    }

    private function ArraySearchOrNullable($array, $compare_array): int|string|null
    {
        $found_array = array_search( $array , $compare_array);
        return $found_array?$found_array:null;
    }

}
