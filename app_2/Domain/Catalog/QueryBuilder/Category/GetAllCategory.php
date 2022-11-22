<?php
namespace Domain\Catalog\QueryBuilder\Category;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\CategoryQuery;

class GetAllCategory extends CategoryQuery{

    public function __construct(
        private RequestParamsDTO $request
    )
    {}

    public function run()
    {
        $instance = $this->getModel()->newQuery()
                        ->whereNull('parent_id')
                        ->when($this->request->fields,function($q){
                            $q->select($this->request->fields);
                        })
                        ->with($this->request->include)
                        ->get();
        return $instance;
    }

}
