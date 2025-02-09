<?php
session_start();
include('config.php');
include('nav.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Product details</title>
</head>
<body>
<div id="contenter">
    <div class="sort" style="margin-bottom: 20px">
        <h3>Product details</h3>
        <a href="index.php" class="back">Return</a>
    </div>
    <div id="contenter">
        <?php
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $sql = "SELECT * FROM products WHERE id = " . intval($_GET['id']);
            $result = mysqli_query($link, $sql);
            if ($row = mysqli_fetch_assoc($result)) {
                $flag = $row['in_stock'] > 0;
        ?>
        <div class="top">
            <img src="<?php echo htmlspecialchars($row['img']); ?>" width="400" height="400" />
            <div class="main menu-item" item-id="<?php echo $row['id']; ?>">
                <div class="item-wrap">
                    <a href="index.php?category_id=<?php echo $row['category_id']; ?>"><?php echo getCategoryName($row['category_id']); ?></a><br><br>
                    <h3 class="name"><?php echo htmlspecialchars($row['product_name']); ?></h3>
                    <p class="desc"><?php echo htmlspecialchars($row['content']); ?></p>
                    <p class="desc">In stock: <?php echo $row['in_stock']; ?></p>
                    <div class="bottom">
                        <p class="price" item-price="<?php echo $row['unit_price']; ?>">$ <?php echo $row['unit_price']; ?> /
                            <span class="unit" ><?php echo $row['unit_quantity']; ?></span></p>
                        <br>
                        <div style="clear: both"></div>
                        <?php if ($flag) { ?>  
                            <a href="javascript://" class="buy buybtn">Order now</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <?php
            } else {
                echo "<p>Product not found.</p>";
            }
        } else {
            echo "<p>Invalid product ID.</p>";
        }
        ?>
    </div>
</div>
<?php include('foot.php'); ?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>
<script src="js/cart.lib.js"></script>
<script src="js/cart.js"></script>
<script type="text/javascript">
    $(function() {

        initCart();

    });

</script>
</body>
</html>
