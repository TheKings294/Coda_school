<?php
/**
* @var PDO $pdo
 */
require './vendor/autoload.php';
//require './Includes/database.php';

try {
    $pdo = new PDO('mysql:host=localhost;dbname=coda_school_new', 'root', 'root');
} catch (Exception $e) {
    echo "BDD conect error : {$e->getMessage()}";
}

$faker = Faker\Factory::create('fr_FR');

for ($i = 0; $i <= 100; $i++) {
    try {
        $stmt = $pdo->prepare('INSERT INTO `persons`(`last_name`, `first_name`, `address`, `zip_code`, `city`, `phone`, `type`) 
        VALUES (:last_name, :first_name, :address, :zip_code, :city, :phone, :type)');
        $stmt->bindValue(':last_name', $faker->lastName());
        $stmt->bindValue(':first_name', $faker->firstName());
        $stmt->bindValue(':address', $faker->address());
        $stmt->bindValue(':zip_code', $faker->postcode());
        $stmt->bindValue(':city', $faker->city());
        $stmt->bindValue(':phone', $faker->phoneNumber());
        $stmt->bindValue(':type', $faker->numberBetween(1, 2), PDO::PARAM_INT);
        $stmt->execute();
    } catch (Exception $e) {
        echo $e->getMessage();
    }
}