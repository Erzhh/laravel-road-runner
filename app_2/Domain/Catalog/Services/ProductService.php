<?php
    namespace Domain\Catalog\Services;

    use Core\BaseService;
    use Domain\Catalog\Models\Product;
    use Illuminate\Database\Eloquent\Model;

class ProductService extends BaseService {

    function getModel(): Model
    {
        return  new Product();
    }


}
