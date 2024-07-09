<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class SectionHall implements ModelInterface
{
    /** @var int  */
    public $id;
    /** @var string */
    public $title;

    public function load(\ArrayAccess|array $data): self
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