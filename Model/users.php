<?php
function getAll(PDO $pdo): array
{
    $state = $pdo->prepare("SELECT * FROM `users`");
    $state->execute();
    return $state->fetchAll();
}

function toogle_enabled(PDO $pdo, int $user_id): void
{
    $state = $pdo->prepare("UPDATE `users` SET `enabled` = NOT `enabled` WHERE `id` = :user_id");
    $state->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $state->execute();
}

function delete_user(PDO $pdo, int $user_id)
{
    try {
        $state = $pdo->prepare("DELETE FROM `users` WHERE `id` = :user_id");
        $state->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $state->execute();
    } catch (PDOException $e) {
        return $e->getMessage();
    }

}