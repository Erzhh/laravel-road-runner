<?php
namespace App\Domain\Catalog\Services\PriceDocument;

use Domain\Catalog\Dto\PriceDocumentDto;
use Domain\Catalog\QueryBuilder\PriceDocumentQuery;
use Illuminate\Database\Eloquent\Model;

class PriceDocumentFindOrStoreService extends PriceDocumentQuery {

    public function __construct(
        private PriceDocumentDto $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->firstOrCreate(
                [ 'uid' => $this->dto->uid ],
                $this->dto->toArray()
            );
    }

}
