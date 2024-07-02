<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\EventParticipant;

class Event extends Facade
{
    public function getByAlias(string $alias): ?\runetid\sdk\models\Event
    {
        $response = $this->client->request('/event/byAlias/'.$alias, 'GET');

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $model = new \runetid\sdk\models\Event();
        $model->load($decode['data']);

        return $model;
    }

    public function getById(int $id): ?\runetid\sdk\models\Event
    {
        $response = $this->client->request('/event/'.$id, 'GET');

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $model = new \runetid\sdk\models\Event();
        $model->load($decode['data']);

        return $model;
    }

    public function register(int $userId, int $roleId, array $attributes = []): ?EventParticipant
    {
        $params = [
            'user_id' => $userId,
            'role_id' => $roleId,
            'attributes' => $attributes,
        ];

        $response = $this->client->request('/event/register', 'POST', $params);
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $model = new EventParticipant();
        $model->load($decode['data']);

        return $model;
    }

    public function program(): ?array
    {
        $params = [
            'limit' => 100,
            'offset' => 0,
            'pagination' => [
                'page' => 1,
                'perPage' => 10
            ],
            'sort' => [
                'field' => 'start_time',
                'order' => 'ASC'
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

    public function products()
    {
        $params = [
            'limit' => 100,
            'offset' => 0,
            'pagination' => [
                'page' => 1,
                'perPage' => 10
            ],
        ];

        $url ='/products/list?'.http_build_query($params);

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

            $model = new \runetid\sdk\models\Product();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }

    public function searchParticipant($email): ?array
    {
        $params = [
            'limit' => 1,
            'offset' => 0,
            'pagination' => [
                'page' => 1,
                'perPage' => 1
            ],
            'filter' => [
                'email' => $email,
            ],
        ];

        $url ='/event/participant/list?'.http_build_query($params);

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

            $model = new \runetid\sdk\models\EventParticipant();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }
}