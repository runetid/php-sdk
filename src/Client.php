<?php

namespace runetid\sdk;

class Client
{
    private $apiKey;
    private $apiSecret;

    private $time;
    public function __construct($apikey, $apiSecret)
    {
        $this->apiKey = $apikey;
        $this->apiSecret = $apiSecret;
        $this->time = time();
    }

    private function getHash()
    {
        return md5($this->apiKey.$this->time.$this->apiSecret);
    }

    public function request($url, $method): \Psr\Http\Message\ResponseInterface
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://tmpapi.runet.id']);

        return $client->request($method, $url, [
            'headers' => [
//                'User-Agent' => 'testing/1.0',
//                'Accept'     => 'application/json',
//                'X-Foo'      => ['Bar', 'Baz'],

            'Origin' => 'https://runet.id',

                'ApiKey' => $this->apiKey,
                'Hash' => $this->getHash(),
                'Time' => $this->time,
            ]
        ]);
    }




}