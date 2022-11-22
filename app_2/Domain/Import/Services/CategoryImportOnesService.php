<?php

namespace Domain\Import\Services;

use App\Domain\Catalog\Dto\CategoryDTO;
use App\Domain\Catalog\Services\Category\CategoryStoreService;
use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use App\Domain\GateWay\Telegram\Jobs\SendTelegramMsgJob;
use Domain\Catalog\QueryBuilder\Category\FindCategoryById;

/**
 * Класс импортирует обьект категорий из 1С в БД
 */
class CategoryImportOnesService
{
    private MessageTelegramDto $message;

    public function __construct(
        private CategoryDTO $dto
    ){
        $this->message = new MessageTelegramDto([
            'topic' => '1C отправляет нам цены на документы'
        ]);
    }

    public function run()
    {
            $category_parent = (new FindCategoryById($this->dto->parent_guid))->run();
            $this->dto->setParentId( $category_parent->id );

            (new CategoryStoreService($this->dto))->run();

        SendTelegramMsgJob::dispatch(   $this->message->getUp("end")  );
    }
}
