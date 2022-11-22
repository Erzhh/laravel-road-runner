<?php

namespace App\Console\Commands;

use App\Domain\GateWay\OneS\Services\FetchProductsBonusService;
use App\Domain\GateWay\Telegram\DTO\MessageTelegramDto;
use App\Domain\GateWay\Telegram\Jobs\SendTelegramMsgJob;
use Core\Request\DTO\RequestParamsDTO;
use Domain\GateWay\OneS\Actions\GetAllProductBonusAction;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class BonusImport extends Command
{
    protected $signature = 'import:products_bonus_progress';

    protected $description = 'Импорт бонусов';
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
        try {
            SendTelegramMsgJob::dispatch(   $this->message->getUp("start")  );

            DB::beginTransaction();


                    $count_page = $this->getCountProductBonus();

                $this->output->progressStart($count_page);

                    (new GetAllProductBonusAction($this->output))->run();

                    $this->output->progressAdvance();
                    $this->output->write("<bg=yellow;fg=black> Получение бонуса завершено </>");

                $this->output->progressFinish();

            DB::commit();
            SendTelegramMsgJob::dispatch(   $this->message->getUp("end")  );
        }
        catch (\Exception $e) {
                SendTelegramMsgJob::dispatch(   $this->message->getUp("failed")  );
            DB::rollback();
                abort(501, $e->getMessage());
        }
    }


    private function getCountProductBonus(){
        $dto =  new RequestParamsDTO(['page'=> 1]);
        $product_bonus = (new FetchProductsBonusService($dto))->run();
        $count_page = $product_bonus['data']['_meta']['pageCount'];

        return $count_page;
    }

}
