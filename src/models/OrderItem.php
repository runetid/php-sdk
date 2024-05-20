<?php

namespace runetid\sdk\models;

class OrderItem implements ModelInterface
{
    /** @var int  */
    public $id;
    /** @var int  */
    public $owner_id;
    /** @var User  */
    public $owner;
    /** @var int  */
    public $payer_id;
    /** @var User  */
    public $payer;
    /** @var int  */
    public $product_id;
    /** @var Product  */
    public $product;
    /** @var array  */
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