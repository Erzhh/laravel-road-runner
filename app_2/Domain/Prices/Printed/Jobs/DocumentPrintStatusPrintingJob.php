<?php

namespace App\Domain\Prices\Printed\Jobs;

use App\Domain\Prices\Printed\Actions\CheckPrintedDocumentAction;
use App\Domain\Prices\Printed\DTO\DocHistoryPrintedDTO;
use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DocumentPrintStatusPrintingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public DocHistoryPrintedDTO $dto
    ){}

    public function handle()
    {
         $doc_dto =  new DocumentPrintedDTO([
            'document_uid'=>$this->dto->document_uid,
            'user_uid' => $this->dto->user_uid
        ]);
        (new CheckPrintedDocumentAction($doc_dto))->run();
    }
}
