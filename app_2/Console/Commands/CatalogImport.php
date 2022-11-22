<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Domain\Import\Actions\CatalogImportAction;

class CatalogImport extends Command
{
    protected $signature = 'catalog:import';

    protected $description = 'Импорт каталога';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        $headers = ['Импорт', 'Время'];

        $this->output->progressStart(10);
        try {
            $body =  (new CatalogImportAction($this->output))->run();

            $this->output->progressFinish();
            $this->table($headers, $body);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
