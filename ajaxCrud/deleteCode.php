<?php
include_once "../connection.php";
if (isset($_POST['checking_delete'])){
    $pro_id = $_POST['pro_id'];
       $query = "delete from carts where id = '$pro_id' ";
    $query_run = mysqli_query($conn, $query);
    if($query_run)
    {
        echo $return  = "Successfully Deleted";
    }
    else
    {
        echo $return  = "Something Went Wrong.!";
    }
}