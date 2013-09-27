<?php

namespace Ubbin\EventsBundle\Provider;


/**
 * Provider interface
 *
 */

interface ProviderInterface
{
	/**
	 * Retrieves events from provider
	 * 
	 * @return array
	 */
	function getEvents();
	
	/**
	 * Update events 
	 *
	 * @return array
	 */
	function updateEvents();	
	
	
}