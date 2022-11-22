<?php
    namespace Domain\Catalog\Services;

    use Core\BaseService;
    use Domain\Catalog\Models\Category;
    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;

class PriceTypeService extends BaseService {

    function getModel(): Model
    {
        return  new Category();
    }

}
