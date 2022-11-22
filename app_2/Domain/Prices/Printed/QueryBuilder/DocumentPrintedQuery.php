<?php
namespace  Domain\Prices\Printed\QueryBuilder;

use App\Domain\Prices\Printed\Models\PriceDocumentPrinted;
use Illuminate\Database\Eloquent\Model;
use Core\BaseQuery;

class DocumentPrintedQuery implements BaseQuery
{
    /**
     * @return Model
     */
    function getModel(): Model
    {
        return new PriceDocumentPrinted();
    }
}
