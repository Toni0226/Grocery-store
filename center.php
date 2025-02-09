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
    <style>
        .login_box{
            font-size: 18px;
        }
        .login_box h1{
            text-align: center;
            margin-bottom: 50px;
        }
        .title{
            width: 35%;
            text-align: right;
            display: inline-block;
            padding-top: 20px;
        }
        .content{
            width: 60%;
            text-align: left;
            display: inline-block;
        }
        .btn{
            width: 100px;
            height: 40px;
            line-height: 40px;
            background-color: #993333;
            color: #fff !important;
            border-radius: 5px;
            display: inline-block;
            margin-top:20px;
        }
    a:hover {
	color: #E4E4E4;
}
    </style>
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
            <h1>Personal information</h1>
            <div>
                <span class="title">Account: </span>
                <span class="content"><?php echo $row['username'];?></span>
            </div>
            <div>
                <span class="title">Name: </span>
                <span class="content"><?php echo $row['name'];?></span>
            </div>
            <div>
                <span class="title">Phone number: </span>
                <span class="content"><?php echo $row['phone'];?></span>
            </div>
            <div>
                <span class="title">Email: </span>
                <span class="content"><?php echo $row['email'];?></span>
            </div>
            <div>
                <span class="title">Address: </span>
                <span class="content"><?php echo $row['address'];?></span>
            </div>

            <div>
                <span class="title">Registration time: </span>
                <span class="content"><?php echo date("Y-m-d H:i:s",$row['addtime']);?></span>
            </div>

            <div>
                <span class="title">Modification time: </span>
                <span class="content"><?php echo date("Y-m-d H:i:s",$row['updatetime']);?></span>
            </div>
            <div style="text-align:center;">
                <a href="centeredit.php" class="btn">Change</a>
            </div>
        </div>
    </div>
    <?php
    include('foot.php');
    ?>
</body>
</html>