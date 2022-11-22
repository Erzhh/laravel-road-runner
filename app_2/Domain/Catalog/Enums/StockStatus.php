<?php

namespace Domain\Catalog\Enums;

enum StockStatus: int
{
    case ACTIVE = 1;
    case SHIPPED = 2;
    case RESERVED = 3;
}
