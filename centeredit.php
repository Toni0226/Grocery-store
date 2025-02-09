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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <title>Grocery store</title>
</head>
<body>
<?php
include('nav.php');
?>
    <div id="contenter">

        <?php

           $sql = "select * from users where id=".$_SESSION['home']['id'];
           $result = mysqli_query($link,$sql);
           @$row = mysqli_fetch_assoc($result);
        ?>  
        <div class="login_box" style="width: 475px;">
            <form action="action.php?a=update" method="post" onSubmit="return check()">
                <h1 style="text-align:center;margin-bottom: 20px">Complete personal information</h1>
                <input type="hidden" value="<?php echo $row['username']; ?>" name="oldusername" />
                <div>
                    <span>Username: </span>
                    <input type="text" name="username" id="username" value="<?php echo $row['username'];?>" placeholder="Please enter the delivery name" class="i1" />
                </div>

                <div>
                    <span>Account: </span>
                    <input type="text" value="<?php echo $row['name'];?>"   id="name" name="name"  class="i1"  />
                </div>

                <div>
                    <span>Phone number: </span>
                    <input type="text" name="phone" id="phone" value="<?php echo $row['phone'];?>" placeholder="Please enter phone number" class="i1" />
                </div>
                <div>
                    <span>Email: </span>
                    <input type="text" name="email" id="email" value="<?php echo $row['email'];?>" placeholder="please enter your email" class="i1" />
                </div>
                <div>
                    <span>Address: </span>
                    <input type="text" name="address" id="address" value="<?php echo $row['address'];?>" placeholder="Please enter shipping address" class="i1" />
                </div>
                <div>
                    <span>Password: </span>
                    <input type="text" name="password" id="password" placeholder="Please enter a new password" class="i1" />
                </div>  
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
</body>
</html>
<script src="js/jquery.min.js"></script>
    <script>
        function validateEmail(email) {
            var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            return emailRegex.test(email);
        }
        function check() {
            var username = $("#username").val();
            var phone = $("#phone").val();
            var email = $("#email").val();
            var address = $("#address").val();

            if (!username) {
                alert("Username can not be empty");
                $("#username").focus();
                return false;
            }

            if (!phone) {
                alert("Phone cannot be empty");
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

            if (!address) {
                alert("Shipping address cannot be empty");
                $("#address").focus();
                return false;
            }
            return true;
        }
    </script>