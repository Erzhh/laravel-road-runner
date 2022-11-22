<?php

namespace Domain\Import\Services;

use App\Domain\Prices\Characteristic\QueryBuilder\Characteristics\GetAllCharacteristic;
use App\Domain\Prices\Characteristic\QueryBuilder\Characteristics\GetAllPaginateCharacteristic;
use Carbon\Carbon;
use Core\Request\DTO\RequestParamsDTO;
use Domain\Import\Helpers\ImportHelper;
use Domain\Import\Interfaces\CatalogRepository;
use DomainException;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class CharacteristicImportService
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
     *    "Продувание": [
     *        "Jet Air"
     *     ],
     *  ];
     *
     * @return void
     */
    public function run(){
        $apiData = $this->repository->getCharacteristics();


        try {
            $characteristics = [];
            foreach ($apiData as $key => $item) {
                $characteristics[] = ['property' => $key];
            }

            DB::table('characteristics')->upsert(
                $characteristics, // Данные для вставки
                ['property'] // Поля для проверки уникальности
            );

            $db_characteristics = (new GetAllCharacteristic())->run();

            $pluck_characteristics =   $db_characteristics->pluck('property','id')->toArray();

        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при формирований и сохранений характеристик CatalogRepository');
        }


        try {
            $characteristic_values  = [];

            $created_at  = Carbon::now();

            foreach ($apiData as $key => $item) {

                $characteristic_id = ImportHelper::ArraySearchOrNullable($key, $pluck_characteristics );

                if($characteristic_id){

                    foreach ($item  as $value){
                        $characteristic_values[] = [
                            'title' => $value,
                            'characteristic_id' => $characteristic_id,
                        ];
                    }
                }
            }

            $characteristic_values_chunk = collect( $characteristic_values )->chunk(2000)->toArray();
            foreach ($characteristic_values_chunk as $characteristic_value){
                DB::table('characteristic_values')->upsert(
                    $characteristic_value,          // Данные для вставки
                    ['title','characteristic_id']   // Поля для проверки уникальности
                );
            }

        }
        catch (\Exception $e){
            throw new DomainException('Ошибка при формирований и сохранений значений характеристик CatalogRepository');
        }

    }
}
