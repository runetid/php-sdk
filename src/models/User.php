<?php

namespace runetid\sdk\models;

class User implements ModelInterface
{

    public $id;
    public $first_name;
    public $last_name;
    public $father_name;

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