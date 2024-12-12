<?php
/**
 * @var PDO $pdo
 */

require "Model/users.php";

if(
    isset($_GET['action']) &&
    $_GET['action'] === 'toogle_enabled' &&
    isset($_GET['id']) &&
    is_numeric($_GET['id'])
) {
    $id = cleanCodeString($_GET['id']);
    toogle_enabled($pdo, $id);
    header("Location: index.php?component=users");
}

if(
    isset($_GET['action']) &&
    $_GET['action'] === 'delete' &&
    isset($_GET['id']) &&
    is_numeric($_GET['id']))
{
    $id = cleanCodeString($_GET['id']);
    $deleted = delete_user($pdo, $id);
    if(!empty($deleted)) {
        $errors[] = $deleted;
    } else {
        header("Location: index.php?component=users");
    }

}

$search = isset($_POST['search']) ? cleanCodeString($_POST['search']) : null;
$sortby = isset($_GET['sortby']) ? cleanCodeString($_GET['sortby']) : null;
//$sens = isset($_GET['sens']) ? cleanCodeString($_GET['sens']) : null;
//$sens = $sens === 'asc' ? 'desc' : 'asc';
$users = getAll($pdo, $search, $sortby);
if(!is_array($users)) {
    $errors[] = $users;
}

require "View/users.php";

