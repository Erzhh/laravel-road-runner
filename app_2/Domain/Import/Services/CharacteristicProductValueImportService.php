<?php

namespace Domain\Import\Services;

use App\Domain\Prices\Characteristic\QueryBuilder\Characteristics\GetAllCharacteristic;
use App\Domain\Prices\Characteristic\QueryBuilder\CharacteristicsValue\GetAllCharacteristicValue;
use Domain\Import\Helpers\ImportHelper;
use Domain\Import\Interfaces\CatalogRepository;
use DomainException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CharacteristicProductValueImportService
{
    private CatalogRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRepository::class);
    }

    /**
     * Сохраняет в БД список тип цен
     *
     *  $apiData[0] = [
     *   "Продувание": [
     *       "6ed22943-587c-11ea-80b8-04d4c4d2e516",
     *       "a408a54f-19c4-11ec-80c0-04d4c4d2e517"
     *   ],
     *  ];
     *
     * @return void
     */
    public function run(){
        $apiData = $this->repository->getCharacteristicProductsValue();

//        dd($apiData);
        try {
            $db_characteristics = (new GetAllCharacteristic())->run();
            $pluck_characteristics =   $db_characteristics->pluck('property','id')->toArray();
        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при выборке всех характеристик CharacteristicProductImportService');
        }

        try {
            $db_characteristics_values = (new GetAllCharacteristicValue())->run()->toArray();
        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при выборке всех характеристик продуктов CharacteristicProductImportService');
        }

//        $apiData = collect($apiData)->chunk(2000)->toArray();

        try {
            $characteristic_products  = [];
            foreach ($apiData as $k => $item) {

                $uid =$item['product'];
                unset($item['name_kz']);
                unset($item['parent']);
                unset($item['product']);


                foreach ($item as $key => $value){

                    $characteristic_id = ImportHelper::ArraySearchOrNullable( $key, $pluck_characteristics );

                    if($characteristic_id){

                        $filter = array_filter($db_characteristics_values, function ($item)
                        use($characteristic_id, $value){
                            if(
                                $item['characteristic_id'] == $characteristic_id &&
                                $item['title'] == $value
                            ){
                                return $item['id'];
                            }
                        });



                        $characteristic_products[] = [
                            'characteristic_id' => $characteristic_id,
                            'characteristic_value_id'=> count($filter)?$filter[array_key_first($filter)]['id']:null,
                            'product_uid'=> $uid,
                            "order"=>1,
                            "is_visible"=>true,
                            "is_view_text"=>true,
                        ];
                    }


                }
            }
//            dd($characteristic_products);
            $characteristic_products_chunk = collect( $characteristic_products )->chunk(2000)->toArray();

            foreach ($characteristic_products_chunk as $characteristic_product){

                DB::table('characteristics_products')->upsert(
                    $characteristic_product,
                    ["characteristic_id","product_uid","order","is_visible","is_view_text"], // Поля для проверки уникальности
                    ['characteristic_value_id']
                );

            }

        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при формирований и сохранений проуктов характеристик CharacteristicProductValueImportService ');
        }

    }
}
