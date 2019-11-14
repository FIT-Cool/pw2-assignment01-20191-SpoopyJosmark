<?php


class Student extends Person
{
    private $studentId;

    /**
     * Student constructor.
     * @param $studentId
     */
    public function __construct($firstName, $lastName, $studentId)
    {
        parent::__construct($firstName, $lastName);
        $this->studentId = $studentId;
    }

    /**
     * @return mixed
     */
    public function getStudentId()
    {
        return $this->studentId;
    }

    /**
     * @param mixed $studentId
     */
    public function setStudentId($studentId)
    {
        $this->studentId = $studentId;
    }
}