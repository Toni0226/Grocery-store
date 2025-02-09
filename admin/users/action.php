<?php
	session_start();
	include("../../config.php");

	switch($_POST['a']){

		case 'update': 

            $oldusername=$_POST['oldusername'];
            $username=$_POST['username'];
            $password=$_POST['password'];

            $name    = $_POST['name'];
            $password   = $_POST['password'];
            $status   = $_POST['status'];
            $unit_price   = $_POST['unit_price'];
            $username   = $_POST['username'];
            $email   = $_POST['email'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $now=time();


            $sql = "select * from users where username='".$username."'";
            $result = mysqli_query($link,$sql);
            @$user = mysqli_fetch_assoc($result);

            if($oldusername != $username && $user ){
              
                echo "<script>alert('Username already exists, please re-enter!');window.history.back(-1)</script>";
                exit;
            }
            

            if (empty($username)) {
                echo "<script>alert('Please enter username: ');window.history.back(-1)</script>";
                exit;
            }



            $sql = sprintf("update users set password=%s,status=%s,name=%s, username=%s,email=%s,updatetime=%s, phone=%s, address=%s where id=%s",
                GetSQLValueString($password, "int"),
                GetSQLValueString($status, "int"),
                GetSQLValueString($name, "text"),
                GetSQLValueString($username, "text"),
                GetSQLValueString($email, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($phone, "text"),
                GetSQLValueString($address, "text"),
                GetSQLValueString($_POST['id'], "int"));

            $result = mysqli_query($link,$sql);
			if(mysqli_affected_rows($link)>0){

				echo "<script>alert('Successfully edit!');location.href='index.php'</script>";
			}else{
				echo "<script>alert('Failed to edit!');window.history.back(-1)</script>";
			}
			break;

		case "del":
			$sql = "delete from users where id=".$_POST['id'];
			$result = mysqli_query($link,$sql);
			if(mysqli_affected_rows($link)){

				exit(json_encode(0));
			}else{
				exit(json_encode(1));
			}
		break;

	}

	mysqli_close($link);
	@mysqli_free_result($result);