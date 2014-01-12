<?php
/**
 * iCal Calendar Feed Model
 *
 * @author Levi Thornton
 *
 * <code>
    <?php
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
	$ical->printiCal("calendar_example"); // leave input blank to output to screen
   ?>
 * </code>
 * /

/**
 *	Our model for processing Event Objects.
 * @author Levi Thornton
 *
 */
class Application_Model_Ical
{
	const BEGIN_EVENT 	= "BEGIN:VEVENT";
	const END_EVENT 	= "END:VEVENT";
	/*
	 * event object field output declarations
	 */
	const SUMMARY		= "SUMMARY: ";
	const UID 			= "UID: ";
	const STATUS 		= "STATUS: ";
	const DTSTART 		= "DTSTART: ";
	const DTEND			= "DTEND: ";
	const LOCATION		= "LOCATION: ";

	protected  $events;
	protected  $method;
	protected  $version;
	protected  $prodid;

	/**
	 *
	 * @param Array $events
	 */
	public function __construct($events) {
		define('DATE_ICAL', 'Ymd\THis\Z');
		$this->events = $events;
		$this->method 	= "PUBLISH";
		$this->version 	= "2.0";
		$this->prodid 	= "-//project_name//company_name//EN";
		$this->events;
	}
	/**
	 *
	 */
	public function printiCal($fileName=false) {
		if($fileName) {
			header('Content-type: text/calendar; charset=utf-8');
			header('Content-Disposition: inline; filename='.$fileName.'.ics');
		}
		print "BEGIN:VCALENDAR"				."\r\n";
		print "METHOD:".	$this->method	."\r\n";
		print "VERSION:".	$this->version	."\r\n";
		print "PRODID:".		$this->prodid	."\r\n";
		foreach($this->prepOutput($this->events) as $item) print $item	."\r\n";
		print "END:VCALENDAR";

	}
	/**
	 *
	 * @param Array $objects
	 */
	private function prepOutput($arrayItems) {
		if(is_array($arrayItems)) {
			foreach($arrayItems as $item) {
				$events[]	= self::BEGIN_EVENT;
				$events[]	= self::SUMMARY		.	$item->getSummery();
				$events[]	= self::UID			.	$item->getUid();
				$events[]	= self::STATUS		.	$item->getStatus();
				$events[]	= self::DTSTART		.	date(DATE_ICAL, strtotime($item->getDtstart()));
				$events[]	= self::DTEND		.	date(DATE_ICAL, strtotime($item->getDtend()));
				$events[]	= self::LOCATION	.	$item->getLocation();
				$events[] 	= self::END_EVENT;
			}
		} else {
			//end-stub do nothing
			$events = false;
		}
		return $events;
	}
}
/**
 * The Event Object for iCal
 * @author Levi Thornton
 *
 */
class IcalEvent {
	protected $summery;
	protected $uid;
	protected $status;
	protected $dtstart;
	protected $dtend;
	protected $location;


	public function getSummery()
	{
	    return $this->summery;
	}

	public function setSummery($summery)
	{
	    $this->summery = $summery;
	}

	public function getUid()
	{
	    return $this->uid;
	}

	public function setUid($uid)
	{
	    $this->uid = $uid;
	}

	public function getStatus()
	{
	    return $this->status;
	}

	public function setStatus($status)
	{
	    $this->status = $status;
	}

	public function getDtstart()
	{
	    return $this->dtstart;
	}

	public function setDtstart($dtstart)
	{
	    $this->dtstart = $dtstart;
	}

	public function getDtend()
	{
	    return $this->dtend;
	}

	public function setDtend($dtend)
	{
	    $this->dtend = $dtend;
	}

	public function getLocation()
	{
	    return $this->location;
	}

	public function setLocation($location)
	{
	    $this->location = $location;
	}
}
