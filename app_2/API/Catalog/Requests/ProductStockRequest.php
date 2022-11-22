<?php

namespace API\Catalog\Requests;

use Core\Request\BaseRequestParams;
use Domain\Catalog\Dto\ProductStockDto;

class ProductStockRequest extends BaseRequestParams
{
    protected function prepareForValidation()
    {
        parent::prepareForValidation();
        $this->merge( ['uids' => $this->query('uids')] );
    }

    public function rules()
    {
        return [
            parent::rules(),
            'uid'   => ['required','array']
        ];
    }

    public function getDto(){
        return new ProductStockDto([
           'uid' => $this->get('uid'),
           'warehouse_id' => $this->get('warehouse_id'),
           'quality_id' => $this->get('quality_id'),
        ]);
    }

}
