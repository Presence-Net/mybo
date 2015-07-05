<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * @Route("/budget")
 */
class BudgetController extends Controller
{
    /**
     * @Route("/", name="budget_home")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }

    /**
     * @Route("/calendar", name="budget_calendar")
     * @Template()
     */
    public function calendarAction()
    {
        return array();
    }

    /**
     * @Route("/details", name="budget_details")
     * @Template()
     */
    public function detailsAction()
    {
        return array();
    }

    /**
     * @Route("/summary", name="budget_summary")
     * @Template()
     */
    public function summaryAction()
    {
        return array();
    }
}
