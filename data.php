<?php
// data.php
require 'DbConnect.php';

if (isset($_POST['aid'])) {
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT lot_number FROM re_prjaclotdata WHERE prj_id = :aid"); // Use prepared statement
    $stmt->bindParam(':aid', $_POST['aid'], PDO::PARAM_INT); // Bind parameter
    $stmt->execute();
    $re_prjaclotdata = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($re_prjaclotdata);
}

function loadAuthors() {
    $db = new DbConnect;
    $conn = $db->connect();

    $stmt = $conn->prepare("SELECT prj_id, project_name FROM re_projectms"); // Select both columns
    $stmt->execute();
    $re_projectms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $re_projectms;
}
?>