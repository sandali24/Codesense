<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Codesense</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<!-- JavaScript code for handling form interactions -->
<script type="text/javascript">
    $(document).ready(function () {
        $("#re_projectms").change(function () {
            // Get the selected project ID and Send AJAX request to fetch lot numbers for the selected project
            var aid = $("#re_projectms").val();
            $.ajax({
                url: 'data.php',
                method: 'post',
                data: 'aid=' + aid,
            }).done(function (re_prjaclotdata) {
                console.log(re_prjaclotdata);
                re_prjaclotdata = JSON.parse(re_prjaclotdata);
                // Populate 're_prjaclotdata' dropdown with fetched lot numbers
                re_prjaclotdata.forEach(function (re_prjaclotdata) {
                    $('#re_prjaclotdata').append('<option>' + re_prjaclotdata.lot_number + '</option>');
                });
            });
        });

        $("#re_prjaclotdata").change(function () {
            var lotId = $("#re_prjaclotdata").val();
            $.ajax({
                url: 'getSellingPrice.php',
                method: 'post',
                data: 'lotId=' + lotId,
            }).done(function (sellingPrice) {
                console.log(sellingPrice);
                $('#sellingPrice').val(sellingPrice); 
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
                <select class="form-control" id="re_projectms" name="re_projectms"> 
                <option selected disabled>Select Project</option>
                <?php
                require 'data.php';
                $re_projectms = loadProjects();
                foreach ($re_projectms as $re_project) { 
                echo "<option value='" . $re_project['prj_id'] . "'>" . $re_project['project_name'] . "</option>"; 
                }
                ?>
                </select>
                <label for="re_projectms">Select Project</label>
                </div>

                <div class="column">
                <select class="form-control" id="re_prjaclotdata" name="re_prjaclotdata"> 
                <option selected disabled>Select Lot</option>
                <?php
                 $selectedProjectId = isset($_POST['re_projectms']) ? $_POST['re_projectms'] : null;
                 if ($selectedProjectId) {
                 $lots = loadLotsByProjectId($selectedProjectId);
                 foreach ($lots as $lot) { 
                 echo "<option value='" . $lot['lot_id'] . "'>" . $lot['lot_number'] . "</option>"; 
                 }
                 } else {
                 echo "<option disabled>No lots available</option>";
                 }
               ?>
                </select>
                <label for="re_prjaclotdata">Select Lot</label> 
                </div>

                <div class="column">
                <input type="text" id="sellingPrice" name="sellingPrice" readonly> 
                <label for="sellingPrice">Selling Price</label> 
                </div>
    </div>


    <div class="row">
                <div class="column">
                <input type="date" id="reservation_date" name="reservation_date" required>
                <label for="reservation_date">Reservation Date</label>
                </div>

                <div class="column">
                <input type="text" name="res_date" placeholder="Number of Instalments " autocomplete="off">
                <label for="customerName">Number of Instalments (max 6 months)</label>
                </div>
    </div>


    <div class="btn">
                <button type="submit">Create</button>
    </div>
            
    </form>

</div>
  
</body>
</html>








    
        

        

        

        

        

        
  