<?php

namespace AppBundle\Entity;

use Symfony\Component\DependencyInjection\ContainerInterface;
use When\When as RecursableCalendar;

class Calendar {

    private $container;
    private $now = null;
    private $today = null;
    private $date = null;
    private $startDate = null;
    private $endDate = null;
    private $previousYear = null;
    private $previousMonth = null;
    private $nextMonth = null;
    private $nextYear = null;
    //private $days = [];
    //private $weeks = [];
    private $operations = [];
    private $data = [];
    private $chart = [];
    private $engine = null;
    private $previousBalance = 0;
    private $previousCalendarBalance = 0;
    private $closingBalance = 0;
    private $dailyBalance = [];
    private $balanceAdjustments = [];
    private $calendarDateFormat = 'Ymd';
    private $calendarNavDateFormat = 'Ym';
    
    private $categories = [];

    public function __construct(ContainerInterface $container) {
        $this->container = $container;

        $this->now = new \DateTime('now');
        $this->today = clone($this->now);

        $this->engine = new RecursableCalendar();
    }

    public function getData() {
        return $this->data;
    }

    public function getChart() {
        return $this->chart;
    }

    public function getNow() {
        return $this->today;
    }

    public function getToday() {
        return $this->today;
    }

    public function setDate(\DateTime $date) {
        $this->date = $date;
    }

    public function getDate() {
        return $this->date;
    }

    public function getStartDate() {
        return $this->startDate;
    }

    public function getEndDate() {
        return $this->endDate;
    }

    public function getPreviousYear() {
        return $this->previousYear;
    }

    public function getPreviousMonth() {
        return $this->previousMonth;
    }

    public function getNextMonth() {
        return $this->nextMonth;
    }

    public function getNextYear() {
        return $this->nextYear;
    }

    public function getPreviousBalance() {
        return $this->previousBalance;
    }

    public function getPreviousCalendarBalance() {
        return $this->previousCalendarBalance;
    }

    public function getClosingBalance() {
        return $this->closingBalance;
    }

    public function getDateFormatted($date, $format = 'Y-m-d') {
        return $this->$date->format($format);
    }

    public function isToday() {
        return $this->date === new \DateTime('now');
    }

    public function initCalendar($year = null, $month = null) {
        $date = new \DateTime('now');

        if ($year) {
            $date->setDate($year, $date->format('m'), $date->format('d'));
        }

        if ($month) {
            $date->setDate($date->format('Y'), $month, $date->format('d'));
        }

        $this->setDate($date);

        $this->defineCalendarLimits();
        $this->defineCalendarNav();
        $this->defineCalendarDays();
        $this->loadCategories();
        $this->loadOperations();
        $this->buildCalendarData();
        $this->updateBalanceHistory();
        $this->buildCalendarChartData();
    }

    private function defineCalendarLimits() {
        $this->startDate = clone($this->date);
        $this->endDate = clone($this->date);

        $this->startDate->modify('first day of this month');
        if ($this->startDate->format('w') > 0) { // Not a Sunday
            $this->startDate->modify('last sunday');
        }
        if ($this->startDate->format('j') == 1) { // First day of the month
            $this->startDate->modify('7 days ago');
        }
        $this->startDate->setTime(0, 0, 0);

        $this->endDate->modify('last day of this month');
        if ($this->endDate->format('w') < 6) { // Not a Saturday
            $this->endDate->modify('next saturday');
        }
        if ($this->endDate->format('j') == $this->endDate->format('t')) { // Last day of the month
            $this->endDate->modify('+7 days');
        }
        $this->endDate->setTime(23, 59, 59);
    }

    private function defineCalendarNav() {
        $this->previousYear = clone($this->date);
        $this->previousYear->modify('previous year');
        $this->previousMonth = clone($this->date);
        $this->previousMonth->modify('previous month');

        $this->nextMonth = clone($this->date);
        $this->nextMonth->modify('next month');
        $this->nextYear = clone($this->date);
        $this->nextYear->modify('next year');
    }

    private function defineCalendarDays() {
        $this->engine->startDate($this->startDate)
                ->freq('daily')
                ->until($this->endDate)
                ->generateOccurrences();
        foreach ($this->engine->occurrences as $day) {
            $occ = [
                'date' => $day,
                'operations' => [],
                'balance' => 0,
            ];
            $this->data[$day->format($this->calendarDateFormat)] = $occ;
        }
    }

    public function loadCategories() {
        $em = $this->container->get('doctrine')->getManager();

        $repo = $em->getRepository('AppBundle:Category');

        $this->categories = $repo->findAll(['order' => 'asc']);
    }

    public function getCategories() {
        return $this->categories;
    }

    public function loadOperations() {
        $em = $this->container->get('doctrine')->getManager();

        $repo = $em->getRepository('AppBundle:Operation');

        $user = $this->container->get('security.token_storage')->getToken()->getUser();

        $this->operations = $repo->findByUser($user->getId(), ['category' => 'asc', 'name' => 'asc']);
    }

    public function getOperations($category = null) {
        if($category) {
            $operations = [];
            foreach($this->operations as $operation) {
                if($operation->getCategory()->getId() == $category) {
                    $operations[]  = $operation;
                }
            }
            
            return $operations;
        }
        
        return $this->operations;
    }

    public function buildCalendarData() {
        $this->balanceAdjustments = [];
        $this->dailyBalance = [];

        /* @var $operation Operation */
        foreach ($this->operations as $operation) {
            foreach($operation->getInstances() as $instance) {
                $op_start = $instance->getStartDate();
                if ($op_start->format($this->calendarDateFormat) <= $this->endDate->format($this->calendarDateFormat)) {
                    $op_end = clone($this->getEndDate());
                    if ($instance->getEndDate() !== null) {
                        $op_end = $instance->getEndDate();
                    }

                    // Generate instance occurences
                    $recur = new RecursableCalendar();
                    $recurrence = (
                        $instance->getRecurrence() === Instance::RECUR_ADJUSTBALANCE
                            || $instance->getRecurrence() === Instance::RECUR_ONCE
                    ) ? Instance::RECUR_DAILY : $instance->getRecurrence();
                    $recur->startDate($op_start)
                            ->freq($recurrence)
                            ->until($op_end)
                    ;
                    if ($instance->getCount()) {
                        $recur->count($instance->getCount());
                    }
                    if ($instance->getRecurrenceInterval() > 0) {
                        $recur->interval($instance->getRecurrenceInterval());
                    }
                    $recur->generateOccurrences();
                    if ($instance->getDays() !== null) {
                        $instance->setDays(split(',', $instance->getDays()));
                        $recur->byday($instance->getDays());
                    }

                    foreach ($recur->occurrences as $occ) {
                        $op = clone $instance;
                        if ($op->hasModifications()) {
                            foreach ($op->getModifications() as $modification) {
                                $occurenceHasModification = ($modification->getOldDate()->format($this->calendarDateFormat) === $occ->format($this->calendarDateFormat));
                                if ($occurenceHasModification && $modification->getNewAmount() !== null) {
                                    $op->setAmount($modification->getNewAmount());
                                }
                                if ($occurenceHasModification && $modification->getNewDate() !== null) {
                                    $occ = $modification->getNewDate();
                                }
                            }
                        }

                        if ($op->getRecurrence() === Instance::RECUR_ADJUSTBALANCE) {
                            $this->balanceAdjustments[$op_start->format($this->calendarDateFormat)] = $op->getAmount();
                        }

                        $daily_index = $occ->format($this->calendarDateFormat);
                        if (!isset($this->dailyBalance[$daily_index])) {
                            $this->dailyBalance[$daily_index] = 0;
                        }
                        $this->dailyBalance[$daily_index] += $op->getAmount();

                        if (
                            $occ->format($this->calendarDateFormat) >= $this->getStartDate()->format($this->calendarDateFormat) && 
                            $occ->format($this->calendarDateFormat) <= $this->getEndDate()->format($this->calendarDateFormat)
                        ) {
                            $this->data[$occ->format($this->calendarDateFormat)]['operations'][] = $op;
                        }
                    }
                }
            }
        }
        
        ksort($this->dailyBalance);
    }

    public function updateBalanceHistory() {
        $balance = 0;
        $this->previousBalance = 0;
        $this->previousCalendarBalance = 0;
        $this->closingBalance = 0;

        $dailyBalance = [];
        
        foreach ($this->dailyBalance as $balanceDate => $amount) {
            $balanceMonth = substr($balanceDate, 0, 6);
            $nowBalanceMonth = $this->date->format($this->calendarNavDateFormat);
            $isPreviousMonth = $balanceMonth < $nowBalanceMonth;
            $isNextMonth = $balanceMonth > $nowBalanceMonth;
            $isInCalendar = $balanceDate >= $this->getStartDate()->format($this->calendarDateFormat) 
                    && $balanceDate <= $this->getEndDate()->format($this->calendarDateFormat);
            // Check if has balance adjustment operation on given date
            if (isset($this->balanceAdjustments[$balanceDate])) {
                $amount = $this->balanceAdjustments[$balanceDate];
                $balance = $amount;
                if ($isPreviousMonth) {
                    $this->previousBalance = $amount;
                }
                if (!$isInCalendar) {
                    $this->previousCalendarBalance = $amount;
                }
                if (!$isNextMonth) {
                    $this->closingBalance = $amount;
                }
            } else {
                $balance += $amount;
                if ($isPreviousMonth) {
                    $this->previousBalance += $amount;
                }
                if (!$isInCalendar) {
                    $this->previousCalendarBalance += $amount;
                }
                if (!$isNextMonth) {
                    $this->closingBalance += $amount;
                }
            }
            if (!isset($dailyBalance[$balanceDate])) {
                $dailyBalance[$balanceDate] = 0;
            }
            $dailyBalance[$balanceDate] = $balance;
        }

        $this->dailyBalance = $dailyBalance;
        ksort($this->dailyBalance);
    }

    public function buildCalendarChartData() {
        $count = 0;
        $balanceGraphData = array();
        $balance = $this->previousCalendarBalance;
        $chartMinValue = 0;
        $chartMaxValue = 0;
        foreach ($this->data as $index => $data) {
            $day = $data['date'];
            $balanceMonth = substr($day->format($this->calendarNavDateFormat), 0, 6);
            $nowBalanceMonth = $this->date->format($this->calendarNavDateFormat);
            $isCurrentMonth = $balanceMonth === $nowBalanceMonth;
            if (isset($this->dailyBalance[$day->format($this->calendarDateFormat)])) {
                $balance = $this->dailyBalance[$day->format($this->calendarDateFormat)];
            }
            if ($balance < $chartMinValue) {
                $chartMinValue = $balance;
            }
            if ($balance > $chartMaxValue) {
                $chartMaxValue = $balance;
            }
            $balanceGraphDayData = array(
                'x' => $count,
                'y' => $balance,
                'label' => $day->format('d'),
                'color' => ($balance < 0) ? 'red' : 'blue',
            );
            $colorTone = ($day->format('Ym') <> $this->now->format('Ym')) ? 'dark' : '';
            $balanceGraphDayData['color'] = $colorTone . $balanceGraphDayData['color'];
            $balanceGraphData[] = $balance;
            $balanceGraphLabels[] = $day->format('j');
            $count++;
        }
        $chartMinValue = floor($chartMinValue / 10) * 10;
        $chartMaxValue = ceil($chartMaxValue / 10) * 10;
        $chartRange = abs($chartMinValue) + $chartMaxValue;
        $chartInterval = $chartRange / 5;
        $chartInterval = ceil($chartInterval / 10) * 10;

        $this->chart = [
            'values' => $balanceGraphData,
            'labels' => $balanceGraphLabels,
            'minValue' => $chartMinValue,
            'maxValue' => $chartMaxValue,
            'range' => $chartRange,
            'interval' => $chartInterval,
        ];
    }

}
