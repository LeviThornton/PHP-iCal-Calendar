iCal-Calendar
=============

iCal Calendar Feed Model

This iCal model will help you output a feed in a icaldev uri format or an .icl file. Simple call the class and fill in the required fields for each event:

$events = array();
$events[] = $iCalEvent = new IcalEvent();
  $iCalEvent->setSummery("Party at Timmy house"); // Required
  $iCalEvent->setUid("111"); // Required
  $iCalEvent->setStatus("CONFIRMED); // Required - CONFIRMED
  $iCalEvent->setDtstart("1978-01-01 5:00:00"); // Required
  $iCalEvent->setDtend("1980-01-01 6:00:00"); // Optional
  $iCalEvent->setLocation("123 Some address or geo location");
$events[] = $iCalEvent = new IcalEvent();
  $iCalEvent->setSummery("Dinner with friends");
  $iCalEvent->setUid("111");
  $iCalEvent->setStatus("CONFIRMED");
  $iCalEvent->setDtstart("2013-18-01 17:00:00");
  /// $iCalEvent->setDtend();
  $iCalEvent->setLocation("123 Some address or geo location");
Application_Model_Ical:printiCal($events);



Thats it, enjoy!
