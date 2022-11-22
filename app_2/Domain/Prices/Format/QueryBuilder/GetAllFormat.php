<?php
namespace Domain\Prices\Format\QueryBuilder;

class GetAllFormat extends FormatQuery {

    public function __construct(){}

    public function run()
    {
        $query = $this->getModel()
                        ->newQuery()
                        ->get();

        return $query;
    }

}
