<?php

namespace App\Domain\Import\Commands;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use Illuminate\Console\Command;

class CategoriesImportCommand extends Command
{
    protected $signature = 'import:categories';
    private MessageTelegramDto $message;

    public function __construct()
    {
        parent::__construct();
        $this->message = new MessageTelegramDto([
            'topic' => 'Выгрузка категории',
            'msg_start' =>  "Импорт стартовал",
            'msg_end' =>    "Импорт завершен",
            'msg_failed' => "Импорт выдал ошибку"
        ]);
    }

    public function handle()
    {
        (new ImportBaseCommand(className:"CategoriesImportAction",dto: $this->message,
                                core_path:"Domain\\Import\\Actions\\")
                                )->run();
    }
}
