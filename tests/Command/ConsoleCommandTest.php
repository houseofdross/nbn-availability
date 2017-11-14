<?php

namespace HodTest\NbnAvailability\Command;

use Hod\NbnAvailability\AvailabilityChecker;
use Hod\NbnAvailability\Command\ConsoleCommand;
use Hod\NbnAvailability\Entity\AvailabilityStatus;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\BufferedOutput;

class ConsoleCommandTest extends TestCase
{
    public function testExecuteWritesCorrectOutput()
    {
        $mockedChecker = \Mockery::mock(AvailabilityChecker::class);
        $mockedChecker->shouldReceive('checkAvailability')
            ->once()
            ->withArgs([1, 2])
            ->andReturn(
                new AvailabilityStatus('proposed', 'Hybrid Fiber Coaxial (HFC)', 'serviceCategory', 'Jul-Sep 2018')
            );

        $mockedInput = \Mockery::mock(InputInterface::class);
        $mockedInput->shouldReceive('getArgument')->with('latitude')->andReturn('1');
        $mockedInput->shouldReceive('getArgument')->with('longitude')->andReturn('2');


        $command = new ConsoleCommand($mockedChecker);
        $bufferedOutput = new BufferedOutput();

        $command->execute($mockedInput, $bufferedOutput);

        $expected = <<<END
Retrieving availability for location 1,2
NBN Availability: proposed
Technology Type: Hybrid Fiber Coaxial (HFC)
Date Available: Jul-Sep 2018
END;

        $this->assertEquals(trim($expected), trim($bufferedOutput->fetch()));
    }
}
