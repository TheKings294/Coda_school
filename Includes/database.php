<?php
try {
    $pdo = new PDO('mysql:host=localhost;dbname=coda_school_new', 'root', 'root');
} catch (Exception $e) {
    $error[] = "BDD conect error : {$e->getMessage()}";
}
