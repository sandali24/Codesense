<?php
// Include the DbConnect.php file to establish a database connection
require 'DbConnect.php';

if (isset($_POST['lotId'])) {
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT sale_val FROM re_prjaclotdata WHERE lot_number = :lotId");
    $stmt->bindParam(':lotId', $_POST['lotId'], PDO::PARAM_INT); 
    $stmt->execute();
    
    echo $stmt->fetchColumn();
}
?>
