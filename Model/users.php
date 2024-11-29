<?php
function getAll(PDO $pdo, $search = null): array | string
{
    $query = "SELECT * FROM users";
    if($search !== null) {
        $query .= " WHERE username LIKE :search OR id LIKE :search OR email LIKE :search";
    }
    try {
        $state = $pdo->prepare($query);
        if($search !== null) {
            $state->bindValue(":search", "%$search%");
        }
        $state->execute();
        return $state->fetchAll();
    } catch (PDOException $e) {
        return $e->getMessage();
    }

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