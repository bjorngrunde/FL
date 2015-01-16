<?php

/**
 * @param $attribute
 * @param $errors
 * @return mixed
 */
function errors_for($attribute, $errors)
{
  return  $errors->first($attribute, '<span class="text-danger">:message</span>');
}

function generateCalendar($events)
{
    $cal = Calendar::make();

    $cal->setDate(Input::get('cdate')); //Set starting date
    $cal->setBasePath('/flrs'); // Base path for navigation URLs
    $cal->showNav(true); // Show or hide navigation
    $cal->setView('month'); //'day' or 'week' or null
    $cal->setStartEndHours(0,24); // Set the hour range for day and week view
    $cal->setTimeClass('ctime'); //Class Name for times column on day and week views
    $cal->setEventsWrap(array('<small>', '</small> <br />')); // Set the event's content wrapper
    $cal->setDayWrap(array('<div>','</div>')); //Set the day's number wrapper
    $cal->setNextIcon('>>'); //Can also be html: <i class='fa fa-chevron-right'></i>
    $cal->setPrevIcon('<<'); // Same as above
    $cal->setDayLabels(array('Sön', 'Mån', 'Tis', 'Ons', 'Tor', 'Fre', 'Lör')); //Label names for week days
    $cal->setMonthLabels(array('Januari', 'Februari', 'Mars', 'April', 'Maj', 'Juni', 'Juli', 'Augusti', 'September', 'Oktober', 'November', 'December')); //Month names
    $cal->setDateWrap(array('<div>','</div>')); //Set cell inner content wrapper
    $cal->setTableClass('table'); //Set the table's class name
    $cal->setHeadClass('table-header'); //Set top header's class name
    $cal->setNextClass('btn btn-primary btn-sm'); // Set next btn class name
    $cal->setPrevClass('btn btn-primary btn-sm'); // Set Prev btn class name
    $cal->setEvents($events); // Receives the events array

    return $cal;
}