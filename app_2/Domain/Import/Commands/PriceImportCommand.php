<?php

namespace App\Domain\Import\Commands;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use Illuminate\Console\Command;

class PriceImportCommand extends Command
{
    protected $signature = 'import:price_products';
    private MessageTelegramDto $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new MessageTelegramDto([
            'topic' => 'Выгрузка Цены',
            'msg_start' => "Импорт стартовал",
            'msg_end' => "Импорт завершен",
            'msg_failed' => "Импорт выдал ошибку"
        ]);
    }

    public function handle()
    {
        (new ImportBaseCommand(className:"PricesImportService",dto: $this->message))->run();
    }
}
