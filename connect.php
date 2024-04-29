<?php
$con = new mysqli('localhost', 'root', 'Sandali24&$', 'selectiontest');

if ($con) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $first_name = $_POST['first_name'];
        $id_number = $_POST['id_number'];

        // Get the selling price and number of installments from the form
        $sellingPrice = floatval($_POST['sellingPrice']);
        $numInstallments = intval($_POST['res_date']);

        // Calculate the installment amount
        $installmentAmount = $sellingPrice / $numInstallments;

        // Get the reservation date from the form
        $reservationDate = $_POST['reservation_date'];

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

        // Insert data into the cm_customerms table
        $sql = "INSERT INTO cm_customerms (first_name, id_number) VALUES ('$first_name', '$id_number')";
        $result = mysqli_query($con, $sql);

        if ($result) {
            echo "Data inserted successfully!";
        } else {
            die(mysqli_error($con));
        }
    }
} else {
    die(mysqli_error($con));
}
?>
