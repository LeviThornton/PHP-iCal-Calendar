<?php
require_once("Model_iCal.php");
	$events = array();
	$events[] = $iCalEvent = new IcalEvent();
	        $iCalEvent->setSummery("Christmas");
	        $iCalEvent->setUid("500012345");
	        $iCalEvent->setStatus("TENTATIVE");
	        $iCalEvent->setDtstart('20070311T100000');
	        //$iCalEvent->setDtend(''); // end time
	        $iCalEvent->setLocation("North Pole, AK");
	$events[] = $iCalEvent = new IcalEvent();
	        $iCalEvent->setSummery("New Years");
	        $iCalEvent->setUid("500012345");
	        $iCalEvent->setStatus("TENTATIVE");
	        $iCalEvent->setDtstart('20070311T100000');
	        //$iCalEvent->setDtend(''); // end time
	        $iCalEvent->setLocation("New York, NY");
	$ical = new Application_Model_Ical($events);
	$ical->printiCal("calendar_example");
?>