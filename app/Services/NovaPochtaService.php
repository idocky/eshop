<?php

namespace App\Services;

use GuzzleHttp\Client;

class NovaPochtaService
{
    protected $apiKey;
    protected $sandbox;
    protected $baseUrl = 'https://api.novaposhta.ua/v2.0/json/';
    protected $client;

    public function __construct()
    {
        $this->apiKey = env('NOVA_POCHTA_API_KEY');
        $this->sandbox = env('NOVA_POCHTA_SANDBOX', true);
        $this->client = new Client();
    }

    protected function sendRequest($requestData)
    {
        $response = $this->client->post($this->baseUrl, [
            'json' => $requestData
        ]);

        return json_decode($response->getBody(),true);
    }

    public function createWaybill($methodProperties)
    {
        $requestData = [
            'apiKey' => $this->apiKey,
            'modelName' => 'InternetDocument',
            'calledMethod' => 'save',
            'methodProperties' => $methodProperties,
        ];

        $response = $this->sendRequest($requestData);
        return $response;
    }

    public function findCity(array $methodProperties)
    {
        $requestData = [
            'apiKey' => $this->apiKey,
            "modelName"=> "Address",
            "calledMethod" => "searchSettlements",
            'methodProperties' => $methodProperties,
        ];

        $response = $this->sendRequest($requestData);
        return $response;
    }

    public function sortCities($response)
    {
        $addresses = $response['data'][0]['Addresses'];

        $result = [];

        foreach ($addresses as $address) {
            $result[] = [
                "Present" => $address["Present"],
                "Area" => $address["Area"],
                "Ref" => $address["Ref"]
            ];
        }

        return $result;
    }

    public function getDepartments(string $ref, $query = '')
    {
        $requestData = [
            'apiKey' => $this->apiKey,
            "modelName"=> "Address",
            "calledMethod" => "getWarehouses",
            'methodProperties' =>
            [
                "SettlementRef" => $ref,
                "FindByString" => $query
            ],
        ];

        $response = $this->sendRequest($requestData)['data'];
        return $response;
    }
}
