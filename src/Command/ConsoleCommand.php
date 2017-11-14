<?php

namespace Hod\NbnAvailability\Command;

use Hod\NbnAvailability\AvailabilityChecker;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ConsoleCommand extends Command
{
    private $availabilityChecker;

    public function __construct(AvailabilityChecker $availabilityChecker)
    {
        $this->availabilityChecker = $availabilityChecker;
        parent::__construct(null);
    }

    protected function configure()
    {
        $this->setName('nbn:availability');
        $this->setDescription('Retrieve the NBN availability for a location');
        $this->setHelp('Look up and return the NBN availability for a given location');
        $this->addArgument('latitude', InputArgument::REQUIRED, 'The latitude of the location to check');
        $this->addArgument('longitude', InputArgument::REQUIRED, 'The longitude of the location to check');
    }

    public function execute(InputInterface $input, OutputInterface $output)
    {
        $latitude = $input->getArgument('latitude');
        $longitude = $input->getArgument('longitude');

        $output->writeln(sprintf('Retrieving availability for location %s,%s', $latitude, $longitude));

        $availability = $this->availabilityChecker->checkAvailability($latitude, $longitude);
        echo "I got availablility:\n";
        var_dump($availability);

        $output->writeln('NBN Availability: '.$availability->serviceStatus());
        $output->writeln('Technology Type: '.$availability->technologyType());
        $output->writeln('Date Available: '.$availability->availableDate());
    }
}
