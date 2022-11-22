<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Domain\Import\Actions\CatalogImportAction;

class TestDevStart extends Command
{
    protected $signature = 'db:test';

    protected $description = 'Очистка таблиц -> Заполнение фэйк данным -> начать тест';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return void
     */
    public function handle()
    {
        $this->call('migrate:refresh');
        $this->call('db:seed');
        $this->call('test');
    }
}
