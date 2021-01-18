<?php
include_once "../connection.php";
    if (isset($_POST['checking_update'])){
        $quantity = $_POST['quantity'];
        $id = $_POST['pro_id'];


         $query = "update carts
                    set
                    quantity = '$quantity'
                    where id = '$id'
                    
         ";
        $query_run = mysqli_query($conn, $query);
        if($query_run)
        {
            echo $return  = "Successfully Stored";
        }
        else
        {
            echo $return  = "Something Went Wrong.!";
        }
    }