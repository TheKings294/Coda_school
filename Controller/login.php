<?php
/**
 * @var PDO $pdo
 */
require "Model/login.php";

if(isset($_POST["login_button"])){
    $username = !empty($_POST['username']) ? $_POST['username'] : null;
    $password = !empty($_POST['password']) ? $_POST['password'] : null;

    if($username !== null && $password !== null && filter_var($username, FILTER_VALIDATE_EMAIL)){
        $username = cleanCodeString($username);
        $password = cleanCodeString($password);

        $user = getUser($username, $pdo);

        $isMatchPassword = is_array($user) && password_verify($password, $user['password']); //ou en version classique avec un if

        if($isMatchPassword && $user['enabled']){
            $_SESSION['auth'] = true;
            header("Location: index.php");
        } elseif (!$user['enabled'] && $isMatchPassword){
            $errors[] = "Votre compte est desactivé";
        } else {
            $errors[] = "Authentification invalide";
        }
    }
}

require "View/login.php";