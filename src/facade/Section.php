<?php

namespace runetid\sdk\facade;

class Section extends Facade
{
    public function list(): ?array
    {
        $params = [
            'limit' => 1,
            'offset' => 0,
            'pagination' => [
                'page' => 1,
                'perPage' => 10
            ],
            'sort' => [
                'field' => 'id',
                'order' => 'DESC'
            ],
        ];

        $url ='/program/section/list?'.http_build_query($params);

        $response = $this->client->request($url, 'GET');

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $result = [];

        foreach ($decode['data'] as $item) {

            $model = new \runetid\sdk\models\Section();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }
}