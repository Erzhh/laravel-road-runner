<?php

namespace Domain\Import\Repositories;

use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use Domain\Import\Interfaces\CatalogRepository;

class CatalogRemoteRepository implements CatalogRepository
{
    private Client $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => env('IMPORT_1C_URL'),
            'auth' => ['EvrikaRetail','EvrikaRetail'],
            'headers' => [
                'Content-Type' => 'application/json',
                'Charset' => 'UTF-8'
            ]
            ,JSON_UNESCAPED_UNICODE
        ]);
    }


    public function getCategories():array
    {
        return $this->getData($this->client->get('product/group'));
    }


    public function getProducts():array
    {
        return $this->getData($this->client->get('product/list'));
    }

    /**
     * Список ценовых предложений по товарам
     *
     * @param $product_code
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getPrices($product_code = '2943ce69-f4bc-11ea-80bd-04d4c4d2e516'):array
    {
        return $this->getData($this->client->get('cost'));

//        $url = "cost";
//        if ($product_code) {
//            $url .= "?product=$product_code";
//        }
//        return $this->getData($this->client->get($url));
    }

    /**
     * Список остатков по товарам
     *
     * @param $product_code
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getStocks($product_code = false):array
    {
        $url = "cost";
        if ($product_code) {
            $url .= "?product=$product_code";
        }
        return $this->getData($this->client->get($url));
    }

    public function getWarehouses():array
    {
        return [];
    }

    public function getCities():array
    {
        return [];
    }

    public function getPriceTypes():array
    {
        return $this->getData(
                        $this->client->get('cost-type')
                        );
    }

    public function getQualityTypes():array
    {
        return [];
    }

    private function getData(ResponseInterface $response){
        return json_decode($response->getBody()->getContents(),true);
    }

    public function getProductsDetail(): array
    {
        return $this->getData($this->client->get('product/details'));
    }

    public function getCharacteristics(): array
    {
        return [];
    }

    public function getCharacteristicProducts(): array
    {
        return [];
    }

    public function getCharacteristicProductsValue(): array
    {
        return [];
    }

    public function getPriceDocument(): array
    {
        return [];
    }
}
