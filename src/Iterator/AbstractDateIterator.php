<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Iterator;

use DateTime;
use DateTimeImmutable;
use Iterator;
use Jeboehm\DateIterator\Model\DateRange;

abstract class AbstractDateIterator implements Iterator
{
    protected DateRange $range;
    protected DateTime $pointer;

    public function __construct(DateRange $range)
    {
        $this->range = $range;
        $this->pointer = DateTime::createFromImmutable($this->range->getStart());
    }

    final public function current(): DateTimeImmutable
    {
        return DateTimeImmutable::createFromMutable($this->pointer);
    }

    abstract public function next(): void;

    public function key(): string
    {
        return $this->pointer->format('Ymd');
    }

    final public function valid(): bool
    {
        return $this->pointer <= $this->range->getEnd();
    }

    final public function rewind(): void
    {
        $this->pointer = DateTime::createFromImmutable($this->range->getStart());
    }
}
