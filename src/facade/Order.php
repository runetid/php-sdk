<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\OrderItem;

class Order extends Facade
{
    public function addOrderItem(OrderItem $item): ?\runetid\sdk\models\OrderItem
    {
        $response = $this->client->request('/pay/order/orderItem', 'POST', $item->toArray());
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        return $item->load($decode['data']);
    }

    public function getOrderItems($ownerId): array
    {
        $response = $this->client->request('/pay/order/orderItems/' . $ownerId, 'GET');
        if ($response->getStatusCode() !== 200) {
            return [];
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return [];
        }

        $result = [];

        foreach ($decode['data'] as $item) {

            $model = new \runetid\sdk\models\OrderItem();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }

    public function deleteOrderItem($itemId): bool
    {
        $response = $this->client->request('/pay/order/orderItem/' . $itemId, 'DELETE');

        return $response->getStatusCode() === 200;
    }

    public function actionGetPayUrl($orderId): ?string
    {
        $response = $this->client->request('/pay/order/payUrl/' . $orderId, 'GET');

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['url'])) {
            return null;
        }

        return $decode['url'];
    }
}