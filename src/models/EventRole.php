<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class EventRole implements ModelInterface
{
    /** @var string  */
    public $title;
    /** @var int */
    public $id;
    /** @var string  */
    public $code;

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