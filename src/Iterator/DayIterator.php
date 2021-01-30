<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Iterator;

use DateInterval;
use Jeboehm\DateIterator\Model\DateRange;

class DayIterator extends AbstractDateIterator
{
    private bool $excludeWeekend = false;

    public function setExcludeWeekend(bool $excludeWeekend): void
    {
        $this->excludeWeekend = $excludeWeekend;
        $start = $this->range->getStart();

        if ($excludeWeekend === true && $start->format('N') >= 6) {
            $start = $start->add(new DateInterval(sprintf('P%dD', 8 - (int)$start->format('N'))));

            $this->range = new DateRange($start, $this->range->getEnd());
        }
    }

    public function next(): void
    {
        $this->pointer->add(new DateInterval('P1D'));

        if ($this->excludeWeekend && (int)$this->pointer->format('N') >= 6) {
            $this->pointer->add(new DateInterval(sprintf('P%dD', 8 - (int)$this->pointer->format('N'))));
        }
    }
}
