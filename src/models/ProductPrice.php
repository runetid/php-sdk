<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class ProductPrice implements ModelInterface
{
    /** @var int */
    public $id;
    /** @var string */
    public $start_time;
    /** @var string */
    public $end_time;
    /** @var numeric */
    public $cost;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if (property_exists($this, $attr)) {
                $this->{$attr} = $value;
            }
        }

        if ($this->start_time) {
            $this->start_time = new \DateTime($this->start_time);
        }
        if ($this->end_time) {
            $this->end_time = new \DateTime($this->end_time);
        }

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}