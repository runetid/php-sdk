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
    public $places;
    /** @var EventParticipant[] */
    public $participants;

    public function load(\ArrayAccess|array $data): ModelInterface
    {
        foreach ($data as $attr => $value) {
            if ($attr === 'places' && !empty($value)) {
                foreach ($value as $hall) {
                    $this->places[] = (new SectionHall())->load($hall);
                }
            } elseif ($attr === 'participants' && !empty($value)) {
                foreach ($value as $participant) {
                    $this->participants[] = (new EventParticipant())->load($participant);
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
        $arr = (array) $this;
        $arr['start_time'] = $this->start_time->format(\DateTime::ATOM);
        $arr['end_time'] = $this->end_time->format(\DateTime::ATOM);

        return $arr;
    }
}