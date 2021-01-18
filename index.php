<?php
include_once "classes/Product.php";
include_once "classes/Customer.php";
include_once "classes/Cart.php";
$pro = new Product();
$cmr = new Customer();
$ct = new Cart();

?>


<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!------ Include the above in your HEAD tag ---------->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="">
    <title>PHP - AJAX - CRUD</title>
</head>
<body>
<!-- View Modal -->

<!--add modal-->
<div class="modal fade" id="Student_AddModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Student Data using jQuery Ajax in php without page reload</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-message">

                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="">First Name</label>
                        <input type="text" class="form-control first_name">
                    </div>
                    <div class="col-md-6">
                        <label for="">Last Name</label>
                        <input type="text" class="form-control last_name">
                    </div>
                    <div class="col-md-6">
                        <label for="">Class</label>
                        <input type="text" class="form-control class">
                    </div>
                    <div class="col-md-6">
                        <label for="">Section</label>
                        <input type="text" class="form-control section">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary student_add_ajax">Save</button>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h4>
                       Point Of Sale
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#Student_AddModal">
                            Add
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="message-show">
                    </div>
                    <form action="">
                        <div class="form-group col-md-12">
                            <select id="products" name="customer_Id" class="form-control select2">
                                <option>Select A Product</option>
                                <?php
                                $getProduct = $pro->getAllProduct();
                                if ($getProduct) {
                                    while ($results = $getProduct->fetch_assoc())
                                    {
                                        ?>
                                        <option value="<?= $results['productId']; ?> " data-cost="<?=$results['sellingPrice']?>"><?= $results['productName']; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <select id="customers" name="customer_Id" class="form-control select2">
                                <option>Select A Customer</option>
                                <?php
                                $getCustomer = $cmr->getAllCustomer();
                                if ($getCustomer) {
                                    while ($results = $getCustomer->fetch_assoc())
                                    {
                                        ?>
                                        <option value="<?= $results['id']; ?>">
                                            <?= $results['firstname']; ?>
                                        </option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>
                       Point Of Sale of <span class="customers_products" id="customers_products"></span>
                        <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#Student_AddModal">
                            Add
                        </button>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="message-show">
                    </div>
                    <form action="" method="post">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody id="example" class="example">
                            </tbody>
                        </table>
                        <div>
                            <br/>
                            <h3>Here's What You're Getting!</h3><br />
                            <ul class="cartList">
                            </ul>
                            <br/>
                            <h4 id="total"></h4>
                            <br/>
                            <br/>
                            <hr/>
                            <div data-role="randomButtons">
                                <?php
                                $getPd = $ct->getCartProduct();
                                if ($getPd) {
                                    while ($result = $getPd->fetch_assoc()) {
                                        ?>
                                        <a href="../invoice.php?cus_Id=<?= $result['cus_Id'] ?>"
                                           class="btn btn-outline-info"><i
                                                    class="fa fa-arrow-circle-right fa-lg">Invoice</i></a>
                                        <?php
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
<script>
    $(document).ready(function() {
        var selected = [];
        // customers
        $("#customers").change(function(){
            $("#customers_products").html("");
            var customer_id= $("#customers").val();
           // var customer_name= $("#customers option:selected").text();
            // alert(customer_name);
            var show ='<h4>'+customer_id+'</h4>'
            $('#customers_products').append(show);

        });

        $("#products").change(function(){
           // var customer_name= document.getElementById('customers_products').innerText;
            var customer_id= $("#customers_products").text();
            $("#example").html("");
            var product_Id= $("#products").val();
            var product_name= $("#products option:selected").text();
            var product_price= $("#products option:selected").data("cost");
                $.ajax({
                    type: "POST",
                    url: "ajaxCrud/code.php",
                    data: {
                        'checking_add':true,
                        'customer_Id': customer_id,
                        'product_Id': product_Id,
                        'quantity': 1,
                        'product_price': product_price,
                    },
                    success: function (response) {
                        var success = '<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                            '  <strong></strong> '+response+'\n' +
                            '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                            '    <span aria-hidden="true">&times;</span>\n' +
                            '  </button>\n' +
                            '</div>';
                        $('.message-show').append(success);
                        $('.example').html("");
                        getdata();
                    }
                });

        });

    });

    function getdata()
    {
        $.ajax({
            type: "GET",
            url: "ajaxCrud/fetch.php",
            success: function (response) {
                // console.log(response);
                $.each(response, function (key, value) {
                    var show = '<tr>'+
                        '<td id="pro_id" class="pro_id">'+value['cartId']+'</td>\
                                 <td>'+value['productName']+'</td>\
                                 <td>'+value['price']+'</td>\
                                 <td><input id="quantity" class="myInput" type="number" min="1" value='+value['quantity']+' ><button id="student_update_ajax" type="button" class="btn btn-primary btn-sm">Update</button></td>\
                                <td id="subtotal">'+value['price'] * value['quantity'] +'</td>\
                                <td>\
                                    <a href="" class="badge btn-danger delete_btn">Remove</a>\
                                </td>\
                            </tr>'
                    $('.example').append(show);
                });
            }
        });
    }
</script>

<!--Update-->
<script>
    $(document).ready(function () {

        $(document).on("click", "#student_update_ajax", function () {
            var pro_id = $(this).closest('tr').find('#pro_id').text();
          // alert(pro_id);
            var quantity=$('#quantity').val();
          //  alert(quantity);
            $.ajax({
                type: "POST",
                url: "ajaxCrud/updateCode.php",
                data: {
                    'checking_update':true,
                    'pro_id': pro_id,
                    'quantity': quantity,
                },
                success: function (response) {
                    var success = '<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                        '  <strong></strong> '+response+'\n' +
                        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '    <span aria-hidden="true">&times;</span>\n' +
                        '  </button>\n' +
                        '</div>';
                    $('.message-show').append(success);
                    $('#example').html("");
                    getdata();
                }


            });

        });

    });
</script>

<!--delete script-->
<script>
    getdata();
        $(document).on("click", ".delete_btn", function () {
            var pro_id = $(this).closest('tr').find('.pro_id').text();

            $.ajax({
                type: "POST",
                url: "ajaxCrud/deleteCode.php",
                data: {
                    'checking_delete': true,
                    'pro_id': pro_id,
                },
                success: function (response) {
                    var success = '<div class="alert alert-success alert-dismissible fade show" role="alert">\n' +
                        '  <strong</strong> '+response+'\n' +
                        '  <button type="button" class="close" data-dismiss="alert" aria-label="Close">\n' +
                        '    <span aria-hidden="true">&times;</span>\n' +
                        '  </button>\n' +
                        '</div>';
                    $('.message-show').append(success);
                    $('.example').html("");
                    getdata();

                }
            });

        });

</script>
</body>
</html>