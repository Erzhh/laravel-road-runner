<?php

namespace Domain\Import\Services;

use Domain\Handbook\Helpers\WarehouseHelper;
use Domain\Handbook\Helpers\CityHelper;
use Domain\Import\Helpers\ImportHelper;
use Domain\Import\Interfaces\CatalogRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class WarehousesImportService
{
    private CatalogRepository $repository;

    public function __construct()
    {
        $this->repository = App::make(CatalogRepository::class);
    }

    /**
     *  $apiData[0] = [
     *      'id' => 'HQ1000156',
     *      'guid' => '4e5bbc2d-1210-11ec-80d2-bc97e145c062',
     *      'name' => 'ПВЗ Астана ИМ Аружан',
     *      'status' => true,
     *      'parent_id' => 'HQ1000018',
     *      'parent_guid' => 'c9b6ebc1-3351-11e4-9ebf-001e670c9280',
     *      'city_guid' => '2e29ba9b-3548-11ec-80d6-bc97e145c062',
     *      'type' => 'Оптовый',
     *  ];
     */
    public function run()
    {
        $apiData = $this->repository->getWarehouses();

        $citiesMap = ImportHelper::citiesUidMap();
        //$warehouseTypes = ImportHelper::warehouseTypesMap();

        $dbData = [];

        foreach ($apiData as $item) {
            $dbData[] = [
                'uid' => $item['guid'],
                'code' => $item['id'],
                'name' => $item['name'],
                'status' => (int)$item['status'],
                'city_id' => $this->getCityId($item['city_guid'], $citiesMap),
                'type' =>$this->getType($item['id']),
            ];
        }

        DB::table('warehouses')->upsert(
            $dbData, // Данные для вставки
            ['uid'], // Поля для проверки уникальности
            ['name'] // Поля обновления
        );
    }

    private function getCityId(string $uid, array $map)
    {
        if (!$uid) return CityHelper::DEFAULT_CITY_ID;
        return $map[$uid] ?? throw new \DomainException('Город не найден: ' . $uid);
    }

    private function getType(string $code)
    {
        $rts = ['000000001', 'HQ1000003'];
        return in_array($code, $rts) ? WarehouseHelper::TYPE_DC : WarehouseHelper::TYPE_SHOP;
    }
}
