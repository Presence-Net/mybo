<?php

namespace AppBundle\Entity;

use When\When as RecursableCalendar;

class Calendar
{
    private $today = null;
    private $date = null;
    
    private $dateStart = null;
    private $dateEnd = null;
    
    private $previousYear = null;
    private $previousMonth = null;
    private $nextMonth = null;
    private $nextYear = null;

    //private $days = [];
    //private $weeks = [];
    private $operations = [];
    private $data = [];
    
    private $engine = null;

    private $previousBalance = 0;
    private $previousCalendarBalance = 0;
    private $closingBalance = 0;
    
    public function __construct($date) {
        $this->today = new \DateTime('now');
        
        $this->date = new \DateTime($date);
        
        $this->engine = new RecursableCalendar();
        
        $this->initCalendar();

        // Setup previous month/year
        
        // Setup nest month/year

    }
    
    public function getData()
    {
        return $this->data;
    }
    
    public function getToday()
    {
        return $this->today;
    }
    
    public function getDate()
    {
        return $this->date;
    }
    
    public function getPreviousYear()
    {
        return $this->previousYear;
    }

    public function getPreviousMonth()
    {
        return $this->previousMonth;
    }

    public function getNextMonth()
    {
        return $this->nextMonth;
    }

    public function getNextYear()
    {
        return $this->nextYear;
    }

    public function getDateFormatted($date, $format = 'Y-m-d')
    {
        return $this->$date->format($format);
    }

    protected function initCalendar()
    {
        $this->defineCalendarLimits();
        $this->defineCalendarNav();
        $this->defineCalendarDays();
    }
    
    private function defineCalendarDays()
    {
        $this->engine->startDate($this->dateStart)
            ->freq('daily')
            ->until($this->dateEnd)
            ->generateOccurrences();
	foreach($this->engine->occurrences as $day) {
            $op = array(
		'date' => $day,
		'operations' => array(),
		'balance' => 0,
	    );
            $this->operations[] = $op;
	    $this->data[$day->format('Y-m-d')] = $op;
	}
    }
    
    private function defineCalendarLimits()
    {
        $this->dateStart = clone($this->date);
        $this->dateEnd = clone($this->date);

	$this->dateStart->modify('first day of this month');
	if ($this->dateStart->format('w') > 0) { // Not a Sunday
	    $this->dateStart->modify('last sunday');
	}

	$this->dateEnd->modify('last day of this month');
	if ($this->dateEnd->format('w') < 6) { // Not a Saturday
	    $this->dateEnd->modify('next sunday');
	}
    }
    
    private function defineCalendarNav()
    {
	$this->previousYear = clone($this->date);
	$this->previousYear->modify('previous year');
	$this->previousMonth = clone($this->date);
	$this->previousMonth->modify('previous month');

	$this->nextMonth = clone($this->date);
	$this->nextMonth->modify('next month');
	$this->nextYear = clone($this->date);
	$this->nextYear->modify('next year');
    }

    public function isToday()
    {
        return $this->date == new \DateTime('now');
    }
}