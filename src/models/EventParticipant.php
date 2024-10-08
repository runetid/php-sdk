<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class EventParticipant implements ModelInterface, \JsonSerializable
{
    /** @var int  */
    public $id;
    /** @var int  */
    public $user_id;
    /** @var int  */
    public $event_id;
    /** @var int  */
    public $role_id;
    /** @var array  */
    public $attributes = [];


    /** @var User */
    public $user;
    /** @var Event */
    public $event;
    /** @var EventRole */
    public $role;
    /** @var string */
    public $created_at;


    public $runet_id;
    public $role_title;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'user' && !empty($value)) {
                $this->user = (new User())->load($value);
            }elseif ($attr === 'event' && !empty($value)) {
                $this->event = (new Event())->load($value);
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
        $arr = (array) $this;
        $arr['user'] = $this->user?->toArray();
        $arr['event'] = $this->event?->toArray();
        $arr['role'] = $this->role?->toArray();
        return $arr;
    }

    public function jsonSerialize():mixed
    {
        $return = [];

        foreach ($this->toArray() as $key => $value) {
            if (false === empty($this->$key)) {
                $return[$key] = $value;
            }
        }

        return $return;
    }
}