<?php
session_start();
if (isset($_SESSION['home'])) {
    if (isset($_SESSION['home']['name'])) {
        header('location:index.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <title>Grocery store - Register</title>
</head>
<body>
<?php
include('nav.php');
?>
    <div id="contenter">
        <div class="login_box">
            <form action="action.php?a=register" method="post" onSubmit="return check()">
                <h1 style="text-align:center; margin-bottom: 50px">Register an account</h1>
                <input type="text" name="userName" id="userName" placeholder="Please enter user name" class="i1" />
                <input type="password" name="pwd" id="pwd" placeholder="Please enter password" class="i1" />
                <input type="text" name="name" id="name" placeholder="Please type in your name" class="i1" />
                <input type="text" name="phone" id="phone" placeholder="Please enter phone number"  class="i1" />
                <input type="text" name="email" id="email" placeholder="Please enter email" class="i1" />
                <input type="text" name="address" id="address" placeholder="Please enter address" class="i1" />

                <div style="text-align:center;">
                    <input type="submit" value="Register" class="i3">
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
        function validateEmail(email) {
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return emailRegex.test(email);
        }


        function check() {
            var userName = $("#userName").val();
            var phone = $("#phone").val();
            var pwd = $("#pwd").val();
            var name = $("#name").val();
            var email = $("#email").val();
            var address = $("#address").val();

            if (!userName) {
                alert("Username can not be empty");
                $("#userName").focus();
                return false;
            }
            if (!pwd) {
                alert("Password can not be empty");
                $("#pwd").focus();
                return false;
            }
            if (!phone) {
                alert("Phone number cannot be empty");
                $("#phone").focus();
                return false;
            }

            if (!email) {
                alert("Email cannot be empty");
                $("#email").focus();
                return false;
            }else if(!validateEmail(email)){
                alert("Email format error");
                $("#email").focus();
                return false;
            }


            return true;
        }
    </script>
</body>
</html>