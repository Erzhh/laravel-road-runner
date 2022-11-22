<?php
namespace App\Domain\GateWay\OneS\Services;

use App\Domain\GateWay\OneS\DTO\StoreUserDTO;
use Illuminate\Support\Facades\Http;

class SendUserDataToOneS{

    public function __construct(
        private StoreUserDTO $dto
    ){}

    public function run(): int
    {

        $request =  Http::withBasicAuth('HalykEvrika','HalykEvrika')
                    ->accept('application/json')
                     ->post("http://192.168.18.249:8090/SERVER/hs/evrika-delivery/createBonusCard",
                         $this->dto->toArray()
                     )->status();

        return $request;
    }
}
