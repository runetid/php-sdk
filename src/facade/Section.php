<?php

namespace runetid\sdk\facade;

use runetid\sdk\models\Section as SectionModel;

class Section extends Facade
{
    public function getById($id): ?SectionModel
    {
        $response = $this->client->request('/program/section/'.$id, 'GET');

        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $model = new SectionModel();
        $model->load($decode['data']);

        return $model;
    }

    public function create(SectionModel $section): ?SectionModel
    {
        $response = $this->client->request('/program/section', 'POST', $section->toArray());
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $model = new SectionModel();
        $model->load($decode['data']);

        return $model;
    }

    public function update(SectionModel $section): ?SectionModel
    {
        $response = $this->client->request('/program/section/'.$section->id, 'PUT', $section->toArray());
        if ($response->getStatusCode() !== 200) {
            return null;
        }

        $decode = json_decode($response->getBody(), true);

        if (false === isset($decode['data'])) {
            return null;
        }

        $model = new SectionModel();
        $model->load($decode['data']);

        return $model;
    }
}