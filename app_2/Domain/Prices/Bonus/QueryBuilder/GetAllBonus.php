<?php
namespace Domain\Prices\Bonus\QueryBuilder;

class GetAllBonus extends BonusQuery {

    public function __construct(

    )
    {}

    public function run()
    {
        $query = $this->getModel()
                        ->newQuery()
                        ->get();
        return $query;
    }

}
