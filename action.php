<?php
header("Content-type: text/html; charset=utf-8");
session_start();
include('config.php');

switch ($_GET['a']) {
    case 'login': 
    
        $username = $_POST['userName'];
        $pwd1 = $_POST['pwd'];



        $sql = "select * from users where username='{$username}'";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            if ($pwd1 != $row['password']) {
                echo "<script>alert('Wrong password, please re-enter!');window.history.back(-1)</script>";
                exit;
            }
            if (1 != $row['status']) {
                echo "<script>alert('Account has been deactivated!');window.history.back(-1)</script>";
                exit;
            }

            $_SESSION['home'] = $row;
            echo "<script>location.href='index.php'</script>";


        } else {
            echo "<script>alert('The username does not exist. Please enter again!');window.history.back(-1)</script>";
        }
        break;

    case 'register':

        $username = $_POST['userName'];
        $phone = $_POST['phone'];
        $pwd1 = $_POST['pwd'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $address = $_POST['address'];

   
        if (!$username) {
            echo "<script>alert('Username can not be empty!');window.history.back(-1)</script>";
            exit;
        }

        if (!$phone) {
            echo "<script>alert('Phone number can not be empty!');window.history.back(-1)</script>";
            exit;
        }

        if (!$pwd1) {
            echo "<script>alert('Password can not be empty!');window.history.back(-1)</script>";
            exit;
        }




        $sql = "select id from users where username='{$username}'";
        $result = mysqli_query($link, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            echo "<script>alert('Username exist, please change!');window.history.back(-1)</script>";
            exit;
        }

 
        $now=time();
        $sql = sprintf("INSERT INTO users(username,password,name, phone,email,address,addtime,updatetime, status) values (%s,%s,%s,%s,%s,%s,%s,%s,%s)",
            GetSQLValueString($username, "text"),
            GetSQLValueString($pwd1, "text"),
            GetSQLValueString($name, "text"),
            GetSQLValueString($phone, "text"),
            GetSQLValueString($email, "text"),
            GetSQLValueString($address, "text"),
            GetSQLValueString($now, "text"),
            GetSQLValueString($now, "text"),
            GetSQLValueString(1, "text"));



        $result = mysqli_query($link, $sql);
        if (mysqli_insert_id($link) > 0) {
            echo "<script>alert('Registration is successful, you can log in!');location.href='login.php'</script>";
        } else {
            echo "<script>alert('Registration failed, please try again!');window.history.back(-1)</script>";
        }
        break;

    case 'update':
 


        $oldusername=$_POST['oldusername'];


   
        $name    = $_POST['name'];

        $unit_price   = $_POST['unit_price'];
        $username   = $_POST['username'];
        $email   = $_POST['email'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $now=time();

        if ($_POST['password']) {
            $password = $_POST['password'];
        } else {
            $password = $_SESSION['home']['password'];
        }


        $sql = "select * from users where username='".$username."'";
        $result = mysqli_query($link,$sql);
        @$user = mysqli_fetch_assoc($result);
     
        if($oldusername != $username && $user ){

            echo "<script>alert('Username already exists, please re-enter!');window.history.back(-1)</script>";
            exit;
        }


        if (empty($username)) {
            echo "<script>alert('Please enter your username!');window.history.back(-1)</script>";
            exit;
        }



        $sql = sprintf("update users set password=%s,name=%s, username=%s,email=%s,updatetime=%s, phone=%s, address=%s where id=%s",
            GetSQLValueString($password, "int"),
            GetSQLValueString($name, "text"),
            GetSQLValueString($username, "text"),
            GetSQLValueString($email, "text"),
            GetSQLValueString($now, "text"),
            GetSQLValueString($phone, "text"),
            GetSQLValueString($address, "text"),
            GetSQLValueString($_SESSION['home']['id'], "int"));



 
        $result = mysqli_query($link, $sql);
        if (mysqli_affected_rows($link) > 0) {
            $_SESSION['home']['username'] = $username;
            $_SESSION['home']['phone'] = $phone;
            $_SESSION['home']['address'] = $address;
            $_SESSION['home']['email'] = $email;
            $_SESSION['home']['name'] = $name;
            $_SESSION['home']['password'] = $password;

            echo "<script>alert('Successfully modified!');location.href='center.php'</script>";
        } else {
            echo "<script>alert('fail to edit!');window.history.back(-1)</script>";
            // echo mysqli_error($link); 
        }
        break;

    case 'exit':
        unset($_SESSION['home']);
        echo "<script>location.href='login.php'</script>";
        break;
}


mysqli_close($link);
@mysqli_free_result($result);