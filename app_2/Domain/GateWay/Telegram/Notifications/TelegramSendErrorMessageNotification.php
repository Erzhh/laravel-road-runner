<?php
namespace App\Domain\GateWay\Telegram\Notifications;

use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramSendErrorMessageNotification extends Notification
{
    public function via(): array
    {
        return ["telegram"];
    }

    public function toTelegram(MessageTelegramDto $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
                                ->to(522718244)
                                ->button(text:'перейти',url:$notifiable->toPath(),columns: 1)
                                ->content($notifiable->toContent());
    }


}
