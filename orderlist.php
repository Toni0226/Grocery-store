<?php
session_start();
if (!isset($_SESSION['home'])) {
    echo "<script>alert('Not logged in, please log in first!');location.href='login.php'</script>";
    exit;
}

include('config.php');
?>
<!doctype html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Grocery store - My order</title>
</head>
<body>
<?php include('nav.php'); ?>
<div id="contenter">
<div class="box">
    <div class="title">My order</div>
    <table border="1">
        <tr>
            <th width="100">Order number</th>
            <th width="50%">Order details</th>
            <th>Status</th>
            <th>Time</th>
        </tr>
        <?php
        $page = !empty($_GET['p']) ? $_GET['p'] : 1;
        $pagesize = 1;
        $maxrow = 0;
        $maxpage = 0;

        $sql = "SELECT * FROM orders WHERE user_id='" . $_SESSION['home']['id'] . "'";
        $result = mysqli_query($link, $sql);
        $maxrow = mysqli_num_rows($result);
        $maxpage = ceil($maxrow / $pagesize);

        if ($maxpage < 1) $maxpage = 1;
        if ($page > $maxpage) $page = $maxpage;
        if ($page < 1) $page = 1;

        $limit = " LIMIT " . ($page - 1) * $pagesize . ", " . $pagesize;
        $sql = "SELECT * FROM orders WHERE user_id='" . $_SESSION['home']['id'] . "' ORDER BY id DESC" . $limit;
        $resultOrders = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($resultOrders)) {
            echo "<tr>
                <td>{$row['orderno']}</td>
                <td>
                    <div class='checkout-tablehead'>
                        <div class='cell itemname'>Product</div>
                        <div class='cell itemquantity'>Quantity</div>
                        <div class='cell itemtotal'>Subtotal</div>
                    </div>
                    <ul class='checkout-body'>";

            $sqlItems = "SELECT * FROM orderitems WHERE orders_id={$row['id']} ORDER BY id ASC";
            $resultItems = mysqli_query($link, $sqlItems);
            $total = 0;
            $count = 0;
            while ($obj = mysqli_fetch_assoc($resultItems)) {
                echo "<li class='checkout-tablerow'>
                    <div class='cell itemname'><div class='fl'><img src='{$obj['photo']}' width='50' /></div><div class='fl' style='width: 100px'>{$obj['name']} {$obj['price']} {$obj['unit']}</div></div>
                    <div class='cell itemquantity'>{$obj['qty']}</div>
                    <div class='cell itemtotal'>￥{$obj['subtotal']}</div>
                </li>";
                $total += $obj['subtotal'];
                $count += $obj['qty'];
            }
            echo "<li class='checkout-tablerow'>
                    <div class='cell itemname'>Total</div>
                    <div class='cell itemquantity'>$count</div>
                    <div class='cell itemtotal'>$$total</div>
                </li>
            </ul>
            <div class='checkout-bottoms' style='text-align: left'>
                Name: {$row['name']}
                <br>Phone number: {$row['phone']}
                <br>Email: {$row['email']}
                <br>Address: {$row['address']}
                <br>Payment method: " . ($row['payment'] == 1 ? "Online payment" : "Cash on delivery") . "
                <br>Note: {$row['remark']}
            </div>
        </td>
        <td>" . ($row['status'] == 1 ? 'Pending' : 'Processed') . "</td>
        <td>" . date("Y-m-d H:i:s", $row['addtime']) . "</td>
    </tr>";
        }
        ?>
    </table>
    <div class="fenye">
        <?php echo "$maxrow Data $page/$maxpage Page&nbsp;&nbsp;";
        if ($page > 1) {
            echo "<a class='page' href='orderlist.php?p=1'>First page</a>&nbsp;&nbsp;";
            echo "<a class='page' href='orderlist.php?p=" . ($page - 1) . "'>Previous page</a>&nbsp;&nbsp;";
        }
        if ($page < $maxpage) {
            echo "<a class='page' href='orderlist.php?p=" . ($page + 1) . "'>Next page</a>&nbsp;&nbsp;";
            echo "<a class='page' href='orderlist.php?p=$maxpage'>Last page</a>";
        }
        ?>
    </div>
</div>
</div>
<?php include('foot.php'); ?>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/cart.lib.js"></script>
<script src="js/cart.js"></script>
</body>
</html>
