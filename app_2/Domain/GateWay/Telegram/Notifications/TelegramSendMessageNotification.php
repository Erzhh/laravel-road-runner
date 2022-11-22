<?php
namespace App\Domain\GateWay\Telegram\Notifications;

use App\Domain\Settings\Errors\DTO\ErrorDTO;
use NotificationChannels\Telegram\TelegramMessage;
use Illuminate\Notifications\Notification;

class TelegramSendMessageNotification extends Notification
{
    public string $url = "https://erzh.kz";
    public function via($notifiable):array
    {
        return ["telegram"];
    }

    public function toTelegram(ErrorDTO $notifiable): TelegramMessage
    {
        return TelegramMessage::create()
                                ->to(522718244)
                                ->button('перейти',$this->url )
                                ->content("Status **$notifiable->status**\nError: *$notifiable->message*");
    }
}
