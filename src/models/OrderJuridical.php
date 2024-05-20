<?php

namespace runetid\sdk\models;

class OrderJuridical implements ModelInterface
{
    public $id;
    public $order_id;
    public $delivery_type;
    public $name;
    public $address;
    public $post_address;
    public $inn;
    public $kpp;
    public $phone;
    public $fax;
    public $bank_name;
    public $checking_account;
    public $cor_account;
    public $bik;
    public $contact_email;
    public $contact_person;
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