<?php
include_once 'entity/Person.php';
include_once 'entity/Student.php';

$person = new Person("John", "Doe");
echo 'First name: ' . $person->getFirstName() . '<br />';
echo 'Last name: ' . $person->getlastName() . '<br />';

echo '<br />';

$student = new Student("John", "Doe","202072001");
echo 'Student ID: ' . $student->getStudentId() . '<br />';
echo 'First name: ' . $student->getFirstName() . '<br />';
echo 'Last name: ' . $student->getLastName() . '<br />';