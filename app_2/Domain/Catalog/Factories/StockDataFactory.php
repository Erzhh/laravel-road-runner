<?php

namespace Domain\Catalog\Factories;

use Domain\Movement\Dto\StockData;
use Domain\Catalog\Enums\StockStatus;
use Domain\Movement\Models\StockMovement;

class StockDataFactory
{
    /**
     * @throws \Spatie\DataTransferObject\Exceptions\UnknownProperties
     */
    public static function fromMovement(StockMovement $sm): StockData
    {
        return new StockData([
            'warehouse_id' => $sm->warehouse_id,
            'product_id' => $sm->product_id,
            'quality_id' => $sm->quality_id,
            'status' => StockStatus::ACTIVE->value,
            'quantity' => $sm->qty_new,
        ]);
    }
}
