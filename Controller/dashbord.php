<?php
/**
* @var PDO $pdo
 */
require "Model/dashbord.php";

$users = get_users($pdo);

require "View/dashbord.php";