<?php
/**
* @var PDO $pdo
 */
require './Model/Person.php';
require './Model/users.php';

$unLikedUsers = getUnlikedUsers($pdo);

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

if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
) {
    switch($_GET['action']) {
        case 'new':
            $last_name = isset($_POST['last_name']) ? cleanCodeString($_POST['last_name']) : null;
            $first_name = isset($_POST['first_name']) ? cleanCodeString($_POST['first_name']) : null;
            $address = isset($_POST['address']) ? cleanCodeString($_POST['address']) : null;
            $city = isset($_POST['city']) ? cleanCodeString($_POST['city']) : null;
            $zip_code = isset($_POST['zip_code']) ? cleanCodeString($_POST['zip_code']) : null;
            $phone = isset($_POST['phone']) ? cleanCodeString($_POST['phone']) : null;
            $type = isset($_POST['type']) ? intval(cleanCodeString($_POST['type'])) : null;
            $user_link = isset($_POST['user-link']) ? cleanCodeString($_POST['user-link']) : null;

            if(($last_name && $first_name && $address && $city && $zip_code && $phone && $type) !== null) {
                $res = setPerson($pdo, $last_name, $first_name, $address, $city, $zip_code, $phone, $type);
                if(!is_numeric($res)) {
                    header('Content-type: application/json');
                    echo json_encode(['success' => false, 'error' => $res]);
                    exit();
                }
                $res = intval($res);
                $user_link = intval($user_link);

                if (isCheckPersonUserLinked($pdo, $user_link)) {
                    header('Content-type: application/json');
                    echo json_encode(['success' => false, 'error' => 'Utilisateur deja utiliser']);
                    exit();
                }

                $link = setUserPersonLinked($pdo, $res, $user_link);

                if(is_bool($link)) {
                    header('Content-type: application/json');
                    echo json_encode(['success' => true]);
                    exit();
                } else {
                    header('Content-type: application/json');
                    echo json_encode(['success' => false, 'error' => $link]);
                    exit();
                }
            }

            break;
        case 'edit':
            $last_name = isset($_POST['last_name']) ? cleanCodeString($_POST['last_name']) : null;
            $first_name = isset($_POST['first_name']) ? cleanCodeString($_POST['first_name']) : null;
            $address = isset($_POST['address']) ? cleanCodeString($_POST['address']) : null;
            $city = isset($_POST['city']) ? cleanCodeString($_POST['city']) : null;
            $zip_code = isset($_POST['zip_code']) ? cleanCodeString($_POST['zip_code']) : null;
            $phone = isset($_POST['phone']) ? cleanCodeString($_POST['phone']) : null;
            $type = isset($_POST['type']) ? intval(cleanCodeString($_POST['type'])) : null;
            $id = isset($_GET['id']) ? intval(cleanCodeString($_GET['id'])) : null;
            $user_link = isset($_POST['user-link']) ? intval(cleanCodeString($_POST['user-link'])) : null;

            if(($last_name && $first_name && $address && $city && $zip_code && $phone && $type) !== null) {
                $res = updatePerson($pdo, $last_name, $first_name, $address, $city, $zip_code, $phone, $type, $id);
                if(is_string($res)) {
                    header('Content-type: application/json');
                    echo json_encode(['success' => false, 'error' => $res]);
                    exit();
                }

                if($user_link !== null) {
                    if(isCheckPersonUserLinked($pdo, $user_link)) {
                        header('Content-type: application/json');
                        echo json_encode(['success' => false, 'error' => 'Utilisateur deja utiliser']);
                        exit();
                    }

                    $link = setUserPersonLinked($pdo, $id, $user_link);

                    if(is_bool($link)) {
                        header('Content-type: application/json');
                        echo json_encode(['success' => true]);
                        exit();
                    } else {
                        header('Content-type: application/json');
                        echo json_encode(['success' => false, 'error' => $link]);
                        exit();
                    }
                }

                if($res === true) {
                    header('Content-type: application/json');
                    echo json_encode(['success' => true]);
                    exit();
                }
            }
            break;
    }
}

require './View/Person.php';