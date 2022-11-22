<?php
namespace App\Domain\GateWay\OneS\Actions;

use App\Domain\Catalog\Services\Product\ProductUpdateOrStoreService;
use App\Domain\Catalog\Services\ProductDetail\ProductDetailUpdateOrStoreService;
use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use App\Domain\GateWay\Telegram\Jobs\SendTelegramMsgJob;
use Domain\Catalog\QueryBuilder\Category\FindCategoryById;
use Domain\Import\DTO\ProductMergeProductDetailDto;

class ProductImportOnesAction{

    private MessageTelegramDto $message;

    public function __construct(
        private ProductMergeProductDetailDto $dto
    ){
        $this->message = new MessageTelegramDto([
            'topic' => '1C отправляет нам цены на документы'
        ]);
    }

    public function run(): void
    {
            $category = (new FindCategoryById($this->dto->parent_uid))->run();
                $this->dto->setCategoryId($category->id);

            $product =  (new ProductUpdateOrStoreService($this->dto->product))->run();
                $this->dto->setProductIdForDetail($product->id);

            (new ProductDetailUpdateOrStoreService($this->dto->product_detail))->run();

        SendTelegramMsgJob::dispatch(   $this->message->getUp("end")  );
    }

}
