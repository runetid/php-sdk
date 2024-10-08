<?php

namespace runetid\sdk\program;

class TimeInterval
{
    /** @var string  */
    public $title;
    /** @var \DateTime */
    public $start_time;
    /** @var \DateTime */
    public $end_time;

    public function __construct(string $title, \DateTime $start_time, \DateTime $end_time)
    {
        $this->title = $title;
        $this->start_time = $start_time;
        $this->end_time = $end_time;
    }
}