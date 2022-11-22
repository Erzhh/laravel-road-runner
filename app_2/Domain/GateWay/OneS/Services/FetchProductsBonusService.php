<?php
namespace App\Domain\GateWay\OneS\Services;

use Core\Request\DTO\RequestParamsDTO;
use Illuminate\Support\Facades\Http;

class FetchProductsBonusService{

    public function __construct(
        private RequestParamsDTO $dto
    ){}

    public function run(){

        return Http::withBasicAuth('f0fe0c4f-99bf-4b50-86e6-024eece9a99b','')
                    ->withHeaders([
                        'Accept' => 'application/json'
                    ])
                    ->get("https://api-evrika.abmloyalty.app/v2/partner/products/calculate-max-cashback",[
                        'branch_id'=>00000001,
                        'variables[]' => 'Nal',
                        'page' => $this->dto->page
                    ])
                    ->json();

    }
}
