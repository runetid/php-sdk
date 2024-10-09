<?php

namespace runetid\sdk\program;

use runetid\sdk\models\Section;

class ProgramHelper
{
    private array $halls;
    private array $sections;

    public function __construct(array $halls, array $sections)
    {
        $this->halls = $halls;
        $this->sections = $sections;
    }

    /**
     * @return array<int, string>
     */
    public function getHalls(): array
    {
        $result = [];
        foreach ($this->halls as $hall) {
            $result[$hall->id] = $hall->title;
        }
        return $result;
    }


    /**
     * @return TimeInterval[]
     */
    public function getTimeIntervals(): array
    {
        $result = [];

        foreach ($this->sections as $section) {
            $result[] = new TimeInterval(
                $section->start_time->format('H:i') . '-' . $section->end_time->format('H:i'),
                $section->start_time,
                $section->end_time
            );
        }

        return $result;
    }

    public function getSection(\DateTime $start_time, int $hall_id): ?Section
    {
        foreach ($this->sections as $section) {
            if ($section->start_time == $start_time) {
                if ($section->places == null) {
                    return $section;
                }
                foreach ($section->places as $hall) {
                    if ($hall->id == $hall_id) {
                        return $section;
                    }
                }
            }
        }

        return null;
    }
}