<?php

namespace Spatie\CalendarLinks\Tests\Generators;

use Spatie\CalendarLinks\Generator;
use Spatie\CalendarLinks\Generators\Ics;
use Spatie\CalendarLinks\Tests\TestCase;
use Sabre\VObject\Component\VCalendar;

class IcsGeneratorTest extends TestCase
{
    use GeneratorTestContract;

    protected function generator(): Generator
    {
        // extend base class just to make output more readable and simplify reviewing of the snapshot diff
        return new class extends Ics {
            protected function buildLink(VCalendar $vcalendar): string
            {
                return $vcalendar->serialize();
            }
        };
    }

    protected function linkMethodName(): string
    {
        return 'ics';
    }

    /** @test */
    public function it_can_generate_an_ics_link_with_custom_uid()
    {
        $this->assertMatchesSnapshot(
            $this->createShortEventLink()->ics(['UID' => 'random-uid'])
        );
    }

    /** @test */
    public function it_can_generate_an_ics_timezoned_link()
    {
        $this->assertMatchesSnapshot(
            $this->createTimezonedLink()->ics()
        );
    }

    /** @test */
    public function it_can_generate_an_ics_timezoned_all_day_link()
    {
        $this->assertMatchesSnapshot(
            $this->createTimezonedAllDayLink()->ics()
        );
    }
}
