<?php
namespace App\Domain\Prices\Logotype\Services;

use App\Domain\Prices\Logotype\DTO\LogotypeDTO;
use Domain\Prices\Logotype\QueryBuilder\LogotypeQuery;
use Illuminate\Database\Eloquent\Model;

class LogotypeStoreService extends LogotypeQuery {

    public function __construct(
        private LogotypeDTO $dto
    ){}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->create(
                $this->dto->toArray()
            );
    }

}
