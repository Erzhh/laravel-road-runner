<?php

namespace App\Domain\GateWay\Telegram\Jobs;

use App\Domain\GateWay\Telegram\Notifications\TelegramSendMessageNotification;
use App\Domain\Settings\Errors\DTO\ErrorDTO;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class  SendTelegramSmsJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private ErrorDTO $error_dto
    ){}

    public function handle()
    {
        Notification::send($this->error_dto, new TelegramSendMessageNotification());
    }
}
