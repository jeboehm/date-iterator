<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Model;

use DateTime;
use DateTimeImmutable;

final class DateRange
{
    private DateTimeImmutable $start;
    private DateTimeImmutable $end;

    public function __construct(DateTimeImmutable $start, DateTimeImmutable $end)
    {
        $this->start = $start;
        $this->end = $end;
    }

    public static function fromDateTime(DateTime $start, DateTime $end): self
    {
        return new self(
            DateTimeImmutable::createFromMutable($start),
            DateTimeImmutable::createFromMutable($end)
        );
    }

    public static function fromString(string $start, string $end, string $format = 'Y-m-d'): self
    {
        return new self(
            DateTimeImmutable::createFromFormat($format, $start),
            DateTimeImmutable::createFromFormat($format, $end)
        );
    }

    public function getStart(): DateTimeImmutable
    {
        return $this->start;
    }

    public function getEnd(): DateTimeImmutable
    {
        return $this->end;
    }
}
