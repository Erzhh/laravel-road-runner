<?php
namespace App\Domain\Prices\Format\Services;

use App\Domain\Prices\Format\DTO\FormatDTO;
use Domain\Prices\Format\QueryBuilder\FormatQuery;
use Illuminate\Database\Eloquent\Model;

class FormatStoreService extends FormatQuery {

    public function __construct(
        private FormatDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->create(
                $this->dto->toArray()
            );
    }

}
