<?php
/** @noinspection PhpUnused */

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
    public $price = [];
    /** @var ProductPrice  */
    public $current_price;
    /** @var string|array */
    public $attributes;
    /** @var int  */
    public $event_id;
    /** @var string */
    public $manager;
    /** @var int */
    public $valid_period;

    public function load(\ArrayAccess|array $data): self
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'price' && !empty($value)) {
                foreach ($value as $price) {
                    $this->price[] = (new ProductPrice())->load($price);
                }
            } elseif ($attr === 'current_price' && !empty($value)) {
                $this->current_price = (new ProductPrice())->load($value);
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