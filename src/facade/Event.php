<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\EventParticipant;

class Event extends Facade
{
    public function getByAlias(string $alias): ?\runetid\sdk\models\Event
    {
        $response = $this->client->request('/event/'.$alias, 'GET');

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

    public function register(int $eventId, int $userId, int $roleId, array $attributes = []): ?EventParticipant
    {
        $response = $this->client->request('/event/register', 'POST', [
            'event_id' => $eventId,
            'user_id' => $userId,
            'role_id' => $roleId,
            'attributes' => $attributes,
        ]);
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
}