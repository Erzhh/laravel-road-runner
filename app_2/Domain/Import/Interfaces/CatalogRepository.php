<?php

namespace Domain\Import\Interfaces;

interface CatalogRepository
{
    public function getCategories():array;
    public function getProducts():array;
    public function getProductsDetail():array;
    public function getStocks():array;
    public function getWarehouses():array;
    public function getCharacteristics():array;
    public function getCharacteristicProducts():array;
    public function getCharacteristicProductsValue():array;
    public function getPrices():array;
    public function getPriceTypes():array;
    public function getPriceDocument():array;
    public function getQualityTypes():array;
    public function getCities():array;
}
