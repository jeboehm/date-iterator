<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Tests\Iterator;

use DateTime;
use Jeboehm\DateIterator\Iterator\DayIterator;
use Jeboehm\DateIterator\Model\DateRange;
use PHPUnit\Framework\TestCase;

class DayIteratorTest extends TestCase
{
    public function testDatesWithBeginningWeekend(): void
    {
        $iterator = new DayIterator(
            DateRange::fromDateTime(
                new DateTime('2021-05-01'),
                new DateTime('2021-05-14')
            )
        );

        $iterator->setExcludeWeekend(true);

        $expected = [
            '2021-05-03',
            '2021-05-04',
            '2021-05-05',
            '2021-05-06',
            '2021-05-07',
            '2021-05-10',
            '2021-05-11',
            '2021-05-12',
            '2021-05-13',
            '2021-05-14',
        ];

        $i = 0;

        foreach ($iterator as $date) {
            self::assertEquals($expected[$i], $date->format('Y-m-d'));

            $i++;
        }

        self::assertEquals(10, $i);
    }

    public function testDatesWithWeekends(): void
    {
        $iterator = new DayIterator(
            DateRange::fromDateTime(
                new DateTime('2019-12-03'),
                new DateTime('2019-12-10')
            )
        );

        $expected = [
            '2019-12-03',
            '2019-12-04',
            '2019-12-05',
            '2019-12-06',
            '2019-12-07',
            '2019-12-08',
            '2019-12-09',
            '2019-12-10',
        ];

        $i = 0;

        foreach ($iterator as $date) {
            self::assertEquals($expected[$i], $date->format('Y-m-d'));

            $i++;
        }

        self::assertEquals(8, $i);
    }

    public function testDateWithoutWeekends(): void
    {
        $iterator = new DayIterator(
            DateRange::fromDateTime(
                new DateTime('2019-12-03'),
                new DateTime('2019-12-10')
            )
        );

        $iterator->setExcludeWeekend(true);

        $expected = [
            '2019-12-03',
            '2019-12-04',
            '2019-12-05',
            '2019-12-06',
            '2019-12-09',
            '2019-12-10',
        ];

        $i = 0;

        foreach ($iterator as $date) {
            self::assertEquals($expected[$i], $date->format('Y-m-d'));

            $i++;
        }

        self::assertEquals(6, $i);
    }
}
