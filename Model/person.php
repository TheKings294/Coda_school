<?php
function getPerson(PDO $pdo, int $id): array | string
{
    try {
        $stmt = $pdo->prepare('SELECT `persons`.*, `user_person`.`user_id` FROM persons 
                                    LEFT JOIN `user_person` ON `user_person`.`person_id` = `persons`.`id`
                                    WHERE `persons`.id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function setPerson(
    PDO $pdo,
    string $last_name,
    string $first_name,
    string $address,
    string $city,
    string $zip_code,
    string $phone,
    int $type
): string
{
    try {
        $stmt = $pdo->prepare('INSERT INTO `persons`(`last_name`, `first_name`, `address`, `zip_code`, `city`, `phone`, `type`) 
        VALUES (:last_name, :first_name, :address, :zip_code, :city, :phone, :type)');
        $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':zip_code', $zip_code, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->execute();
        return $pdo->lastInsertId();
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function updatePerson(
    PDO $pdo,
    string $last_name,
    string $first_name,
    string $address,
    string $city,
    string $zip_code,
    string $phone,
    int $type,
    int $id): bool | string
{
    try {
        $stmt = $pdo->prepare("
UPDATE `persons` SET last_name = :last_name, first_name = :first_name, address = :address, city = :city, zip_code = :zip_code, phone = :phone, type = :type 
                 WHERE id = :id");
        $stmt->bindValue(':last_name', $last_name, PDO::PARAM_STR);
        $stmt->bindValue(':first_name', $first_name, PDO::PARAM_STR);
        $stmt->bindValue(':address', $address, PDO::PARAM_STR);
        $stmt->bindValue(':city', $city, PDO::PARAM_STR);
        $stmt->bindValue(':zip_code', $zip_code, PDO::PARAM_STR);
        $stmt->bindValue(':phone', $phone, PDO::PARAM_STR);
        $stmt->bindValue(':type', $type, PDO::PARAM_INT);
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function isCheckPersonUserLinked(PDO $pdo, int $id): bool | string
{
    try {
        $stmt = $pdo->prepare('SELECT COUNT(*) FROM user_person WHERE user_id = :id');
        $stmt->bindValue(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetchAll();
        return $result[0]['COUNT(*)'] > 0 ;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}

function setUserPersonLinked(PDO $pdo, int $person_id, int  $user_id): bool | string
{
    try {
        $stmt = $pdo->prepare('INSERT INTO `user_person` (user_id, person_id) VALUES (:user_id, :person_id)');
        $stmt->bindValue(':person_id', $person_id, PDO::PARAM_INT);
        $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
        $stmt->execute();
        return true;
    } catch (Exception $e) {
        return $e->getMessage();
    }
}