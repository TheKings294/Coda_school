<?php
function getUser(string $username, PDO $pdo):array | bool
{
    /**
     * @var PDO $pdo
     */
    $state = $pdo->prepare("SELECT `email`, `password`, `enabled` FROM users WHERE `email` = :username");
    $state->bindParam(':username', $username);
    $state->execute();
    return $state->fetch();
}