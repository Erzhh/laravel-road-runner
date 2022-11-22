<?php
namespace Domain\Catalog\QueryBuilder\PriceDocument;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\PriceDocumentQuery;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class FindByIdPriceDocument extends PriceDocumentQuery {

    public function __construct(
        private RequestParamsDTO $request,
        private int $id
    )
    {}

    public function run()
    {
        $instance = $this->getModel()
                            ->with($this->request->include)
                            ->where('id',$this->id)
                            ->firstOrFail();

        return $instance;

    }
}
