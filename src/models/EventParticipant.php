<?php

namespace runetid\sdk\models;

class EventParticipant implements ModelInterface
{

    public $id;
    public $user_id;
    public $event_id;

    public $role_id;

    public $attributes = [];


    /** @var User */
    public $user;
    /** @var Event */
    public $event;
    /** @var EventRole */
    public $role;

    public $created_at;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'user' && !empty($value)) {
                $this->user = (new User())->load($value);
            }elseif ($attr === 'event' && !empty($value)) {
                $this->user = (new Event())->load($value);
            }elseif ($attr === 'role' && !empty($value)) {
                $this->role = (new EventRole())->load($value);
            } elseif (property_exists($this, $attr)) {
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