<?php

namespace Domain\Import\Helpers;

use Domain\Catalog\Models\Category;
use Domain\Catalog\Models\PriceType;
use Domain\Catalog\Models\Product;
use Domain\Catalog\Models\Quality;
use Domain\Handbook\Models\City;
use Domain\Handbook\Models\Warehouse;

class ImportHelper
{
    /**
     * @return array
     * [
     *    "uid" => id,
     *    "b5458ba5-18e4-11e7-bfb0-001e670c9280" => 1,
     * ]
     */
    public static function categoriesUidMap(){
        $items = Category::all()->pluck('id', 'uid');
        return $items->toArray();
    }

    /**
     * @return array
     * [
     *    "uid" => id,
     *    "b5458ba5-18e4-11e7-bfb0-001e670c9280" => 1,
     * ]
     */
    public static function warehousesUidMap(){
        $items = Warehouse::all()->pluck('id', 'uid');
        return $items->toArray();
    }

    /**
     * @return array
     * [
     *    "uid" => id,
     *    "b5458ba5-18e4-11e7-bfb0-001e670c9280" => 1,
     * ]
     */
    public static function qualitiesUidMap(){
        $items = Quality::all()->pluck('id', 'uid');
        return $items->toArray();
    }

    /**
     * @return array
     * [
     *    "uid" => id,
     *    "b5458ba5-18e4-11e7-bfb0-001e670c9280" => 1,
     * ]
     */
    public static function productsUidMap(){
        $items = Product::all()->pluck('id', 'uid');
        return $items->toArray();
    }

    /**
     * @return array
     * [
     *    "uid" => id,
     *    "3abcf4db-909d-11e8-80e9-1866da78d386" => 1,
     * ]
     */
    public static function priceTypesUidMap(){
        $items = PriceType::all()->pluck('id', 'uid');
        return $items->toArray();
    }

    /**
     * @return array
     * [
     *    "uid" => id,
     *    "8cb3dbd8-6764-11eb-80c5-bc97e145c062" => 1,
     * ]
     */
    public static function citiesUidMap(){
        $items = City::all()->pluck('id', 'uid');
        return $items->toArray();
    }

    /**
     * @return array
     * [
     *   'Оптовый' => 1,
     * ]
     */
    public static function warehouseTypesMap(){
        return [
            'Оптовый' => 1,
            'Розничный' => 2,
            'НТТ' => 3, //Неавтоматизированная торговая точка
        ];
    }


    public static function ArraySearchOrNullable($array, $compare_array): int|string|null
    {
        $found_array = array_search( $array , $compare_array);
        return $found_array?$found_array:null;
    }

}
