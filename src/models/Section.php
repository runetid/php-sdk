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
    /** @var string */
    public $start_time;
    /** @var string */
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

        return $this;
    }

    public function toArray(): array
    {
        return (array) $this;
    }
}