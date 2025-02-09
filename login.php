<?php 
    session_start();
    if (isset($_SESSION['home'])) {
        if (isset($_SESSION['home']['name'])) {
            header('location:index.php');
             exit;
        }
    }
include('config.php');
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <title>Grocery store - Login</title>
</head>
<body>
<?php
include('nav.php');
?>
    <div id="contenter">
        <div class="login_box" style="margin-top: 10%;">
            <form action="action.php?a=login" method="post" onSubmit="return check()">
                <h1 style="text-align:center; margin-bottom: 50px">Login</h1>
                <input type="text" name="userName" id="userName" placeholder="Your account" class="i1" />
                <input type="password" name="pwd" id="pwd" placeholder="Your password" class="i1" />
                <div style="text-align:center;">
                    <input type="submit" value="Submit" class="i3">
                    <input type="reset" value="Reset" class="i3">
                </div>   
            </form>
        </div>
    </div>
    <?php
    include('foot.php');
    ?>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.cookie.js"></script>

<script src="js/cart.lib.js"></script>
<script src="js/cart.js"></script>
    <script>
        function check() {
            var userName = $("#userName").val();
            var pwd = $("#pwd").val();
            if (userName == "") {
                alert("Username can not be empty");
                $("#userName").focus();
                return false;
            }
            if (pwd == "") {
                alert("password can not be empty");
                $("#pwd").focus();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>