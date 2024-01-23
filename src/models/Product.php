<?php

namespace runetid\sdk\models;

class Product implements ModelInterface
{
    public $id;
    public $status;
    public $title;
    public $description;
    public $enable_coupon;

    public $price;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === '$price' && !empty($value)) {
                foreach ($value as $price) {
                    $this->$price[] = (new ProductPrice())->load($price);
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