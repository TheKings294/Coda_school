<?php
function getPerson(PDO $pdo, int $id): array | string
{
    try {
        $stmt = $pdo->prepare('SELECT * FROM persons WHERE id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}