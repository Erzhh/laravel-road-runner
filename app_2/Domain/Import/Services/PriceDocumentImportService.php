<?php

namespace Domain\Import\Services;

use App\Domain\Catalog\Services\PriceDocument\PriceDocumentFindOrStoreService;
use Carbon\Carbon;
use Domain\Catalog\Dto\PriceDocumentDto;
use Domain\Catalog\QueryBuilder\PriceType\GetAllPriceType;
use Domain\Catalog\QueryBuilder\Product\FetchProductsByUid;
use Domain\Import\DTO\PriceDocumentImportDTO;
use DomainException;
use Illuminate\Support\Facades\DB;

class PriceDocumentImportService
{

    public function __construct(
        private PriceDocumentImportDTO $apiData
    )
    {}

    public function run(){

        $products_uids = collect( $this->apiData->items )->pluck('product')->toArray();

        $products =   (new FetchProductsByUid(
                                                $products_uids,
                                                ['id','uid'],
                                                []
                                                ))->run();

        $pluck_product = collect($products)->pluck('uid')->toArray();

        $price_types =  (new GetAllPriceType())->run();
        $pluck_price_types = collect($price_types)->pluck('uid','id')->toArray();

        //Ищем пользователя
//        try {
//            $user = (new UserFindByUid( $this->apiData->user_uid ) )->run();
//        }
//        catch (\Exception $e){
//            $u_id = $this->apiData->user_uid;
//            abort(501, "Получить пользователя с uid: $u_id не удается");
//        }

        //Создаем документ
        try {

            $price_dto = new PriceDocumentDto([
                'uid'=> $this->apiData->document_uid,
                'name' => $this->apiData->name,
                'number' => $this->apiData->document_id,
                'user_id'=> 1,
                'user_name'=> $this->apiData->user_name,
                'created_at' => Carbon::parse($this->apiData->date)
            ]);

            $document =  (new PriceDocumentFindOrStoreService($price_dto))->run();

        }catch (\Exception $e){
            $d_uid  = $this->apiData->document_uid;
            throw new DomainException($e->getMessage()??"Запись документа прошло неуспешно или документ с таким $d_uid уже существует",501);
        }

        //Генерация(подбор) данных
        try {
            $created = Carbon::now();

            $dbData = [];
            foreach ($this->apiData->items as $item) {

                $product_key =     $this->ArraySearchOrNullable( $item->product,   $pluck_product );
                $price_type_key =  $this->ArraySearchOrNullable( $item->cost_type, $pluck_price_types );

                if($product_key >= 0){
                    $dbData[] = [
                        'doc_id' => $document->id,
                        'product_id' => $products[$product_key]['id'],
                        'product_uid' => $item->product,
                        'price_old' =>  null,
                        'price_new' => $item->cost,
                        'price_type_id' =>  $price_type_key,
                        'created_at'=> $created
                    ];
                }
            }
        }catch (\Exception $e){
            abort(501, "Подбор историй цены прошло неуспешно");
        }

        //Запись цены историй
        try {
            DB::table('price_histories')->upsert(
                $dbData, // Данные для вставки
                ['doc_id','product_id'] // Поля для проверки уникальности
            );
        }catch (\Exception $e){
            abort(501, "Запись историй цены прошло неуспешно". $e);
        }

    }

    private function ArraySearchOrNullable($array, $compare_array): int|string|null
    {
        $found_array = array_search( $array , $compare_array);
        return $found_array >= 0?$found_array:null;
    }

}
