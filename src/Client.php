<?php

namespace runetid\sdk;

use Psr\Http\Message\ResponseInterface;
use runetid\sdk\facade\Event;
use runetid\sdk\facade\Order;
use runetid\sdk\facade\Product;
use runetid\sdk\facade\Section;
use runetid\sdk\facade\SectionHall;
use runetid\sdk\facade\User;

class Client
{
    public $bearer;
    private $apiKey;
    private $apiSecret;
    private $time;

    private bool $ssl = true;

    public function __construct(string $apikey, string $apiSecret, int $time = null, bool $ssl = true)
    {
        $this->apiKey = $apikey;
        $this->apiSecret = $apiSecret;
        $this->time = $time ?: time();
        $this->ssl = $ssl;
    }

    public function request($url, $method, array $payload = []): ResponseInterface
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://api.runet.id', 'verify' => $this->ssl]);

        $params = [
            'headers' => [
                'Origin' => 'https://runet.id',

                'ApiKey' => $this->apiKey,
                'Hash' => $this->getHash(),
                'Time' => $this->time,
            ]
        ];

        if ($this->bearer) {
            $params['headers']['Authorization'] = 'Bearer ' . $this->bearer;
        }

        if (false === empty($payload)) {
            $params['json'] = $payload;
        }

        return $client->request($method, $url, $params);
    }

    private function getHash(): string
    {
        return md5($this->apiKey . $this->time . $this->apiSecret);
    }

    public function event(): Event
    {
        return new Event($this);
    }

    public function user(): User
    {
        return new User($this);
    }

    public function order(): Order
    {
        return new Order($this);
    }

    public function product(): Product
    {
        return new Product($this);
    }

    public function section(): Section
    {
        return new Section($this);
    }

    public function hall(): SectionHall
    {
        return new SectionHall($this);
    }
}