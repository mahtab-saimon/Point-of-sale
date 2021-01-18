<?php

include_once "../connection.php";
$query = "select *,carts.id as 
          cartId,products.id as product_Id, 
          customers.id as cus_Id , 
          carts.image as cart_Image  
                     from
          carts,products,customers
                      where
          carts.customer_Id=customers.id 
                      and 
          carts.product_Id = products.id
";
$query_run = mysqli_query($conn, $query);
$result_array = [];

if(mysqli_num_rows($query_run) > 0)
{
    foreach($query_run as $row)
    {
        array_push($result_array, $row);
    }
    header('Content-type: application/json');
    echo json_encode($result_array);
}
else
{
    echo $return = "<h4>No Record Found</h4>";
}



?>