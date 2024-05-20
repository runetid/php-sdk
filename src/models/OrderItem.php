<?php

namespace runetid\sdk\models;

class OrderItem implements ModelInterface
{
    public $owner_id;
    public $owner;
    public $payer_id;
    public $payer;
    public $product_id;
    public $product;
    public $attributes;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'payer' && !empty($value)) {
                $this->payer = (new User())->load($value);
            } elseif ($attr === 'owner' && !empty($value)) {
                $this->owner = (new User())->load($value);
            } elseif ($attr === 'product' && !empty($value)) {
                $this->product = (new Product())->load($value);
            } elseif (property_exists($this, $attr)) {
                $this->{$attr} = $value;
            }
        }

        return $this;
    }

    public function toArray(): array
    {
        return (array)$this;
    }
}