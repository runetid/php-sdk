<?php

namespace runetid\sdk\facade;

class SectionHall extends Facade
{
    public function list(int $eventId): ?array
    {
        $params = [
            'limit' => 1,
            'offset' => 0,
            'pagination' => [
                'page' => 1,
                'perPage' => 1
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