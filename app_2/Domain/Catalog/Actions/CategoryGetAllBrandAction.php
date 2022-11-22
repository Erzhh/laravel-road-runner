<?php
namespace Domain\Catalog\Actions;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\Category\FetchOnlyRelationFormat;

class CategoryGetAllBrandAction {

    public function __construct(
        private RequestParamsDTO $dto
    )
    {}

    public function run(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
       return (new FetchOnlyRelationFormat( $this->dto ))->run();
    }

}
