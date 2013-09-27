<?php

namespace Ubbin\EventsBundle\Provider;

use Ubbin\EventsBundle\Entity\Event;

abstract class Provider implements ProviderInterface
{
	/**
	 * Retrieved Events
	 *
	 * @var array
	 */
	protected $events;
	
	
	public function getEvents(){
		return $this->events;
	}
	
	public function updateEvents(){
		foreach ($this->events as $event)
		{
			$this->createOrUpdateEvent($event);
		}
	}
	
    /**
     * 
     * @param \Ubbin\EventsBundle\Entity\Event $event
     * @return \Ubbin\EventsBundle\Entity\Event
     */
	private function createOrUpdateEvent(\Ubbin\EventsBundle\Entity\Event $event){
		return $event;
	}	
}