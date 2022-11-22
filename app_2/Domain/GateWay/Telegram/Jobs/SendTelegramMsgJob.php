<?php

namespace App\Domain\GateWay\Telegram\Jobs;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use App\Domain\GateWay\Telegram\Notifications\TelegramSendErrorMessageNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Notification;

class SendTelegramMsgJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private MessageTelegramDto $dto
    ){}

    public function handle()
    {
        Notification::send(
                            $this->dto,
                            new TelegramSendErrorMessageNotification()
                        );
    }
}
