<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Calendar;

/**
 * @Route("/budget")
 */
class BudgetController extends Controller {

    /**
     * @Route("/", name="budget_home")
     * @Template()
     */
    public function indexAction() {
        return array();
    }

    /**
     * @Route(
     *  "/calendar/{year}/{month}", 
     *  name="budget_calendar", 
     *  requirements={"year" = "\d+", "month" = "\d+"}, 
     *  defaults={"year" = null, "month" = null},
     *  options={"expose"=true}
     * )
     * @Template()
     */
    public function calendarAction(Request $request, $year = null, $month = null) {
        $calendar = $this->container->get('app.calendar');
        $calendar->initCalendar($year, $month);
        
        return array(
            'calendar_route_suffix' => 'calendar',
            'calendar' => $calendar,
        );
    }

    /**
     * @Route("/details/{year}/{month}", 
     *  name="budget_details", 
     *  requirements={"year" = "\d+", "month" = "\d+"}, 
     *  defaults={"year" = null, "month" = null},
     *  options={"expose"=true}
     * )
     * @Template()
     */
    public function detailsAction(Request $request, $year = null, $month = null) {
        $calendar = $this->container->get('app.calendar');
        $calendar->initCalendar($year, $month);
        
        return array(
            'calendar_route_suffix' => 'details',
            'calendar' => $calendar,
        );
    }

    /**
     * @Route("/details/{year}/{month}", 
     *  name="budget_summary", 
     *  requirements={"year" = "\d+", "month" = "\d+"}, 
     *  defaults={"year" = null, "month" = null},
     *  options={"expose"=true}
     * )
     * @Template()
     */
    public function summaryAction(Request $request, $year = null, $month = null) {
        $calendar = $this->container->get('app.calendar');
        $calendar->initCalendar($year, $month);
        
        return array(
            'calendar_route_suffix' => 'summary',
            'calendar' => $calendar,
        );
    }

}
