<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\Product as ProductModel;

class Product extends Facade
{
    public function byId(int $id): ?ProductModel
    {
        $response = $this->client->request('/products/'.$id, 'GET');

        $decode = json_decode($response->getBody(), true);

        $user = new ProductModel();

        if (false === isset($decode['runet_id'])) {
            return null;
        }

        return $user->load($decode);
    }
}