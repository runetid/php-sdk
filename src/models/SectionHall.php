<?php

namespace runetid\sdk\models;

use runetid\sdk\models\ModelInterface;

class SectionHall implements ModelInterface
{
    public $id;
    public $title;

    public function load(\ArrayAccess|array $data): ModelInterface
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