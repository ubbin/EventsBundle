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
     * 
     */
    public function addEvent($name, $description, $imageUrl, \Ubbin\EventsBundle\Entity\Venue $venue, \Ubbin\EventsBundle\Entity\EventShow $event_shows)
    {
    	$event = new Event();
    	$event->setName($name);
    	$event->setDescription($description);
    	$event->setImageUrl($imageUrl);
    	$event->setVenue($venue);
    }   
    
    /**
     * Sets the Events to be processed
     * @param array $events
     */
    public function setEvents(array $events)
    {
        $this->events = $events;
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
