<?php

declare(strict_types=1);

namespace Jeboehm\DateIterator\Tests\Iterator;

use Jeboehm\DateIterator\Iterator\MonthIterator;
use Jeboehm\DateIterator\Model\DateRange;
use PHPUnit\Framework\TestCase;

class MonthIteratorTest extends TestCase
{
    private MonthIterator $iterator;

    protected function setUp(): void
    {
        $this->iterator = new MonthIterator(
            DateRange::fromString(
                '2019-12-03',
                '2020-03-31'
            )
        );
    }

    public function testDate(): void
    {
        $expected = [
            '2019-12',
            '2020-01',
            '2020-02',
            '2020-03',
        ];

        $i = 0;

        foreach ($this->iterator as $date) {
            $this->assertEquals($expected[$i], $date->format('Y-m'));

            $i++;
        }

        $this->assertEquals(4, $i);
    }
}
