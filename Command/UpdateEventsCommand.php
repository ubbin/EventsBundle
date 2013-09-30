<?php
namespace Ubbin\EventsBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Ubbin\EventsBundle\EventProvider\EventProvider;

class UpdateEventsCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this
		->setName('UbbinEvents:update')
		->setDescription('Updates events')
		;
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{		
	    $provider = new EventProvider($this->getContainer()->get('doctrine'));

	    $venue = $provider->createVenue('Casa da Música', 'Praça Mouzinho de Albuquerque, 123', 'Porto');
	    $event_show = $provider->createEventShow('Evento', '', new \DateTime("2014-07-09 11:14:15"), new \DateTime("2014-07-09 11:14:15"), 'Metallica', 'Metallica são Fixes!');
	    $event_shows[] = $event_show;
	    
	    $provider->addEvent('Concerto dos Metallica na Casa da música', 'Grandioso concerto....', null, $venue, $event_shows);
	    $provider->updateEvents();
	    
	}
}