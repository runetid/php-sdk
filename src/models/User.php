<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class User implements ModelInterface
{
    /** @var int  */
    public $id;
    /** @var string */
    public $first_name;
    /** @var string */
    public $last_name;
    /** @var string */
    public $father_name;
    /** @var int */
    public $runet_id;
    /** @var string */
    public $photo;
    /** @var string */
    public $birthay;
    /** @var string */
    public $email;

    /** @var string|null  */
    public $password;

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