#!/usr/bin/env php
<?php
require __DIR__.'/../vendor/autoload.php';

use Symfony\Component\Console\Application;
use Hod\NbnAvailability\Command\ConsoleCommand;
use Hod\NbnAvailability\AvailabilityChecker;

$application = new Application();
$application->add(new ConsoleCommand(new AvailabilityChecker()));

$application->run();
