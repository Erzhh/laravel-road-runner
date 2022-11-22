<?php
namespace App\Domain\Settings\Errors\Services;

use Domain\Settings\Errors\QueryBuilder\ErrorQuery;
use Illuminate\Database\Eloquent\Model;

class ErrorDeleteService extends ErrorQuery {

    public function __construct(
        private int $id
    ){}

    public function run()
    {
        return $this->getModel()
                    ->newQuery()
                    ->find($this->id)
                    ->delete();
    }

}
