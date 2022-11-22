<?php
namespace Domain\Settings\Errors\QueryBuilder;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Settings\Errors\Models\Error;

class FindErrorByIdQuery extends ErrorQuery {

    public function __construct(
        private RequestParamsDTO $request,
        public int $error,
    )
    {}

    public function run()
    {
        $instance = $this->getModel()
                        ->newQuery()
                        ->with($this->request->include)
                        ->when($this->request->fields,function ($q){
                            $q->select($this->request->fields);
                        })
                        ->find($this->error);

        return $instance;

    }
}
