<?php

namespace runetid\sdk\models;

class Event implements ModelInterface
{
    public $id;
    public $id_name;
    public $title;
    public $info;
    public $full_info;

    public $start_time;
    public $end_time;

    public $site_url;
    public $default_role_id;

    public $visible;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if (property_exists($this, $attr)) {
                $this->{$attr} = $value;
            }
        }

        if ($this->start_time) {
            $this->start_time = new \DateTime($this->start_time);
        }
        if ($this->end_time) {
            $this->end_time = new \DateTime($this->end_time);
        }

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}