<?php
namespace App\Domain\GateWay\OneS\DTO;

use Spatie\DataTransferObject\DataTransferObject;

class StoreUserDTO extends  DataTransferObject{

    public string $phoneNumber;
    public string $surname;
    public string $name;
    public int $gender = 1;
    public string $dateOfBirth;
    public ?string $email = "";
    public int $idCity = 6190484;
    public int $idRegion = 6000029;
    public int $channelRegistration = 8;

    public function toArray(): array
    {
        return [
            'phoneNumber' => $this->phoneNumber,
            'surname' => $this->surname,
            'name' => $this->name,
            'gender' => $this->gender,
            'dateOfBirth' => $this->BirthDayToStr(),
            'email' => $this->email,
            'idCity' => $this->idCity,
            'idRegion' => $this->idRegion,
            'channelRegistration' => $this->channelRegistration,
        ];
    }

    private function BirthDayToStr(): string
    {
           $array =  explode('-', $this->dateOfBirth);
        return implode('',$array);
    }
}
