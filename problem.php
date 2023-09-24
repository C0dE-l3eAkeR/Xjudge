<?php
class Problem
{
    private $id;
    private $title;
    private $timeLimit;
    private $memoryLimit;
    private $statement;
    private $inputStatement;
    private $outputStatement;
    private $sampleInputList;
    private $sampleOutputList;


    public function __construct($title, $timeLimit, $statement, $inputStatement, $outputStatement, $sampleInputList, $sampleOutputList, $memoryLimit)
    {
        $this->title = $title;
        $this->timeLimit = $timeLimit;
        $this->memoryLimit = $memoryLimit;
        $this->statement = $statement;
        $this->inputStatement = $inputStatement;
        $this->outputStatement = $outputStatement;
        $this->sampleInputList = $sampleInputList;
        $this->sampleOutputList = $sampleOutputList

    }

    // Add getters and setters for the private properties if needed

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getTimeLimit()
    {
        return $this->timeLimit;
    }

    public function getStatement()
    {
        return $this->statement;
    }

    public function getInputStatement()
    {
        return $this->inputStatement;
    }

    public function getOutputStatement()
    {
        return $this->outputStatement;
    }

    public function getSampleInputList()
    {
        return $this->sampleInputList;
    }

    public function setId($id)
    {
        $this->id = $id;
    }


    // You can add more methods here as needed

    // To convert the Problem object to JSON for API responses
    public function toJSON()
    {
        return json_encode([
            'id' => $this->id,
            'title' => $this->title,
            'timeLimit' => $this->timeLimit,
            'memoryLimit' => $this->memoryLimit
            'statement' => $this->statement,
            'inputStatement' => $this->inputStatement,
            'outputStatement' => $this->outputStatement,
            'sampleInputList' => $this->sampleInputList,
           'sampleOutputList' => $this->sampleOutputList	
            
        ]);
    }
}
?>
