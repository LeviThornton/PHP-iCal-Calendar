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
	$ical->printiCal();
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
	const BEGIN_EVENT = "BEGIN:VEVENT";
	const END_EVENT = "END:VEVENT";

	protected  $events;
	protected  $method;
	protected  $version;
	protected  $prodid;

	/**
	 *
	 * @param Array $events
	 */
	public function __construct($events) {
		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: inline; filename=calendar.ics');

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
	public function printiCal() {
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
	private function prepOutput($objects) {
		if(is_array($objects)) {
			foreach($objects as $object) {
				$events[]	= self::BEGIN_EVENT;
				$events[]	= "SUMMARY:".	$object->getSummery();
				$events[]	= "UID:".		$object->getUid();
				$events[]	= "STATUS:". 	$object->getStatus();
				$events[]	= "DTSTART:".	date(DATE_ICAL, strtotime($object->getDtstart()));
				$events[]	= "DTEND:".		date(DATE_ICAL, strtotime($object->getDtend()));
				$events[]	= "LOCATION:".	$object->getLocation();
				$events[] 	= self::END_EVENT;
			}
		} elseif(is_object($objects)) {
			$object = $objects;
			$events[]	= self::BEGIN_EVENT;
			$events[]	= "SUMMARY:".	$object->getSummery();
			$events[]	= "UID:".		$object->getUid();
			$events[]	= "STATUS:". 	$object->getStatus();
			$events[]	= "DTSTART:".	date(DATE_ICAL, strtotime($object->getDtstart()));
			$events[]	= "DTEND:".		date(DATE_ICAL, strtotime($object->getDtend()));
			$events[]	= "LOCATION:".	$object->getLocation();
			$events[] 	= self::END_EVENT;
		} else {
			//end-stub do nothing
			$events = array();
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
