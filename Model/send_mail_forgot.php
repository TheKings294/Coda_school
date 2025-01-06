<?php
function verif_acount($pdo,$mail){
    try {
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = :mail");
        $stmt->bindParam(':mail',$mail,PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetch();
    } catch (Exception $e) {
        return false;
    }
}