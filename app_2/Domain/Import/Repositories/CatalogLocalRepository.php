<?php

namespace Domain\Import\Repositories;

use Domain\Import\Interfaces\CatalogRepository;

class CatalogLocalRepository implements CatalogRepository
{
    /**
     * @return array
     */
    public function getCategories():array
    {
        return $this->getFileData('categories');
    }

    /**
     * @return array
     */
    public function getProducts():array
    {
        return $this->getFileData('products');
    }

    public function getProductsDetail():array
    {
        return $this->getFileData('product_details');
    }

    public function getStocks():array
    {
        return $this->getFileData('stocks');
    }

    public function getWarehouses():array
    {
        return $this->getFileData('warehouses');
    }

    public function getCities():array
    {
        return $this->getFileData('cities');
    }

    public function getPrices():array
    {
        return $this->getFileData('prices');
    }

    public function getPriceTypes():array
    {
        return $this->getFileData('price_types');
    }

    public function getPriceDocument():array
    {
        return $this->getFileData('cost_document_76000001912');
    }

    public function getCharacteristics():array
    {
        return $this->getFileData('PropertiesAndValues');
    }

    public function getCharacteristicProducts():array
    {
        return $this->getFileData('PropertiesAndProducts');
    }

    public function getCharacteristicProductsValue(): array
    {
        return $this->getFileData('ProductPropertyValue');
    }

    public function getQualityTypes():array
    {
        return $this->getFileData('qualities');
    }

    private function getContent($filename): bool|string
    {
        $path = storage_path() . "/catalog/$filename.json";
        return file_get_contents($path);
    }

    private function getFileData($filename):array
    {
        return json_decode($this->getContent($filename), true);
    }

}
