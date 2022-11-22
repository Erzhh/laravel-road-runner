<?php

namespace Domain\Import\Actions;


use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use App\Domain\GateWay\Telegram\Jobs\SendTelegramMsgJob;
use Domain\Import\DTO\PriceDocumentImportDTO;
use Domain\Import\Interfaces\CatalogRepository;
use Domain\Import\Services\PriceDocumentChangeProductPriceImportService;
use Domain\Import\Services\PriceDocumentImportService;
use DomainException;
use Illuminate\Support\Facades\DB;

class PriceDocumentAction
{
    private CatalogRepository $repository;
    private MessageTelegramDto $message;

    public function __construct(
        private PriceDocumentImportDTO $dto
    ){
        $this->message = new MessageTelegramDto([
           'topic' => '1C отправляет нам цены на документы'
        ]);
    }

    public function run(){
        try {
//            SendTelegramMsgJob::dispatch(   $this->message->getUp("start")  );
                DB::beginTransaction();
                    (new PriceDocumentImportService( $this->dto ))->run();
                    (new PriceDocumentChangeProductPriceImportService( $this->dto ))->run();
                DB::commit();
//            SendTelegramMsgJob::dispatch(   $this->message->getUp("end")  );
        } catch (\Exception $e) {
            SendTelegramMsgJob::dispatch(   $this->message->getUp("failed")  );
                DB::rollback();
            throw new DomainException($e->getMessage()??'Импорт данных неуспешно',$e->getCode()??500);
        }

    }
}
