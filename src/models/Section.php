<?php

namespace runetid\sdk\models;

class Section implements ModelInterface
{
    public $id;
    public $event_id;
    public $title;
    public $start_time;
    public $end_time;

    public $hall;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'hall') {
                $this->hall = (new SectionHall())->load($value);
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