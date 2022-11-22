<?php
namespace Domain\Catalog\QueryBuilder\PriceHistory;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\Models\PriceDocument;
use Domain\Catalog\Models\PriceHistory;
use Domain\Catalog\QueryBuilder\PriceHistoriesQuery;

class FindByIdPriceHistory extends PriceHistoriesQuery {

    public function __construct(
        private RequestParamsDTO $request,
        private PriceHistory $history,
    )
    {}

    public function run()
    {
        $instance = $this->getModel()
                            ->newQuery()
                            ->with($this->request->include)
                            ->findOrFail($this->history->id);

        return $instance;

    }
}
