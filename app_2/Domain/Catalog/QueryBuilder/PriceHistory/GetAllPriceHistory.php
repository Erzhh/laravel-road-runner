<?php
namespace Domain\Catalog\QueryBuilder\PriceHistory;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\QueryBuilder\PriceHistoriesQuery;
use Illuminate\Database\Eloquent\Collection;

class GetAllPriceHistory extends PriceHistoriesQuery {

    public function __construct(
        private RequestParamsDTO $request,
    ){}

    public function run(): Collection|array
    {
        $instance = $this->getModel()
                            ->newQuery()
                            ->with($this->request->include)
                            ->get();

        return $instance;
    }
}
