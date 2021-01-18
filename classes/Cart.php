<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath."/../lib/Database.php";
include_once $filepath."/../helpers/Format.php";
?>

<?php

class Cart
{
    private $db;
    private $fm;

    public function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();

    }
    public function addTocart($data)
    {
      /*  echo "<pre>";

        print_r($data);

        die();

        */
        $product_Id = $this->fm->validation($data['product_Id']);
        $product_Id = mysqli_real_escape_string($this->db->link, $product_Id);

        $price = $this->fm->validation($data['price']);
        $price = mysqli_real_escape_string($this->db->link, $price);

        $customer_Id = $this->fm->validation($data['customer_Id']);
        $customer_Id = mysqli_real_escape_string($this->db->link, $customer_Id);

        $quantity = $this->fm->validation($data['quantity']);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);

        $sQuery = "select * from products where id = '$product_Id'";
        $result = $this->db->select($sQuery)->fetch_assoc();
        $image = $result['productImage'];
        $cheQuery = "select * from carts where product_Id = '$product_Id' and customer_Id='$customer_Id'";
        $getPro = $this->db->select($cheQuery);
        if ($getPro) {
            $msg = "Product Already Added";
            return $msg;
        } else {
            $query = "INSERT INTO carts (customer_Id, product_Id, quantity, price, image ) 
             VALUES('$customer_Id', '$product_Id', '$quantity', '$price', '$image')";

            $inserted_rows = $this->db->insert($query);
            if ($inserted_rows) {
                header("location:pos.php");
            } else {
                header("location:404.php");
            }
        }
    }

    public function getCartProduct()
    {

        $query = "select *,carts.id as 
                    cartId,products.id as product_Id, 
                    customers.id as cus_Id , 
                    carts.image as cart_Image  
                    from carts,products,customers
                               where
                  carts.customer_Id=customers.id 
                              and 
                 carts.product_Id = products.id              ";
        $result = $this->db->select($query);
        return $result;
    }

    public function getInvoice($cus_Id)
    {

        $query = "select *,carts.id as 
                    cartId,products.id as product_Id, 
                    customers.id as cus_Id , 
                    carts.image as cart_Image  
                    from carts,products,customers
                               where
                  $cus_Id=customers.id 
                              and 
                 carts.product_Id = products.id              ";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateCartQuantity($quantity, $cartId)
    {
        $quantity = $this->fm->validation($quantity);
        $quantity = mysqli_real_escape_string($this->db->link, $quantity);
        $cartId = $this->fm->validation($cartId);
        $cartId = mysqli_real_escape_string($this->db->link, $cartId);

        $updateQuery = "update carts set
                            quantity = '$quantity'
                            where id= '$cartId'";
        $cartUpdate = $this->db->update($updateQuery);
        if ($cartUpdate) {
            header("location:pos.php");
        } else {
            $msg = "<span style='color:red; font_size:18px;'>Quantity Not  Updated ..</span>";
            return $msg;
        }

    }


    public function delCartById($id){
        $query = "delete from carts where id = '$id'";
        $result = $this->db->delete($query);
        if ($result){
            echo  "<script>window.location='pos.php';</script>";
        }else {
            $msg = "<span style='color:red; font_size:18px;'>Product Not  Deleted ..</span>";
            return $msg;
        }
    }


    public function checkCartTable(){
        $sId=session_id();
        $query = "select * from cart where sId =  '$sId'";
        $result=$this->db->select($query);
        return $result;
    }

    public function delCustomerCart(){
        $sQuery = "select * from orders ";
        $result = $this->db->select($sQuery)->fetch_assoc();
        $customer_Id = $result['customer_Id'];

        $query = "delete from carts where customer_Id ='$customer_Id'";
        $result=$this->db->select($query);
        return $result;
    }


    public function orderProduct($data){
        $customer_Id = $this->fm->validation($data['customer_Id']);
        $customer_Id = mysqli_real_escape_string($this->db->link, $customer_Id);

        $orderDate = $this->fm->validation($data['orderDate']);
        $orderDate = mysqli_real_escape_string($this->db->link, $orderDate);

        $orderStatus = $this->fm->validation($data['orderStatus']);
        $orderStatus = mysqli_real_escape_string($this->db->link, $orderStatus);

        $totalProducts = $this->fm->validation($data['totalProducts']);
        $totalProducts = mysqli_real_escape_string($this->db->link, $totalProducts);

        $subTotal = $this->fm->validation($data['subTotal']);
        $subTotal = mysqli_real_escape_string($this->db->link, $subTotal);

        $vat = $this->fm->validation($data['vat']);
        $vat = mysqli_real_escape_string($this->db->link, $vat);

        $shipping = $this->fm->validation($data['shipping']);
        $shipping = mysqli_real_escape_string($this->db->link, $shipping);

        $total = $this->fm->validation($data['total']);
        $total = mysqli_real_escape_string($this->db->link, $total);

        $paymentStatus = $this->fm->validation($data['paymentStatus']);
        $paymentStatus = mysqli_real_escape_string($this->db->link, $paymentStatus);

        $pay = $this->fm->validation($data['pay']);
        $pay = mysqli_real_escape_string($this->db->link, $pay);

        $due = $this->fm->validation($data['due']);
        $due = mysqli_real_escape_string($this->db->link, $due);

     $query = "INSERT INTO orders (customer_Id, orderDate, orderStatus, totalProducts,subTotal, vat, shipping ,total,paymentStatus, pay ,due )
         VALUES('$customer_Id', '$orderDate', '$orderStatus', '$totalProducts', '$subTotal', '$vat', '$shipping','$total', '$paymentStatus', '$pay', '$due')";
         $inserted_rows = $this->db->insert($query);

            $price = "select product_Id, price from carts ";
            $resultCarts = $this->db->select($price)->fetch_assoc();
            $price= $resultCarts['price'];
            $product_Id= $resultCarts['product_Id'];

            $sQuery = "select * from orders ";
            $resultOrder = $this->db->select($sQuery)->fetch_assoc();
            $order_Id = $resultOrder['id'];
            $quantity = $resultOrder['totalProducts'];
            $total = $resultOrder['total'];

            $order_Id = $this->fm->validation($order_Id);
            $order_Id = mysqli_real_escape_string($this->db->link, $order_Id);

            $product_Id= $this->fm->validation($product_Id);
            $product_Id = mysqli_real_escape_string($this->db->link, $product_Id);

            $quantity = $this->fm->validation($quantity);
            $quantity = mysqli_real_escape_string($this->db->link, $quantity);

            $total = $this->fm->validation($total);
            $total = mysqli_real_escape_string($this->db->link, $total);

            $order = "INSERT INTO orderdetails (order_Id, product_Id, quantity, price, total ) 
         VALUES('$order_Id', '$product_Id', '$quantity', '$price', '$total')";

            $inserted_row = $this->db->insert($order);
            if ($inserted_row){
                header("location:order/pendingOrder.php");
            }
         else {
            header("location:404.php");
        }
    }

    public function getOrderProduct(){

        $query = "select *,orders.id as o_Id from orders,customers where orders.customer_Id =  customers.id and orders.orderStatus = 'panding'";
        $result=$this->db->select($query);
        return $result;
    }
 public function getOrderSuccess(){

        $query = "select *,orders.id as o_Id from orders,customers where orders.customer_Id =  customers.id and orders.orderStatus = 'success'";
        $result=$this->db->select($query);
        return $result;
    }

    public function getViewOrderProduct($id)
    {
/*        SELECT Orders.OrderID, Customers.CustomerName
FROM Orders
INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID;
orders,products,customers,

SELECT O.*, P.*,OD.*,C.* from orders as O
INNER JOIN orders_details as OD ON OD.order_Id=O.id
INNER JOIN products  as P ON OD.product_Id = P.id
INNER JOIN customers as C ON O.customer_Id = C.id
WHERE O.id=2 AND OD.order_Id=2


        */
        $query = "SELECT O.*, P.*,OD.*,C.* from orders  as O
                INNER JOIN orderdetails as OD ON OD.order_Id=O.id
                INNER JOIN products  as P ON OD.product_Id = P.id
                INNER JOIN customers as C ON O.customer_Id = C.id
                                    where 
                             OD.order_Id =$id
                                    and
                                   O.id =$id ";
        $result = $this->db->select($query);
        return $result;
    }

    public function updateOrderProduct($id, $orderStatus){
        $orderStatus = $this->fm->validation($orderStatus);
        $orderStatus = mysqli_real_escape_string($this->db->link, $orderStatus);


        $updateQuery = "update orders set
                            orderStatus = '$orderStatus'
                            where id= '$id'";
        $success = $this->db->update($updateQuery);
        if ($success) {
            header("location:successOrder.php");
/*
            $msg = "<span style='color:green; font_size:18px;'>Order   Approved ..</span>";
            return $msg;*/
        } else {
            $msg = "<span style='color:red; font_size:18px;'>Order Not  Approved ..</span>";
            return $msg;
        }


    }




}
