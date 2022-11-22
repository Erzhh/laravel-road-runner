<?php
namespace Domain\Catalog\QueryBuilder\PriceHistory;

use Core\Request\DTO\RequestParamsDTO;
use Domain\Catalog\Models\PriceDocument;
use Domain\Catalog\QueryBuilder\PriceHistoriesQuery;

class PriceHistoryByDocumentIdPaginateQuery extends PriceHistoriesQuery {

    public function __construct(
        private PriceDocument $document,
        private RequestParamsDTO $request
    ){}

    public function run()
    {
        $instance = $this->getModel()
                            ->newQuery()
                            ->where('doc_id', $this->document->id)
                            ->with($this->request->include)
                            ->paginate($this->request->perPage);

        return $instance;
    }
}
