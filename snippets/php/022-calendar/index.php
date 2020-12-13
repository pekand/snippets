<?php

class El
{
    public $left = '';
    public $inner = '';
    public $childs=[];
    public $outer = '';
    public $right = '';

    function __construct($left = '', $right = '', $childs = [])
    {
        $this->left = $left;
        $this->childs = $childs;
        $this->right = $right;
    }

    function addInner($inner){
        $this->inner .= $inner;
        return $this;
    }

    function content($content){
        $this->inner = $content;
        return $this;
    }

    function addOuter($outre){
        $this->outre .= $outre;
        return $this;
    }

    function addChild($left = '', $right = '', $childs = []){
        $child = new El($left, $right, $childs);
        $this->childs[] = $child;
        return $child;
    }

    function get(){

        $inner = "";

        foreach ($this->childs as $child) {
            $inner .= $child->get();
        }

        return $this->left.$this->inner.$inner.$this->outer.$this->right;
    }
}

class Claendar
{

    public $days = [
        "Mon",
        "Tue",
        "Wen",
        "Thu",
        "Fri",
        "Sat",
        "Sun",
    ];

    public $months = [
        "January",
        "February",
        "March",
        "April",
        "May",
        "June",
        "July",
        "August",
        "September",
        "October",
        "November",
        "December", 
    ];
    
    function __construct($fromDate, $toDate)
    {
        $this->fromDate = $fromDate;
        $this->toDate = $toDate;
    }

    function renderStyle()
    {
        $out = "<style>

.calendar {}

.calendar .header {text-align:center; font-size:32px;}

.calendar .clear{clear:both;}

.calendar .year{text-align:center;}

.calendar .month{height:450px;float:left;padding:5px; margin:5px;}

.calendar .month-name{text-align:center;}


.calendar .week{position:relative;padding:5px; margin:5px;}
.calendar .week-number{position:absolute; left:-7px; top:17px;font-size:12px;}

.calendar .day-names{padding:5px; margin:5px;}

.calendar .day-name{text-align:center;float:left;padding:5px; margin:5px; width:25px; background:#bfc2ff;}

.calendar .day-space{float:left; padding:5px; margin:5px; width:25px;}
.calendar .day{float:left;padding:5px; margin:5px;background:#deebff; width:25px; text-align:center;}

.calendar .day-current{background:red;}

</style>";

        return $out;
    }

    function render()
    {
        $out = "";

        $begin = new DateTime($this->fromDate);
        $end = new DateTime($this->toDate);

        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$end);

        $monthNumber = $begin->format("n");
        $weekNumber = $begin->format("W");

        $calendar = new El("<div class='calendar'>", "</div>");
        $calendar->addChild("<div class='header'>", "</div>")->content($this->fromDate.' to '.$this->toDate);
        $months = $calendar->addChild("<div class='months'>", "</div>");
        
        $month = $months->addChild("<div class='month month-$monthNumber'>", "</div>");

        $month->addChild("<div class='month-name'>", "</div>")->content($begin->format("m") ." - ". $this->months[0]);

        $dayNames = $month->addChild("<div class='day-names'>", "</div>");
        for($d = 0; $d<7; $d++) {
             $dayNames->addChild("<div class='day-name'>", "</div>")->content($this->days[$d]);
        }
        $dayNames->addChild("<div class='clear'>", "</div>");

        $week = $month->addChild("<div class='week week-$weekNumber'>", "</div>");
        $week->addChild("<div class='week-number'>", "</div>")->content($weekNumber);

        for($i = 0; $i < ($begin->format("N") - 1); $i++){
            $week->addChild("<div class='day-space'>", "</div>");
        }

        foreach($daterange as $date){

            if($monthNumber != $date->format("n")) { // new month
                $monthNumber = $date->format("n");
                $weekNumber = $date->format("W");

                $month = $months->addChild("<div class='month month-$monthNumber'>", "</div>");

                $month->addChild("<div class='month-name'>", "</div>")->content($date->format("m") ." - ". $this->months[$date->format("n")-1]);

                $dayNames = $month->addChild("<div class='day-names'>", "</div>");
                for($d = 0; $d<7; $d++) {
                     $dayNames->addChild("<div class='day-name'>", "</div>")->content($this->days[$d]);
                }
                $dayNames->addChild("<div class='clear'>", "</div>");

                $week = $month->addChild("<div class='week week-$weekNumber'>", "</div>");
                $week->addChild("<div class='week-number'>", "</div>")->content($weekNumber);

                for($i = 0; $i < ($date->format("N") - 1); $i++){
                    $week->addChild("<div class='day-space'>", "</div>");
                }
            }

            if ($date->format("W") != $weekNumber) { // new week
                $weekNumber = $date->format("W");

                $week->addChild("<div class='clear'>", "</div>");
                $week = $month->addChild("<div class='week week-$weekNumber'>", "</div>");
                $week->addChild("<div class='week-number'>", "</div>")->content($weekNumber);
            }

            $currentDay = 'day-current';
            if(date("Y-m-d") !== $date->format("Y-m-d")){
                $currentDay = '';
            }

            $week->addChild("<div class='day $currentDay'>", "</div>")->content($date->format("d"));
        }

        $week->addChild("<div class='clear'>", "</div>");
        $months->addChild("<div class='clear'>", "</div>");
        return $calendar->get();
    }
}

$c = new Claendar("2021-01-01", "2022-01-01");
echo $c->renderStyle();
echo $c->render();


