<?php

session_start();

if(!isset($_SESSION["userId"])){
    $_SESSION["userId"]=session_id();
}

                $category="";
                if (!empty($_GET['category'])) {
                    $category=trim($_GET['category']);
                }


include('config.php');
?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
    <title>Grocery store</title>
</head>
<body>
<?php
include('nav.php');
?>
<div id="contenter">
    <p class="h1">Product list</p>

    <ul class="piclist">
        <?php



        $wherelist = array();
        $urllist = array();


        if ($category) {
            $wherelist[] = " category_id =" . $category ;
            $urllist[] = "category={$category}";
        }
        if (!empty($_GET['keywords'])) {
            $wherelist[] = " product_name like '%" . $_GET['keywords'] . "%'";
            $urllist[] = "keywords={$_GET['keywords']}";
        }

        $where = " where status=1 ";
        $url = "";
        if (count($wherelist) > 0) {
            $where.= " and " . implode(' and ', $wherelist);
            $url = implode('&', $urllist);
        }

        $page = !empty($_GET['p']) ? $_GET['p'] : 1;
        $pagesize = 8;
        $maxrow = 0;
        $maxpage = 0;

        $sql = "select * from products " . $where ;

        $result = mysqli_query($link, $sql);
        $maxrow = mysqli_num_rows($result);
        $maxpage = ceil($maxrow / $pagesize);
        if ($maxpage < 1) {
            $maxpage = 1;
        }


        if ($page > $maxpage) {
            $page = $maxpage;
        }
        if ($page < 1) {
            $page = 1;
        }

        $limit = " limit " . ($page - 1) * $pagesize . "," . $pagesize;
        $sql = "select * from products " . $where . " order by id desc " . $limit;



        $result = mysqli_query($link, $sql);

        while ($row = mysqli_fetch_assoc($result)) {


            $now=time();

            $flag=true;
            if($row['in_stock']<=0){
                $flag=false;
            }




                ?>
            <li class="menu-item" item-id="<?php echo $row['id']; ?>">


                 <div class="product_item item-wrap">
                        <div class="product_img">
                            <a href="details.php?id=<?php echo $row['id']; ?>"><img class="photo" src="<?php echo $row['img']; ?>" width="200" height="180"
                                                                                    alt="<?php echo $row['product_name']; ?>"/></a>
                        </div>
                        <div class="product_text item-detail">
                            <h4><a href="details.php?id=<?php echo $row['id']; ?>" class="storename name"><?php echo $row['product_name']; ?></a></h4>
                            <h5>$ <span class="price" item-price="<?php echo $row['unit_price']; ?>"><?php echo $row['unit_price']; ?></span> / <span class="unit" ><?php echo $row['unit_quantity']; ?></span></h5>

                            In stock: <span class="stock" item-stock="<?php echo $row['in_stock']; ?>"><?php echo $row['in_stock']; ?></span>    <?php if($flag){ ?><img class="buy"  src="images/icon_buy.png"><?php } ?>

                        </div>
                    </div>


            </li>
            <?php
        }
        ?>
    </ul>
    <div class="page">
        <a href="index.php?p=1&<?php echo $url; ?>">Home page</a>
        <a href="index.php?p=<?php echo ($page - 1) . '&' . $url; ?>">Previous page</a>
        <a href="index.php?p=<?php echo ($page + 1) . '&' . $url; ?>">Next page</a>
        <a href="index.php?p=<?php echo $maxpage . '&' . $url; ?>">Last page</a>
    </div>



</div>
<?php
include('foot.php');
?>


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