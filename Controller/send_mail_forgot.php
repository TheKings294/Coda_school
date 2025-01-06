<?php
/**
 * @var PDO $pdo
*/
require './Model/send_mail_forgot.php';

if(!empty($_SERVER['HTTP_X_REQUESTED_WIDTH']) &&
    $_SERVER['HTTP_X_REQUESTED_WIDTH'] === 'XMLHttpRequest'
)
{
    if(isset($_GET['component'])) {
        $mail = !empty($_POST['username']) ? cleanCodeString($_POST['username']) : null;
        $result = verif_acount($pdo, $mail);
        if(is_array($result)) {
            $url = prepare_url('index.php?components=forgot_login', $result['id']);
            header('Content-type: application/json');
            echo json_encode(['success' => true]);
        } else {
            header('Content-type: application/json');
            echo json_encode(['success' => false, 'error' => 'Cet utilisateur n\'existe pas']);
        }
        exit();
    }
}
require './View/send_mail_forgot.php';