<?php
// connect.php

// Establish a database connection
$con = new mysqli('localhost', 'root', 'Sandali24&$', 'selectiontest');

if ($con) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve the form input values
        $first_name = $_POST['first_name'];
        $id_number = $_POST['id_number'];
        $sellingPrice = floatval($_POST['sellingPrice']);
        $numInstallments = intval($_POST['res_date']);
        $reservationDate = $_POST['reservation_date'];
        $selectedProjectId = $_POST['re_projectms']; // Get the selected project ID
        $selectedLotId = $_POST['re_prjaclotdata'];// Get the selected lot ID

        // Insert data into the cm_customerms table
        $sql = "INSERT INTO cm_customerms (first_name, id_number) VALUES ('$first_name', '$id_number')";
        if ($con->query($sql) === TRUE) {
            // Retrieve the auto-generated cus_code
            $cus_code = $con->insert_id;

            // Insert data into the re_resevation table
            $sql = "INSERT INTO re_resevation (cus_code,res_date, seling_price, prj_id, lot_id) VALUES ('$cus_code','$reservationDate', '$sellingPrice', '$selectedProjectId', '$selectedLotId')";
            if ($con->query($sql) === TRUE) {
                echo "Data inserted successfully!";
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else {
            echo "Error: " . $sql . "<br>" . $con->error;
        }


        // Calculate the installment amount
        $installmentAmount = $sellingPrice / $numInstallments;

        // Get the reservation date from the form
        // $reservationDate = $_POST['reservation_date'];

        // Create the payment schedule
        for ($i = 1; $i <= $numInstallments; $i++) {
            // Calculate the due date for each installment
            $dueDate = date('Y-m-d', strtotime("+$i months", strtotime($reservationDate)));

            // Insert data into the re_salesadvanceshedule table
            // (Replace with your actual table and column names)
            $sql = "INSERT INTO re_salesadvanceshedule (installment_number, amount, due_date)
                    VALUES ($i, $installmentAmount, '$dueDate')";
            $result = mysqli_query($con, $sql);

            if (!$result) {
                die(mysqli_error($con));
            }
        }
    }
} else {
    die(mysqli_error($con));
}
?>
