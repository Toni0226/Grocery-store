<?php
	session_start();
	include("../../config.php");

	switch($_POST['a']){

		case 'update': 
			$id    = $_POST['id'];


			$name    = $_POST['name'];
            $user_id   = $_POST['user_id'];
            $phone   = $_POST['phone'];
            $email   = $_POST['email'];
            $address   = $_POST['address'];
            $payment   = $_POST['payment'];
			$remark  = $_POST['remark'];
			$items = $_POST['items'];
            $status = $_POST['status'];

            $now=time();
            $sql = sprintf("update orders set status=%s,user_id=%s,name=%s,phone=%s,email=%s,address=%s,payment=%s,remark=%s,updatetime=%s where id=%s",

                GetSQLValueString($status, "int"),
                GetSQLValueString($user_id, "text"),
                GetSQLValueString($name, "text"),
                GetSQLValueString($phone, "text"),
                GetSQLValueString($email, "text"),
                GetSQLValueString($address, "text"),
                GetSQLValueString($payment, "text"),
                GetSQLValueString($remark, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($_POST['id'], "int"));

			$result = mysqli_query($link,$sql);
			if(mysqli_affected_rows($link)>0){




                $obj = new stdClass();
                $obj->code="1";
                $obj->msg="Successfully edit!";
                $obj->id=$id;
                echo urldecode(json_encode($obj));
                return;


			}else{
                $obj = new stdClass();
                $obj->code="0";
                $obj->msg="Fail to edit!";
                $obj->id=$id;
                echo urldecode(json_encode($obj));
                return;

			}
			break;

		case "del":
			$sql = "delete from orders where id=".$_POST['id'];
			$result = mysqli_query($link,$sql);
			if(mysqli_affected_rows($link)){
                $sql2 = "delete from orderitems where orders_id=".$_POST['id'];
                $result2 = mysqli_query($link,$sql2);
				exit(json_encode(0));
			}else{
				exit(json_encode(1));
			}
		break;

	}

	mysqli_close($link);
	@mysqli_free_result($result);