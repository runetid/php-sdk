<?php

namespace runetid\sdk\models;

class Order implements ModelInterface
{
    public $id;
    public $number;
    public $juridical;
    public $event_id;
    public $paid;
    public $paid_time;
    public $total;


    public $event;
    public $payer;
    public $items;
    public $order_juridical;


    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'event' && !empty($value)) {
                $this->event = (new Event())->load($value);
            } elseif ($attr === 'payer' && !empty($value)) {
                $this->payer = (new User())->load($value);
            } elseif ($attr === 'order_juridical' && !empty($value)) {
                $this->payer = (new OrderJuridical())->load($value);
            } elseif ($attr === 'items' && !empty($items)) {
                foreach ($items as $item) {
                    $this->items[] = (new OrderItem())->load($item);
                }
            }

            elseif (property_exists($this, $attr)) {
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