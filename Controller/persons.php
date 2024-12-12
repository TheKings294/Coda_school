<?php
/**
 * @var PDO $pdo
 */

require "./Model/persons.php";



if(!empty($_SERVER['CONTENT_TYPE']) &&
    ($_SERVER['CONTENT_TYPE'] === 'application/json' || str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded'))
) {
    $persons = getAllPersons($pdo);
    if(!is_array($persons)){
        $errors[] = $persons;
    }
    header('Content-type: application/json');
    echo json_encode($persons);
    exit();
}

require "./View/persons.php";