<?php
namespace App\Domain\Catalog\Services\Category;

use App\Domain\Catalog\Dto\CategoryDTO;
use Domain\Catalog\QueryBuilder\CategoryQuery;
use Illuminate\Database\Eloquent\Model;

class CategoryStoreService extends CategoryQuery {

    public function __construct(
        private CategoryDTO $dto
    )
    {}

    public function run(): Model
    {
        return $this->getModel()
            ->newQuery()
            ->updateOrCreate(
                ['uid' => $this->dto->guid],
                $this->dto->toArray()
            );
    }

}
