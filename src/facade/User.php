<?php

namespace runetid\sdk\facade;

class User extends Facade
{
    public function search(string $terms): ?array
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
            'filter' => [
                'email' => $terms
            ],
        ];

        $url ='/user/list?'.http_build_query($params);

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

            $model = new \runetid\sdk\models\User();
            $model->load($item);

            $result[] = $model;
        }

        return $result;
    }

    public function create(\runetid\sdk\models\User $user): ?\runetid\sdk\models\User
    {
        $response = $this->client->request('/user/register', 'POST', $user->toArray());
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (isset($decode['id'])) {
            return $user->load($decode);
        }

        if (false === isset($decode['data'])) {
            return null;
        }

        return $user->load($decode['data']);
    }

    public function getByToken(string $token): ?\runetid\sdk\models\User
    {
        $response = $this->client->request('/user/byToken/'.$token, 'GET');

        $decode = json_decode($response->getBody(), true);
        $user = new \runetid\sdk\models\User();

        if (false === isset($decode['data']['runet_id'])) {
            return null;
        }

        return $user->load($decode['data']);
    }

    public function getById(int $id): ?\runetid\sdk\models\User
    {
        $response = $this->client->request('/user/'.$id, 'GET');

        $decode = json_decode($response->getBody(), true);

        $user = new \runetid\sdk\models\User();

        if (false === isset($decode['data']['runet_id'])) {
            return null;
        }

        return $user->load($decode['data']);
    }
}