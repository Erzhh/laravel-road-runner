<?php
namespace Domain\Searchable\Catalog\Services;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\ProductQuery;
use Domain\Searchable\Catalog\Dto\CategoryProductDto;

class FindCategoryWithProduct extends ProductQuery {

    public function __construct(
        private CategoryProductDto $dto,
        private RequestParamsDTO $request
    ){}

    public function run()
    {
        $query =  $this->getModel()::query()
                        ->when($this->request->fields,function($q){
                            $q->select($this->request->fields);
                        })
                        ->when(!empty($this->dto->categories),function($q){
                            $q->whereIn('category_id',$this->dto->categories);
                        })
                        ->when($this->dto->search,function($q){
                            $text = $this->dto->search;
                            $q->where('full_name', 'like', "%$text%")
                                ->whereOr('full_name', 'like', "$text");
                        })
                        ->with($this->request->include)
                        ->paginate($this->request->perPage);

        return $query;
    }

}
