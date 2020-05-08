<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Iterator;

use DateInterval;

class MonthIterator extends AbstractDateIterator
{
    public function next(): void
    {
        $this->pointer->add(new DateInterval('P1M'));
    }
}
