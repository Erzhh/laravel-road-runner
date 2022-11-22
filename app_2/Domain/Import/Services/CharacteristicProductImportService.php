<?php

namespace Domain\Import\Services;

use App\Domain\Prices\Characteristic\QueryBuilder\Characteristics\GetAllCharacteristic;
use Domain\Import\Helpers\ImportHelper;
use Domain\Import\Interfaces\CatalogRepository;
use DomainException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CharacteristicProductImportService
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
        $apiData = $this->repository->getCharacteristicProducts();

        try {
            $db_characteristics = (new GetAllCharacteristic())->run();

            $pluck_characteristics =   $db_characteristics->pluck('property','id')->toArray();
        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при выборке всех характеристик CharacteristicProductImportService ');
        }

        try {
            $characteristic_products  = [];

            foreach ($apiData as $key => $item) {

                $characteristic_id = ImportHelper::ArraySearchOrNullable($key, $pluck_characteristics );

                if($characteristic_id){
                    foreach ($item  as $value){

                        $characteristic_products[] = [
                            'characteristic_id' => $characteristic_id,
                            'product_uid' => $value,
                            'order' => 1,
                            'is_visible' => true,
                            'is_view_text' => true,
                        ];
                    }
                }
            }

            $characteristic_products_chunk = collect( $characteristic_products )->chunk(2000)->toArray();

            foreach ($characteristic_products_chunk as $characteristic_product){
                DB::table('characteristics_products')->upsert(
                    $characteristic_product, // Данные для вставки
                    ['characteristic_id','product_uid'] // Поля для проверки уникальности
                );
            }

        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при формирований и сохранений проуктов характеристик CharacteristicProductImportService ');
        }

    }
}
