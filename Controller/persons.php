<?php
/**
 * @var PDO $pdo
 */

require "./Model/persons.php";
const LIST_PERSONS_ITEM_PER_PAGE = 10;

if(!empty($_SERVER['CONTENT_TYPE']) &&
    ($_SERVER['CONTENT_TYPE'] === 'application/json' ||
        str_starts_with($_SERVER['CONTENT_TYPE'], 'application/x-www-form-urlencoded'))
) {
    $page = cleanCodeString($_GET['page']) ?? 1;
    $persons = getAllPersons($pdo, $page, LIST_PERSONS_ITEM_PER_PAGE);
    if(!is_array($persons)){
        $errors[] = $persons;
    }
    header('Content-type: application/json');
    echo json_encode($persons);
    exit();
}

require "./View/persons.php";