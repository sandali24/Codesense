<?php
require 'DbConnect.php';

if (isset($_POST['lotId'])) {
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT sale_val FROM re_prjaclotdata WHERE lot_number = :lotId");
    $stmt->bindParam(':lotId', $_POST['lotId'], PDO::PARAM_INT); 
    $stmt->execute();
    
    echo $stmt->fetchColumn();  // This will return only the first column from the first row of your result set, i.e., sale_val.
}
?>
