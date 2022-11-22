<?php

namespace Domain\Import\DTO;

use Domain\Catalog\Dto\ProductDetailDto;
use Domain\Catalog\Dto\ProductDto;
use Spatie\DataTransferObject\DataTransferObject;

class ProductMergeProductDetailDto extends DataTransferObject {

    public ProductDto $product;
    public ProductDetailDto $product_detail;
    public string $parent_id;
    public string $parent_uid;

    public function setCategoryId(int $id){
        $this->product->category_id = $id;
    }

    public function setProductIdForDetail(int $id){
        $this->product_detail->product_id = $id;
    }
}
