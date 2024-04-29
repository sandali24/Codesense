<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codesense</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>

    <div class="container">
    <form action="connect.php" method="post">
    <div class="row">
                <div class="column">
                  <input type="text" name="first_name" placeholder="Enter your name" autocomplete="off">
                  <label for="customerName">Customer Name</label>
                </div>
                <div class="column">
                  <input type="text" name="id_number" placeholder="Enter your NIC number" autocomplete="off">
                  <label for="customerNIC">Customer NIC</label>
                </div>
            </div>

            <div class="row">
                <div class="column">
                <select name="project_name">
                <option value="" disabled selected hidden>--Select Project--</option>
                <?php
                            // Connect to the database
                            $con = new mysqli('localhost', 'root', 'Sandali24&$', 'selectiontest');

                            // Check connection
                            if ($con->connect_error) {
                                die("Connection failed: " . $con->connect_error);
                            }

                            // Query to select project names from re_projectms table
                            $sql = "SELECT project_name FROM re_projectms";
                            $result = $con->query($sql);

                            // Check if any projects are retrieved
                            if ($result->num_rows > 0) {
                                // Output data of each row
                                while($row = $result->fetch_assoc()) {
                                    echo "<option value='" . $row['project_name'] . "'>" . $row['project_name'] . "</option>";
                                }
                            } else {
                                echo "<option value=''>No projects found</option>";
                            }

                            // Close database connection
                            $con->close();
                        ?>
               
                </select>
                    <label for="projectName">Select Project</label>
</div>
</div>

            <div class="btn">
                <button type="submit">Create</button>
            </div>
            
    </form>

</div>
  
</body>
</html>










    
        

        

        <!-- <label for="lot">Select Lot:</label>
        <select id="lot" name="lot">
        </select><br> -->

        <!-- <label for="selling_price">Selling Price:</label>
        <input type="number" id="selling_price" name="selling_price" readonly><br> -->

        <!-- <label for="reservation_date">Reservation Date:</label>
        <input type="date" id="reservation_date" name="reservation_date" required><br> -->

        <!-- <label for="instalments">Number of Instalments (max 6 months):</label>
        <input type="number" id="instalments" name="instalments" min="1" max="6" required><br> -->

        
  