<?php
namespace Domain\Catalog\QueryBuilder\Category;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\CategoryQuery;

class FetchOnlyRelationFormat extends CategoryQuery{

    public function __construct(
        private RequestParamsDTO $dto
    )
    {}

    public function run(): \Illuminate\Contracts\Pagination\LengthAwarePaginator
    {
        $categories = $this->getModel()::query()
            ->whereHas('formats')
            ->when($this->dto->search != null,function ($q){
                $search =  $this->dto->search;
                $q->where('name','like',"%$search%")
                    ->orWhere('name','like',"$search");
            })
            ->when($this->dto->sort,function($q){
                $q->orderBy( $this->dto->getSort()[0], $this->dto->getSort()[1] );
            })
            ->with($this->dto->include)
            ->paginate($this->dto->perPage);

        return $categories;
    }

}
