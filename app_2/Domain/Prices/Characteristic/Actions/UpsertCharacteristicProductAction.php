<?php

namespace App\Domain\Prices\Characteristic\Actions;

use Domain\Prices\Characteristic\QueryBuilder\CharacteristicProductQuery;
use Illuminate\Support\Facades\DB;

class UpsertCharacteristicProductAction {

    public function __construct(
        public array $dto
    ){}

    public function run()
    {
        $all_data = array_chunk($this->dto ,1000);

        $table = (new CharacteristicProductQuery())->getModel()->getTable();

        try {
            DB::beginTransaction();
                foreach ($all_data as $data){
                    $generate_to_array =  collect( $data )
                        ->map(function ($q){
                            return $q->toArray();
                        })
                        ->toArray();

                    DB::table($table)->upsert(
                        $generate_to_array,
                        ['id','characteristic_id','product_uid'],
                        ['is_view_text','is_visible','order']
                    );
                }
            DB::commit();
        }
        catch (\Exception $exception){
            DB::rollback();
            return abort($exception->getCode(),$exception->getMessage());
        }
    }
}
