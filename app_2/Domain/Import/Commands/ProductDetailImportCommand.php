<?php

namespace App\Domain\Import\Commands;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use Illuminate\Console\Command;

class ProductDetailImportCommand extends Command
{
    protected $signature = 'import:products_detail';
    private MessageTelegramDto $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new MessageTelegramDto([
            'topic' => 'Выгрузка детали продуктов',
            'msg_start' =>  "Импорт стартовал",
            'msg_end' =>    "Импорт завершен",
            'msg_failed' => "Импорт выдал ошибку"
        ]);
    }

    public function handle()
    {
        (new ImportBaseCommand(className:"ProductDetailImportService",dto: $this->message))->run();
    }
}
