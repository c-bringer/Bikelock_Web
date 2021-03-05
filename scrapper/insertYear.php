<?php
//Including database and making object
require 'api/config/Database.php';

$database = new Database();
$db = $database->getConnection();

try {
    $yearStart = 1980;

    for($i = $yearStart; $i < 2022; $i++) {
        $insertQuery = "INSERT INTO `year_motorcycles`(`year`) VALUES(:year)";
        $insertStmt = $db->prepare($insertQuery);

        //Data binding
        $insertStmt->bindValue(':year', $i, PDO::PARAM_INT);

        $insertStmt->execute();
    }
} catch(PDOException $e) {
    echo $e;
}