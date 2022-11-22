<?php

namespace App\Domain\Import\Commands;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use Illuminate\Console\Command;

class PriceTypeImportCommand extends Command
{
    protected $signature = 'import:price_types';
    private MessageTelegramDto $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new MessageTelegramDto([
            'topic' => 'Выгрузка типов цен',
            'msg_start' => "Импорт стартовал",
            'msg_end' => "Импорт завершен",
            'msg_failed' => "Импорт выдал ошибку"
        ]);
    }

    public function handle()
    {
        (new ImportBaseCommand(className:"PriceTypesImportService",dto: $this->message))->run();
    }
}
