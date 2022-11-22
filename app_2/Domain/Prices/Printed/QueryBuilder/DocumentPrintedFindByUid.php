<?php

namespace App\Domain\Prices\Printed\QueryBuilder;

use App\Domain\Prices\Printed\DTO\DocumentPrintedDTO;
use Core\Request\DTO\RequestParamsDTO;
use Domain\Prices\Printed\QueryBuilder\DocumentPrintedQuery;

class DocumentPrintedFindByUid extends DocumentPrintedQuery {

    public function __construct(
        private DocumentPrintedDTO $dto,
        private RequestParamsDTO $request = new RequestParamsDTO(['fields'=>[],'include'=>[]])
    ){}

    public function run()
    {
        return  $this->getModel()->newQuery()
            ->whereIn('price_document_uid',$this->dto->documents_uid)
            ->where('user_uid',$this->dto->user_uid)
            ->with($this->request->include)
            ->when($this->request->fields,function ($q){
                $q->select($this->request->fields);
            })
            ->get();
    }
}
