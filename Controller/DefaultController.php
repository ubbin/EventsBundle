<?php

namespace Ubbin\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('UbbinEventsBundle:Default:index.html.twig', array('name' => $name));
    }
}
