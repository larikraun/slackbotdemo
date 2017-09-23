<?php

/**
 * This file is part of the slack-client project
 * By: omolara
 * Date: 9/21/17
 * Time: 10:12 PM
 */
namespace SlackBotDemo;
class AppLogic
{
    private $mysqli;

    function __construct()
    {
        include_once "db_config.php";
        $this->mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    }

    function nextEvent()
    {
        $res = mysqli_query($this->mysqli, "Select * from events WHERE event_date > NOW() ORDER BY event_date ASC LIMIT 1 ");
        $row = mysqli_fetch_assoc($res);
        $event = new Event($row["id"], $row["event_name"], $row["event_date"], $row["speakers"]);
        return $event;
    }

    function upComingEvents()
    {
        $events = array();
        $res = mysqli_query($this->mysqli, "Select * from events WHERE event_date > NOW() ORDER BY event_date ASC ");
        while ($row = mysqli_fetch_assoc($res)) {
            $event = new Event($row["id"], $row["event_name"], $row["event_date"], $row["speakers"]);
            $events[] = $event;
        }

        return $events;
    }

    function allEvents()
    {
        $events = array();
        $res = mysqli_query($this->mysqli, "Select * from events ORDER BY event_date ASC ");
        while ($row = mysqli_fetch_assoc($res)) {
            $event = new Event($row["id"], $row["event_name"], $row["event_date"], $row["speakers"]);
            $events[] = $event;
        }

        return $events;
    }
}