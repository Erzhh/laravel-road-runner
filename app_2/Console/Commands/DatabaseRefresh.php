<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Domain\Import\Actions\CatalogImportAction;

class DatabaseRefresh extends Command
{
    protected $signature = 'db:refresh';

    protected $description = 'Полное обновление и заполнение БД';

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
//        $this->call('users:import');
        $this->call('catalog:import');
        $this->call('db:seed');
    }
}
