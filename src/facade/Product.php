<?php

namespace runetid\sdk\facade;

class Product extends Facade
{
    public function byId(int $id): ?\runetid\sdk\models\Product
    {
        $response = $this->client->request('/products/'.$id, 'GET');

        $decode = json_decode($response->getBody(), true);

        $user = new \runetid\sdk\models\Product();

        if (false === isset($decode['runet_id'])) {
            return null;
        }

        return $user->load($decode);
    }
}