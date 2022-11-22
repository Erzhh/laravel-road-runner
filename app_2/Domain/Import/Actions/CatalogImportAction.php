<?php

namespace Domain\Import\Actions;

use Domain\Import\Services\CharacteristicImportService;
use Domain\Import\Services\CharacteristicProductImportService;
use Domain\Import\Services\CharacteristicProductValueImportService;
use Domain\Import\Services\ProductDetailImportService;
use Domain\Import\Services\PricesImportService;
use Domain\Import\Services\PriceTypesImportService;
use Domain\Import\Services\ProductsImportService;
use Illuminate\Support\Facades\DB;

class CatalogImportAction
{
    private array $table;
    private int $time_start;
    /**
     * @throws \Exception
     */
    public function __construct(
        private $output
    ){}

    /**
     * @throws \Exception
     */
    public function run()
    {
        $this->importHandbooks();
        $this->importProducts();
        $this->importPrices();
        $this->importPriceDocument();
        $this->importCharacteristic();

        return $this->table;
    }

    public function importHandbooks(){
        try {
            DB::beginTransaction();

            $this->serviceStart();
                (new PriceTypesImportService())->run();
            $this->serviceEnd('Тип цен');
            sleep(0.5);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function importProducts(){
        try {
            DB::beginTransaction();

            $this->serviceStart();
                (new CategoriesImportAction())->run();
            $this->serviceEnd('Категорий');

            $this->serviceStart();
                (new ProductsImportService())->run();
            $this->serviceEnd('Продуктов');

            $this->serviceStart();
                (new ProductDetailImportService())->run();
            $this->serviceEnd('Доп.инфо продуктов');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function importPrices(){
        try {
            DB::beginTransaction();

            $this->serviceStart();
                (new PricesImportService())->run();
            $this->serviceEnd('Ценовых предложений');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function importPriceDocument(){
        try {
            DB::beginTransaction();

                $this->serviceStart();
                (new PriceDocumentImportAction())->run();
                $this->serviceEnd('Документ цены');

                $this->serviceStart();
                  (new PriceDocumentUpgradeProductPriceAction())->run();
                $this->serviceEnd('Документ цены на изминение цен продуктов');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    public function importCharacteristic(){
        try {
            DB::beginTransaction();

            $this->serviceStart();
            (new CharacteristicImportService())->run();
            $this->serviceEnd('Характеристик');

            $this->serviceStart();
            (new CharacteristicProductImportService())->run();
            $this->serviceEnd('Продуктов характристик');

            $this->serviceStart();
            (new CharacteristicProductValueImportService())->run();
            $this->serviceEnd('Продуктов характристик с значением');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            throw $e;
        }
    }

    private function serviceStart(){
        $this->time_start = time();
    }

    private function serviceEnd($title){
        $this->output->progressAdvance();
        $this->output->write("<bg=white;fg=black> Импорт $title завершено </>");

        $finish = (time() - $this->time_start);
        $this->table[] = ["<fg=cyan> $title </>", "<info>$finish сек</info>"];
    }
}
