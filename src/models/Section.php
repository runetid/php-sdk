<?php
/** @noinspection PhpUnused */

namespace runetid\sdk\models;

class Section implements ModelInterface
{
    /** @var int  */
    public $id;
    /** @var int */
    public $event_id;
    /** @var string */
    public $title;
    /** @var \DateTime */
    public $start_time;
    /** @var \DateTime */
    public $end_time;
    /** @var string */
    public $info;
    public $full_info;
    /** @var SectionHall[]  */
    public $halls;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'halls' && !empty($value)) {
                foreach ($value as $hall) {
                    $this->halls[] = (new SectionHall())->load($hall);
                }
            } elseif (property_exists($this, $attr)) {
                $this->{$attr} = $value;
            }
        }

        if ($this->start_time && is_string($this->start_time)) {
            $this->start_time = new \DateTime($this->start_time);
        }
        if ($this->end_time && is_string($this->end_time)) {
            $this->end_time = new \DateTime($this->end_time);
        }

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}