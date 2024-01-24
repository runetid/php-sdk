<?php

namespace runetid\sdk\models;

class OrderItem implements ModelInterface
{
    public $owner_id;
    public $payer_id;
    public $product_id;

    public $attributes;

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