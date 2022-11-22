<?php
namespace App\Domain\GateWay\Telegram\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class MessageTelegramDto extends  DataTransferObject {

    public string $topic;
    public string $msg_start = "Импорт стартовал";
    public string $msg_end = "Импорт завершен";
    public string $msg_failed = "Импорт выдал ошибку";
    public ?string $msg_default = "Импорт выдал неизвестность";
    public ?string $path;

    private int $start_time = 0;
    private int $end_time = 0;

    protected string $type;

    public function getUp(string $type){
        if($type=="start"){
            $this->startTime();
        }

        $this->type = $type;
        return $this;
    }

    public function toPath():string
    {
        return $this->path??"https://erzh.kz";
    }

    public function toContent():string
    {
        $message = "";
        switch ($this->type) {
            case "start";
                $message = $this->setMsg($this->msg_start);
                break;
            case "end";
                    $this->endTime();
                $message = $this->setMsg($this->msg_end);
                break;
            case "failed";
                $message = $this->setMsg($this->msg_failed);
                break;
            default;
                $message = $this->setMsg($this->msg_default);
                break;
        }

        return  $message;
    }

    private function setMsg($msg){
            $time = $this->calculateTime();
        return "Тема **$this->topic**\nОписания: *$msg*$time";
    }

    private function startTime(){
      $this->start_time = time();
    }

    private function endTime(){
        $this->end_time = time();
    }

    private function calculateTime(): string
    {
        if($this->start_time && $this->end_time){
            $count = $this->end_time - $this->start_time;
            return "\nВремя: $count"."сек";
        }
        return "";
    }

}
