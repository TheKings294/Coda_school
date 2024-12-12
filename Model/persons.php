<?php

function getAllPersons(PDO $db)
{
    $query = "SELECT * FROM persons LIMIT 10";

    try {
        $state = $db->prepare($query);
        $state->execute();
        return $state->fetchAll();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}