<?php
/**
* @var PDO $pdo
 */
require './Model/Person.php';

if(isset($_GET['action']) &&
    $_GET['action'] == 'edit' &&
    isset($_GET['id']) && is_numeric($_GET['id']))
{
    $id = cleanCodeString($_GET['id']);
    $res = getPerson($pdo, $id);
    if(!is_array($res)) {
        $errors[] = $res;
    }
}

require './View/Person.php';