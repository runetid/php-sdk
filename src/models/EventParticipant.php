<?php

namespace runetid\sdk\models;

class EventParticipant implements ModelInterface
{

    public $user_id;
    public $event_id;

    public $role_id;

    public $attributes = [];

    public function load(array $data): EventParticipant
    {
        foreach ($data as $attr => $value) {
            if (property_exists($this, $attr)) {
                $this->{$attr} = $value;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}