<?php

namespace Ubbin\EventsBundle\EventProvider;


use Ubbin\EventsBundle\Entity\Event;
use Ubbin\EventsBundle\Entity\EventRepository;

class EventProvider
{
    /**
     * Retrieved Events
     *
     * @var array
     */
    protected $events;

    /**
     *
     * @var \Ubbin\EventsBundle\Entity\EventRepository
     */
    protected $event_repository;

    /**
     *
     * @param \Ubbin\EventsBundle\Entity\EventRepository $event_repository
     */
    public function __construct(\Ubbin\EventsBundle\Entity\EventRepository $event_repository)
    {
        $this->event_repository = $event_repository;
    }

	/**
	 * Adds a new event for update/create
	 * @param string $name
	 * @param string $description
	 * @param string $imageUrl
	 * @param \Ubbin\EventsBundle\Entity\Venue $venue
	 * @param \Ubbin\EventsBundle\Entity\EventShow $event_shows
	 * @return \Ubbin\EventsBundle\Entity\Event
	 */
    public function addEvent($name, $description, $imageUrl, \Ubbin\EventsBundle\Entity\Venue $venue, \Ubbin\EventsBundle\Entity\EventShow $event_shows)
    {
    	$event = new Event();
    	$event->setName($name);
    	$event->setDescription($description);
    	$event->setImageUrl($imageUrl);
    	$event->setVenue($venue);
    	$event->setEventShows($event_shows);
    	$this->events[] = $event;
    	return $event;
    }   
    
	/**
	 *Sets the Events to be processed
	 * @param array $events
	 * @return \Ubbin\EventsBundle\EventProvider\EventProvider
	 */
    public function setEvents(array $events)
    {
        $this->events = $events;
        return $this;
    }

    /**
     * Gets the Events
     * @return multitype:
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Updates the events
     */
    public function updateEvents()
    {
        foreach ($this->events as $event) {
            $this->createOrUpdateEvent($event);
        }
        return $this;
    }

    /**
     *
     * @param \Ubbin\EventsBundle\Entity\Event $event
     * @return \Ubbin\EventsBundle\Entity\Event
     */
    private function createOrUpdateEvent(\Ubbin\EventsBundle\Entity\Event $event)
    {
        return $event;
    }
}
