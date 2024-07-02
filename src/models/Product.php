<?php

namespace runetid\sdk\models;

class Product implements ModelInterface
{
    /** @var int */
    public $id;
    /** @var string  */
    public $status;
    /** @var string  */
    public $title;
    /** @var string */
    public $description;
    /** @var bool */
    public $enable_coupon;
    /** @var ProductPrice[]  */
    public $price;
    /** @var string|array */
    public $attributes;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'price' && !empty($value)) {
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