<?php

namespace App\Domain\Import\Commands;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use Illuminate\Console\Command;

class ProductBonusImportCommand extends Command
{
    protected $signature = 'import:products_bonus';
    private MessageTelegramDto $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new MessageTelegramDto([
            'topic' => 'Выгрузка бонусов на продукты',
            'msg_start' => "Импорт стартовал",
            'msg_end' => "Импорт завершен",
            'msg_failed' => "Импорт выдал ошибку"
        ]);
    }

    public function handle()
    {
        (new ImportBaseCommand(className:  "GetAllProductBonusAction",dto: $this->message,
                                core_path: "Domain\\GateWay\\OneS\\Actions\\")
                            )->run();
    }
}
