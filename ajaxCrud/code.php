<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
include_once $filepath."/../helpers/Format.php";
?>

<?php
include_once "../connection.php";
    if (isset($_POST['checking_add'])){
         $product_Id =$_POST['product_Id'];
         $price =$_POST['product_price'];
         $customer_Id =$_POST['customer_Id'];
         $quantity =$_POST['quantity'];
        $sQuery = "select * from products where id = '$product_Id'";
        $query_run = mysqli_query($conn, $sQuery);
        $result = $query_run->fetch_assoc();
        $image = $result['productImage'];

            $query = "INSERT INTO carts (customer_Id, product_Id, quantity, price, image ) 
             VALUES('$customer_Id', '$product_Id', '$quantity', '$price', '$image')";

            $query_run = mysqli_query($conn, $query);
            if ($query_run) {
                echo $return = "Successfully Stored";
            } else {
                echo $return = "Something Went Wrong.!";
            }

    }