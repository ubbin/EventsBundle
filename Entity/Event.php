<?php

namespace Ubbin\EventsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Event
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Ubbin\EventsBundle\Entity\EventRepository")
 */
class Event
{
		
	/**
	 * 
	 * @var array;
	 * @ORM\OneToMany(targetEntity="EventShow", mappedBy="event")
	 */
	private $event_shows;
	
    /**
     * @ORM\ManyToOne(targetEntity="Venue", inversedBy="event")
     * @ORM\JoinColumn(name="venue_id", referencedColumnName="id")
     */
    protected $venue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @Gedmo\Slug(fields={"name"})
     * @ORM\Column(name="slug", type="string", length=255)
     */
    private $slug;

    /**
     * @var integer
     *
     * @ORM\Column(name="venue_id", type="integer")
     */
    private $venueId;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="image_url", type="string", length=255, nullable=true)
     */
    private $imageUrl;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Event
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set slug
     *
     * @param string $slug
     * @return Event
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set venueId
     *
     * @param integer $venueId
     * @return Event
     */
    public function setVenueId($venueId)
    {
        $this->venueId = $venueId;

        return $this;
    }

    /**
     * Get venueId
     *
     * @return integer
     */
    public function getVenueId()
    {
        return $this->venueId;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Event
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return Event
     */
    public function setImageUrl($imageUrl)
    {
        $this->imageUrl = $imageUrl;

        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set venue
     *
     * @param \Ubbin\EventsBundle\Entity\Venue $venue
     * @return Event
     */
    public function setVenue(\Ubbin\EventsBundle\Entity\Venue $venue = null)
    {
        $this->venue = $venue;

        return $this;
    }

    /**
     * Get venue
     *
     * @return \Ubbin\EventsBundle\Entity\Venue
     */
    public function getVenue()
    {
        return $this->venue;
    }
    
    /**
     * Set the Event Shows
     * @param array $event_shows
     * @return \Ubbin\EventsBundle\Entity\Event
     */
    public function setEventShows(array $event_shows)
    {
    	$this->event_shows = $event_shows;
    
    	return $this;
    }
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->event_shows = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Add event_shows
     *
     * @param \Ubbin\EventsBundle\Entity\EventShow $eventShows
     * @return Event
     */
    public function addEventShow(\Ubbin\EventsBundle\Entity\EventShow $eventShows)
    {
        $this->event_shows[] = $eventShows;
    
        return $this;
    }

    /**
     * Remove event_shows
     *
     * @param \Ubbin\EventsBundle\Entity\EventShow $eventShows
     */
    public function removeEventShow(\Ubbin\EventsBundle\Entity\EventShow $eventShows)
    {
        $this->event_shows->removeElement($eventShows);
    }

    /**
     * Get event_shows
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEventShows()
    {
        return $this->event_shows;
    }
}