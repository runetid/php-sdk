<?php

namespace runetid\sdk\models;

class Section implements ModelInterface
{
    public $id;
    public $event_id;
    public $title;
    public $start_time;
    public $end_time;

    public $halls;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'halls' && !empty($value)) {
                foreach ($value as $hall) {
                    $this->halls[] = (new SectionHall())->load($hall);
                }
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