<?php
function getAll(PDO $pdo, $search = null, string | null $sortby = null): array | string
{
    $query = "SELECT * FROM users";
    if($search !== null) {
        $query .= " WHERE username LIKE :search OR id LIKE :search OR email LIKE :search";
    }
    if($sortby !== null) {
        $query .= " ORDER BY $sortby";
    }
    $query .= " LIMIT 10";
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

function toogle_enabled(PDO $pdo, int $user_id): string | bool
{
    try {
        $state = $pdo->prepare("UPDATE `users` SET `enabled` = NOT `enabled` WHERE `id` = :user_id");
        $state->bindParam(':user_id', $user_id, PDO::PARAM_INT);
        $state->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }

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

function getUnlikedUsers(PDO $pdo): array | string
{
    try {
        $stmt = $pdo->prepare("SELECT `users`.id, `users`.username, up.person_id, up.user_id FROM `users`
                                     LEFT JOIN `user_person` AS up ON up.`user_id` = `users`.`id`
                                      ORDER BY `users`.`username`");
        $stmt->execute();
        return $stmt->fetchAll();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}