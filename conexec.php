<?php
class Contest
{
    private $id;
    private $name;
    private $problems;
    private $startTime;
    private $endTime;
    private $duration;

    public function __construct($name, $problems, $startTime, $endTime, $duration)
    {
        $this->name = $name;
        $this->problems = $problems;
        $this->startTime = $startTime;
        $this->endTime = $endTime;
        $this->duration = $duration;
    }

    // Add getters and setters for the private properties if needed

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getProblems()
    {
        return $this->problems;
    }

    public function getStartTime()
    {
        return $this->startTime;
    }

    public function getEndTime()
    {
        return $this->endTime;
    }

    public function getDuration()
    {
        return $this->duration;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    // You can add more methods here as needed

    // To convert the Contest object to JSON for API responses
    public function toJSON()
    {
        return json_encode([
            'id' => $this->id,
            'name' => $this->name,
            'problems' => $this->problems,
            'startTime' => $this->startTime,
            'endTime' => $this->endTime,
            'duration' => $this->duration,
        ]);
    }
}
?>