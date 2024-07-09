<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class Order implements ModelInterface
{
    /** @var int  */
    public $id;
    /** @var string  */
    public $number;
    /** @var bool */
    public $juridical;
    /** @var int  */
    public $event_id;
    /** @var bool  */
    public $paid;
    /** @var string|null */
    public $paid_time;
    /** @var float  */
    public $total;

    /** @var Event */
    public $event;
    /** @var User */
    public $payer;
    /** @var OrderItem[]  */
    public $items;
    /** @var OrderJuridical  */
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