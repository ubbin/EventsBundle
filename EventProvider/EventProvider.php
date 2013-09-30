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
     * @var \Doctrine\Bundle\DoctrineBundle\Registry
     */
    protected $doctrine;

    /**
     *
     * @param \Doctrine\ORM\EntityManager $doctrine
     */
    public function __construct(\Doctrine\Bundle\DoctrineBundle\Registry $doctrine)
    {
    	$this->doctrine = $doctrine;
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
		$city->setName($city_name);
		
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
    private function createOrUpdateEvent(\Ubbin\EventsBundle\Entity\Event $temp_event)
    {
    	$event_shows = $temp_event->getEventShows();
    	if(count($event_shows)==0)
    	{
    		throw new \Exception("Event without event shows");
    	}
    	$temp_event->setVenue($this->createOrRetrieveVenue($temp_event->getVenue()));
    	$event = $this->doctrine->getRepository('UbbinEventsBundle:Event')->findByVenueNameAndDate($temp_event->getVenue(), $temp_event->getName(), $event_shows[0]->getStartDate());
    	if(!$event)
    	{
    		$event = $temp_event;
    		
    		$event_shows = $event->getEventShows();
    		$event->setEventShows(array());
    		$em = $this->doctrine->getManager();
    		$em->persist($event);
    		$em->flush();
    		
    		foreach ($event_shows as $event_show)
    		{
    			$event_show->setEvent($event);
    			$event->addEventShow($this->createOrRetrieveEventShow($event_show));
    		}
    	}
        return $event;
    }
    
    
    private function createOrRetrieveVenue(\Ubbin\EventsBundle\Entity\Venue $temp_venue)
    {
    	$city = $this->createOrRetrieveCity($temp_venue->getCity());
    	$venue = $this->doctrine->getRepository('UbbinEventsBundle:Venue')->findOneBy(array('name'=>$temp_venue->getName(), 'cityId'=>$city->getId()));
    	if(!$venue)
    	{
    		$venue = $temp_venue;
    		$venue->setCity($city);
    		$em = $this->doctrine->getManager();
    		$em->persist($venue);
    		$em->flush();
    	}
    	return $venue;
    }
    
	/**
	 * 
	 * @param \Ubbin\EventsBundle\Entity\City $temp_city
	 * @return \Ubbin\EventsBundle\Entity\City
	 */
    private function createOrRetrieveCity(\Ubbin\EventsBundle\Entity\City $temp_city)
    {
    	$city = $this->doctrine->getRepository('UbbinEventsBundle:City')->findOneBy(array('name'=>$temp_city->getName()));
    	if(!$city)
    	{
    		$city = $temp_city;
    		$em = $this->doctrine->getManager();
    		$em->persist($city);
    		$em->flush();
    	}
    	return $city;
    }
    
	/**
	 * 
	 * @param \Ubbin\EventsBundle\Entity\Artist $temp_artist
	 * @return \Ubbin\EventsBundle\Entity\Artist
	 */
    private function createOrRetrieveArtist(\Ubbin\EventsBundle\Entity\Artist $temp_artist)
    {
    	$artist = $this->doctrine->getRepository('UbbinEventsBundle:Artist')->findOneBy(array('name'=>$temp_artist->getName()));
    	if(!$artist)
    	{
    		$artist = $temp_artist;
    		$em = $this->doctrine->getManager();
    		$em->persist($artist);
    		$em->flush();
    	}
    	return $artist;
    }
    
	/**
	 * 
	 * @param \Ubbin\EventsBundle\Entity\EventShow $temp_event_show
	 * @return \Ubbin\EventsBundle\Entity\EventShow
	 */
    private function createOrRetrieveEventShow(\Ubbin\EventsBundle\Entity\EventShow $temp_event_show)
    {
    	$temp_event_show->setArtist($this->createOrRetrieveArtist($temp_event_show->getArtist()));
    	$em = $this->doctrine->getManager();
    	$em->persist($temp_event_show);
    	$em->flush();
    	return $temp_event_show;
    }
}
