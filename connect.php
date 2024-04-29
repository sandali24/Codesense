<?php

if($_SERVER['REQUEST_METHOD']=='POST'){
    $first_name=$_POST['first_name'];
    $id_number=$_POST['id_number'];





$con=new mysqli('localhost', 'root', 'Sandali24&$', 'selectiontest');

if($con){
    // echo "Connection successful";
    $sql="insert into `cm_customerms`(first_name,id_number)values('$first_name','$id_number')";
    $result=mysqli_query($con,$sql);

    if($result){
        echo "Data inserted successfully";
    }else{
        die(mysqli_error($con));
    }



}else{
    die(mysqli_error($con));
}
}

?>
