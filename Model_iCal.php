<?php
/**
 * iCal Calendar Feed Model
 *
 * @author Levi Thornton
 *
 * <code>
 * <?php
 * $events = array();
 *	$events[] = $iCalEvent = new IcalEvent();
 *		$iCalEvent->setSummery($summery);
 *		$iCalEvent->setUid($uid);
 *		$iCalEvent->setStatus($status);
 *		$iCalEvent->setDtstart($dtstart);
 *		$iCalEvent->setDtend($dtend);
 *		$iCalEvent->setLocation($location);
 *	$events[] = $iCalEvent = new IcalEvent();
 *		$iCalEvent->setSummery($summery);
 *		$iCalEvent->setUid($uid);
 *		$iCalEvent->setStatus($status);
 *		$iCalEvent->setDtstart($dtstart);
 *		$iCalEvent->setDtend($dtend);
 *		$iCalEvent->setLocation($location);
 *	Application_Model_Ical:printiCal($events);
 *  ?>
 * </code>
 * /

/**
 *	Our model for processing Event Objects.
 * @author Levi Thornton
 *
 */
class Application_Model_Ical
{
	protected $method;
	protected $version;
	protected $prodid;

	public function __construct() {
		header('Content-type: text/calendar; charset=utf-8');
		header('Content-Disposition: inline; filename=calendar.ics');

		define('DATE_ICAL', 'Ymd\THis\Z');

		$this->method 	= "PUBLISH";
		$this->version 	= "2.0";
		$this->prodid 	= "-//project_name//company_name//EN";
	}
	public function printiCal($objects) {
		print "BEGIN:VCALENDAR"				."\r\n";
		print "METHOD:".	$this->method	."\r\n";
		print "VERSION".	$this->version	."\r\n";
		print "PRODID".		$this->prodid	."\r\n";
		foreach(prepOutput($objects) as $item) print $item	."\r\n";
		print "END:VCALENDAR";

	}
	private function prepOutput($objects) {
		if(is_array($objects)) {
			foreach($objects as $object) {
				$events[]	= "BEGIN:VEVENT";
				$events[]	= $object->getSummery();
				$events[]	= $object->getUid();
				$events[]	= $object->getStatus();
				$events[]	= date(DATE_ICAL, strtotime($object->getDtstart()));
				$events[]	= date(DATE_ICAL, strtotime($object->getDtend()));
				$events[]	= $object->getLocation();
				$events[] 	= "END:VEVENT";
			}
		} elseif(is_object($objects)) {
			$object = $objects;
			$events[]	= "BEGIN:VEVENT";
			$events[]	= $object->getSummery();
			$events[]	= $object->getUid();
			$events[]	= $object->getStatus();
			$events[]	= date(DATE_ICAL, strtotime($object->getDtstart()));
			$events[]	= date(DATE_ICAL, strtotime($object->getDtend()));
			$events[]	= $object->getLocation();
			$events[] 	= "END:VEVENT";
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
