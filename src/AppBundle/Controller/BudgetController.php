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
        $date = new \DateTime('now');
        $year = $year ? $year : $date->format('Y');
        $month = $month ? $month : $date->format('m');
        $day = $date->format('d');

        $calendar = new Calendar("{$year}-{$month}-{$day}");

        return array(
            'calendar' => $calendar,
        );
    }

    /**
     * @Route("/details", name="budget_details")
     * @Template()
     */
    public function detailsAction() {
        return array();
    }

    /**
     * @Route("/summary", name="budget_summary")
     * @Template()
     */
    public function summaryAction() {
        return array();
    }

}
