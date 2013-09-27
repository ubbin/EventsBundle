<?php

namespace Ubbin\EventsBundle\EventProvider;


use Ubbin\EventsBundle\Entity\Event;
use Ubbin\EventsBundle\Entity\EventRepository;
use Ubbin\EventsBundle\Entity\City;
use Ubbin\EventsBundle\Entity\Venue;
use Ubbin\EventsBundle\Entity\Artist;
use Ubbin\EventsBundle\Entity\EventShow;

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
    public function addEvent($name, $description, $imageUrl, \Ubbin\EventsBundle\Entity\Venue $venue, array $event_shows)
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
     * 
     * @param string $name
     * @param string $address
     * @param string $city_name
     * @return \Ubbin\EventsBundle\Entity\Venue
     */
    public function createVenue($name, $address, $city_name)
    {
		$city = new City();
		$city->setName($name);
		
		$venue = new Venue();
		$venue->setName($name);
		$venue->setAddress($address);
		$venue->setCity($city);
		return $venue;
    }

	/**
	 * 
	 * @param string $name
	 * @param string $description
	 * @param string $startDate
	 * @param string $endDate
	 * @param string $artist_name
	 * @param string $artist_description
	 * @return \Ubbin\EventsBundle\Entity\EventShow
	 */
    public function createEventShow($name, $description, $startDate, $endDate, $artist_name, $artist_description)
    {
    	$artist = new Artist();
    	$artist->setName($artist_name);
    	$artist->setDescription($artist_description);
    	
    	$event_show = new EventShow();
    	$event_show->setName($name);
    	$event_show->setDescription($description);
    	$event_show->setStartDate($startDate);
    	$event_show->setEndDate($endDate);
    	$event_show->setArtist($artist);
    	return $event_show;
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
