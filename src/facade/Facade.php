<?php

namespace runetid\sdk\models;

use runetid\sdk\Client;

abstract class Model
{
    protected Client $client;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

}