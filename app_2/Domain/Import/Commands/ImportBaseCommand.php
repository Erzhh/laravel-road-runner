<?php

namespace App\Domain\Import\Commands;


use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use App\Domain\GateWay\Telegram\Jobs\SendTelegramMsgJob;
use Illuminate\Support\Facades\DB;

class ImportBaseCommand
{
    private string $source = 'Domain\\Import\\Services\\';

    public function __construct(
        public string $className,
        private MessageTelegramDto $dto,
        ?string $core_path = null
    ){
        if($core_path){
            $this->source = $core_path;
        }
    }

    public function run(){
        try {
            SendTelegramMsgJob::dispatch(   $this->dto->getUp("start")  );

                DB::beginTransaction();

                    $className =  $this->source.$this->className;
                    (new $className())->run();

                DB::commit();

            SendTelegramMsgJob::dispatch( $this->dto->getUp("end") );
        }
        catch (\Exception $e) {
            SendTelegramMsgJob::dispatch( $this->dto->getUp("failed") );

                DB::rollback();
                    abort( $e->getCode(),$e->getMessage() );
        }
    }


}
