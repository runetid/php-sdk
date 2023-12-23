<?php

namespace runetid\sdk\facade;

use runetid\sdk\Client;

abstract class Facade
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

}