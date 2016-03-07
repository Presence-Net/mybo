<?php

namespace AppBundle\Controller\Api;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;

use AppBundle\Entity\Calendar;

class CalendarController extends ApiController
{
    public function __construct() {
        $this->class = 'Calendar';
        $this->parentField = null;
    }
    
    /**
      * @Rest\Get("/calendar/{year}/{month}", requirements={"year" = "\d+", "month" = "\d+"}, defaults={"id" = null, "id" = null})
      */
    public function getAction($year, $month)
    {
        $calendar = $this->container->get('app.calendar');
        $calendar->initCalendar($year, $month);
        
        return $this->createView($calendar, array('calendar'));
    }
}
