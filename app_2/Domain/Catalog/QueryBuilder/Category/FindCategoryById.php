<?php
namespace Domain\Catalog\QueryBuilder\Category;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\CategoryQuery;
use Illuminate\Database\Eloquent\Model;

class FindCategoryById extends CategoryQuery{

    public function __construct(
        private string $id,
        private RequestParamsDTO $request = new RequestParamsDTO()
    )
    {}

    public function run(): Model
    {
        return  $this->getModel()
                        ->newQuery()
                        ->where('id',$this->id)
                        ->orWhere('uid',$this->id)
                        ->with( $this->request->include)
                        ->first();
    }

}
