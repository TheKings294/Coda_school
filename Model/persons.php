<?php

function getAllPersons(PDO $db,int $perPage, int $page = 1): array
{
    $curentid = 0;
    if($page !== 1) {
        $curentid = $page * $perPage;
    }

    $query = "SELECT * FROM persons LIMIT 10 OFFSET :idend";

    try {
        $state = $db->prepare($query);
        $state->bindParam(":idend", $curentid, PDO::PARAM_INT);
        $state->execute();
        return $state->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        return $e->getMessage();
    }
}