<?php
namespace App\Domain\Prices\Maket\Services;

use App\Domain\Prices\Maket\Models\Maket;
use Domain\Prices\Maket\QueryBuilder\MaketQuery;

class MaketDestroyService extends MaketQuery
{
    public function __construct(
         public Maket $maket,
    ){}

    public function  run()
    {
        $this->maket->forceDelete();
    }

}
