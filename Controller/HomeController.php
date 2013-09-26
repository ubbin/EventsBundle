<?php

namespace Ubbin\EventsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller
{
    public function indexAction()
    {
      return $this->render('UbbinEventsBundle:Home:index.html.twig');
    }
}
