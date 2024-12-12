<?php
/**
 * @var PDO $pdo
 */

require "./Model/persons.php";

$persons = getAllPersons($pdo);

if(!is_array($persons)){
    $errors[] = $persons;
}

require "./View/persons.php";