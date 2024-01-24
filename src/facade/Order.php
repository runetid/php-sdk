<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\OrderItem;

class Order extends Facade
{
    public function addOrderItem(OrderItem $item)
    {
        $response = $this->client->request('/order/add-order-item', 'POST', $item->toArray());
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        return $item->load($decode['data']);
    }

}