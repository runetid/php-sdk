<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\Product as ProductModel;

class Product extends Facade
{
    public function byId(int $id): ?ProductModel
    {
        $response = $this->client->request('/products/'.$id, 'GET');

        $decode = json_decode($response->getBody(), true);

        $product = new ProductModel();

        if (false === isset($decode['data'])) {
            return null;
        }

        return $product->load($decode);
    }

    /**
     * @param array $filter
     * @return ProductModel[]
     */
    public function search(array $filter, int $limit = 10, int $offset = 0): array
    {
        $params = [
            'limit' => $limit,
            'offset' => $offset,
            'pagination' => [
                'page' => 1,
                'perPage' => $limit
            ],
            'sort' => [
                'field' => 'id',
                'order' => 'DESC'
            ],
            'filter' => $filter,
        ];

        $url ='/products/list?'.http_build_query($params);

        $response = $this->client->request($url, 'GET');

        if ($response->getStatusCode() !== 200) {
            return [];
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return [];
        }

        $result = [];

        foreach ($decode['data'] as $item) {

            $model = new ProductModel();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }
}