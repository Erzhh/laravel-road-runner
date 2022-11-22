<?php
namespace App\Domain\Prices\Characteristic\Services\CharacteristicProduct;

use App\Domain\Prices\Characteristic\DTO\CharacteristicProductDTO;
use App\Domain\Prices\Characteristic\DTO\CharacteristicUpdateProductDTO;
use App\Domain\Prices\Characteristic\Models\CharacteristicsProduct;


class  CharacteristicProductUpdateService {

    public function __construct(
        private CharacteristicsProduct $product,
        private CharacteristicUpdateProductDTO $dto
    ){}

    public function  run(): bool
    {
        $upd_data = $this->gererateResource( $this->dto->toArray() );

        return $this->product->update( $upd_data );
    }

    private function gererateResource(array $fillable){
        $array= [];
        foreach ($fillable as $key => $field ){
            $field !== null ? $array[$key] = $field : null;
        }
        return $array;
    }

}
