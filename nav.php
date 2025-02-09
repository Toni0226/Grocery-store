<div id="nav">
    <div class="nav-box">
        <div class="sort">
            <div></div>
            <form action="index.php" method="get">
                <input type="text" name="keywords" placeholder="Enter search keywords" value="<?php echo isset($_GET['keywords']) ? $_GET['keywords'] : ''; ?>">
                <input type="hidden" name="category" value="<?php echo isset($category) ? $category : ''; ?>" >
                <input type="submit" value="Search">
            </form>
        </div>
        <div class="nav-body">
            <img src="upload/logo.png" alt="Online Grocery Store Logo" class="logo-img">
            <a class="logo">Grocery store</a>
            <div class="nav-banner">
            <div class="nav-main">
                <a href="index.php" class="<?php echo isset($category) && $category === '' ? 'active' : ''; ?>">Home</a>
                <div class="dropdown">
                    <button class="dropbtn">Categories</button>
                    <div class="dropdown-content">
                        <?php
                        $categories = [1 => 'Frozen', 2 => 'Fresh', 3 => 'Beverage', 4 => 'Household', 5 => 'Pet food', 7 => 'Food'];
                        foreach ($categories as $catId => $catName) {
                            // Ensure no category is set to active by default
                            echo '<a href="index.php?category=' . $catId . '" ' . (isset($category) && $category == $catId ? 'class="active"' : '') . '>' . $catName . '</a>';
                        }
                        ?>
                    </div>
                </div>
            </div>



                <div class="login">
                    <?php

                    if (isset($_SESSION['home'])) {
                        if (isset($_SESSION['home']['name'])) {
                            echo 'Welcome, ' . $_SESSION['home']['name'] . "  <a href='center.php'>[Profile]</a> <a href='orderlist.php'>[My order]</a> <a href='action.php?a=exit'> [Logout]</a>";
                        } else {
                            echo '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
                        }
                    } else {
                        echo '<a href="login.php">Login</a> | <a href="register.php">Register</a>';
                    }
                    ?>
                    <div id="cart" class="cart fr" >
                        <a href="javascritp://" class="shop-show" style="margin-top: 10px;margin-left: 10px" ><img src="images/icon_cart.png"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="shop-cart shadow n">
    <div class="shop-head">
        Cart<a class="shop-clear">[Clear]</a> <a class="shop-show">[Close]</a>
    </div>
    <div class="shop-body">
        <div class="isnull" style="display: none;">
            <span></span>
            <b>Shopping cart is empty!</b>
        </div>
    </div>
    <div class="shop-bottom" style="right: 0px;">
        <div class="bottom-price fl" style="width: 65%;">Total: $
<label>0</label></div>
        <div class="bottom-icon"></div>
        <div class="bottom-pay fr" style="display: block;">
            <a id="cart-pay">Check out</a>
        </div>
    </div>
</div>

