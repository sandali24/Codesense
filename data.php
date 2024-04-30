<?php
require 'DbConnect.php';// Include the DbConnect.php file to establish a database connection

if (isset($_POST['aid'])) {
     // Create a new DbConnect object to establish a database connection and get the database connection
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT lot_number FROM re_prjaclotdata WHERE prj_id = :aid AND status = 'pending'");
    // Bind the value of 'aid' from POST request to the prepared statement
    $stmt->bindParam(':aid', $_POST['aid'], PDO::PARAM_INT); 
    $stmt->execute();// Execute the prepared statement
    $re_prjaclotdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($re_prjaclotdata);
}

// Function to load projects from the database
function loadProjects() {
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT prj_id, project_name FROM re_projectms"); 
    $stmt->execute();
    $re_projectms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $re_projectms;
}
?>