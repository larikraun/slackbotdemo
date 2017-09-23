<?php

/**
 * This file is part of the slack-client project
 * By: omolara
 * Date: 9/21/17
 * Time: 10:11 PM
 */
namespace SlackBotDemo;
class Event
{
    private $id;
    private $name;
    private $date;
    private $speakers;

    /**
     * Event constructor.
     * @param $id
     * @param $name
     * @param $date
     * @param $speakers
     */
    public function __construct($id, $name, $date, $speakers)
    {
        $this->id = $id;
        $this->name = $name;
        $this->date = $date;
        $this->speakers = $speakers;
    }

    function __toString()
    {
        return $this->getName()." happening ".$this->getDate();
    }

    function jsonfy()
    {
        $event = array();
        $event["id"] = $this->getId();
        $event["event_name"] = $this->getName();
        $event["event_date"] = $this->getDate();
        $event["speakers"] = $this->getSpeakers();

        return json_encode($event);
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getSpeakers()
    {
        return $this->speakers;
    }

    /**
     * @param mixed $speakers
     */
    public function setSpeakers($speakers)
    {
        $this->speakers = $speakers;
    }


}