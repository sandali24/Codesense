<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codesense</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $("#re_projectms").change(function () {
            var aid = $("#re_projectms").val();
            $.ajax({
                url: 'data.php',
                method: 'post',
                data: 'aid=' + aid,
            }).done(function (re_prjaclotdata) {
                console.log(re_prjaclotdata);
                re_prjaclotdata = JSON.parse(re_prjaclotdata);
                re_prjaclotdata.forEach(function (re_prjaclotdata) {
                    $('#re_prjaclotdata').append('<option>' + re_prjaclotdata.lot_number + '</option>'); // Corrected property name
                });
            });
        });
    });
</script>
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
                <select class="form-control" id="re_projectms" name="re_projectms"> <!-- Corrected typo: "from-control" to "form-control" -->
            <option selected disabled>Select Project</option>
            <?php
            require 'data.php';
            $re_projectms = loadAuthors();
            foreach ($re_projectms as $re_project) { // Renamed variable to avoid conflict
                echo "<option value='" . $re_project['prj_id'] . "'>" . $re_project['project_name'] . "</option>"; // Removed unnecessary attribute
            }
            ?>
        </select>
        <label for="re_projectms">Select Project</label>
</div>
</div>


<div class="row">
                <div class="column">
                <select class="form-control" id="re_prjaclotdata" name="re_prjaclotdata"> <!-- Corrected typo: "from-control" to "form-control" -->
            <option selected disabled>Select Lot</option>
        </select>
                <label for="re_prjaclotdata">Select Lot</label> 
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

        
  