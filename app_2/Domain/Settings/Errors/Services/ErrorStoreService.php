<?php
namespace App\Domain\Settings\Errors\Services;

use App\Domain\Settings\Errors\DTO\ErrorDTO;
use Domain\Settings\Errors\QueryBuilder\ErrorQuery;
use Illuminate\Database\Eloquent\Model;

class ErrorStoreService extends ErrorQuery {

    public function __construct(
        private ErrorDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
                    ->newQuery()
                    ->create($this->dto->toArray());
    }

}
