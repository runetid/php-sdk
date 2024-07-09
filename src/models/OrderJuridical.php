<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class OrderJuridical implements ModelInterface
{
    /** @var int */
    public $id;
    /** @var string */
    public $order_id;
    /** @var string */
    public $delivery_type;
    /** @var string */
    public $name;
    /** @var string */
    public $address;
    /** @var string */
    public $post_address;
    /** @var string */
    public $inn;
    /** @var string */
    public $kpp;
    /** @var string */
    public $phone;
    /** @var string */
    public $fax;
    /** @var string */
    public $bank_name;
    /** @var string */
    public $checking_account;
    /** @var string */
    public $cor_account;
    /** @var string */
    public $bik;
    /** @var string */
    public $contact_email;
    /** @var string */
    public $contact_person;
    /** @var string */
    public $hash;
    

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
        return (array)$this;
    }
}