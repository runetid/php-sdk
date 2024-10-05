<?php

namespace runetid\sdk\facade;

class SectionHall extends Facade
{
    public function list(int $eventId, int $limit = 10, int $offset = 0): ?array
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
            'filter' => [
                'event_id' => $eventId,
            ],
        ];

        $url ='/program/section/hall/list?'.http_build_query($params);

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

            $model = new \runetid\sdk\models\SectionHall();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }

}