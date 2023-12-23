<?php

namespace runetid\sdk;

use Psr\Http\Message\ResponseInterface;
use runetid\sdk\facade\Event;
use runetid\sdk\facade\User;

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

    public function request($url, $method, array $payload = []): ResponseInterface
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://tmpapi.runet.id']);

        $params = [
            'headers' => [
                'Origin' => 'https://runet.id',

                'ApiKey' => $this->apiKey,
                'Hash' => $this->getHash(),
                'Time' => $this->time,
            ]
        ];

        if (false === empty($payload)) {
            $params['json'] = $payload;
        }

        return $client->request($method, $url, $params);
    }


    public function event(): Event
    {
        return new Event($this);
    }

    public function user(): User
    {
        return new User($this);
    }


}