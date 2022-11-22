<?php

namespace Domain\Import\Actions;

use Domain\Import\Services\CategoryParentsFillService;
use Domain\Import\Services\CategoryImportService;

/**
 * Импорт категорий каталога
 */
class CategoriesImportAction
{
    /**
     * @return void
     */
    public function run(){

        // Сохраняем в БД
        (new CategoryImportService())->run();

        // Заполняем родительские категории
        (new CategoryParentsFillService())->run();
    }
}
