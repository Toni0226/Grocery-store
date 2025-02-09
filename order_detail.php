<?php
session_start();
if (!isset($_SESSION['home'])) {
    echo "<script>alert('Not logged in, please log in first!');location.href='login.php'</script>";
    exit;
}


include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Confirm Order</title>
    <style>
        .checkout-select {
            font-size: 18px;
        }
    </style>

</head>

<body>
<?php
include('nav.php');
?>
<div id="contenter">

    <?php

    $sql = "select * from orders where user_id='".$_SESSION['home']['id']."' and id=" . $_GET['id'];
    $result = mysqli_query($link, $sql);
    @$row = mysqli_fetch_assoc($result);


    ?>

        <div class="order-confirm-content">
            <div class="checkout-info">
                <div class="checkout-title">
                    <h2>Order information</h2>
                    <a href="index.php">&lt; Continue to place an order</a>
                </div>
                <div class="checkout-tablehead">
                    <div class="cell itemname">Product</div><div class="cell itemquantity">Quantity</div><div class="cell itemtotal">Subtotal</div>
                </div>
                <ul class="checkout-body">

                    <?php
               //     $arrObj=json_decode($row['items']);

                    $total=0;
                    $count=0;

                    $sql = "select * from orderitems where orders_id=".$row['id']."  order by id asc ";
                    $result = mysqli_query($link,$sql);
                    while($obj = mysqli_fetch_assoc($result)){
                    ?>
                    <li class='checkout-tablerow'>
                        <div class='cell itemname'><div class='fl'><img src="<?php echo $obj['photo'];?>" width='50' /></div><div class='fl' style='width: 100px'><?php echo $obj['name'];?> <?php echo $obj['price'];?> <?php echo $obj['unit'];?></div></div>

                        <div class='cell itemquantity'><?php echo $obj['qty'];?></div>
                       <div class='cell itemtotal'>￥<?php echo $obj['subtotal']; ?></div>
                    </li>

                    <?php
                        $total+=$obj['subtotal'];
                        $count+=$obj['qty'];

                       }
                    ?>
                    <li class='checkout-tablerow'>
                        <div class='cell itemname'>Total</div>
                        <div class='cell itemquantity'><?php echo $count;?></div>
                        <div class='cell itemtotal'>$<?php echo $total; ?></div>
                    </li>
                </ul>
                <div class="checkout-bottom">
                <span>Paid: <a style="color:#f74342;">$</a><a class="checkout-bottom-price"><?php echo $row['amount']; ?></a>
                </span>
                </div>
            </div>

            <div class="checkout-content">


                <div class="checkout-select">
                    <h2>Name</h2>

                    <?php echo $row['name']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Phone number</h2>

                    <?php echo $row['phone']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Email</h2>

                    <?php echo $row['email']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Address</h2>

                    <?php echo $row['address']; ?>
                </div>
                <div class="checkout-select">
                    <h2>State</h2>

                    <?php echo $row['state']; ?>
                </div>
                <div class="checkout-select">
                    <h2>City</h2>

                    <?php echo $row['city']; ?>
                </div>
                <div class="checkout-select">
                    <h2>Payment method</h2>

                    <?php echo $row['payment']==1?"Online payment":"Cash on delivery"; ?>

                </div>
                <div class="checkout-select">
                    <h2>Note</h2>
                    <?php echo $row['remark']; ?>

                </div>


                <div class="checkout-select">
                The order was placed successfully. Your order details have been sent to your email. Please check and receive it. We will process the shipment as soon as possible. Thank you!
                </div>

                <div class="checkout-select">
                    <a class="commit-btn"  href="index.php" >Return</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>


</div>
<?php
include('foot.php');
?>


<script src="js/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script src="js/cart.lib.js"></script>
<script src="js/cart.js"></script>
</body>
</html>
