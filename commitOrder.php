<?php
header("Content-type: text/html; charset=utf-8");
session_start();
error_reporting(E_ERROR);
if (!isset($_SESSION['home'])) {
    echo "<script>alert('Not logged in, please log in first!');location.href='login.php';</script>";
    exit;
}

include('config.php');

function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

function decodeUnicode($str) {
    return preg_replace_callback('/\\\\u([0-9a-fA-F]{4})/', function ($match) {
        return mb_convert_encoding(pack('H*', $match[1]), 'UTF-8', 'UCS-2BE');
    }, $str);
}

$orderno=date("YmdHis");

$name    = $_POST['name'];
$user_id   = $_SESSION['home']['id'];
$phone   = $_POST['phone'];
$email   = $_POST['email'];
$address   = $_POST['address'];
$payment   = $_POST['payment'];
$remark  = $_POST['remark'];
$state  = $_POST['state'];
$city  = $_POST['city'];

if (!isValidEmail($email)) {
    echo "<script>alert('Invalid email format.');history.go(-1);</script>";
    exit;
}

$amount = $_POST['amount'];
$items = $_POST['items'];
$totalqty = $_POST['totalqty'];
//var_dump($items);
if ($amount && $items) {
    $arrObj = json_decode($items);
    $flag = 1;
    $outofstock = "";

    if(empty($arrObj)){
        $obj = new stdClass();
        $obj->code="0";
        $obj->msg="The shopping cart is empty and the order failed!";
        echo urldecode(json_encode($obj));
        exit;
    }
    foreach ( $arrObj as $obj ){


        $stock=getStock($obj->itemId);

        if($stock - $obj->count < 0 ){
            $flag=0;
            $outofstock=decodeUnicode($obj->name).",Stock（".$stock."）insufficent";
            break;
        }
    }

    if($flag==0){
        $obj = new stdClass();
        $obj->code="0";
        $obj->msg=$outofstock;
        echo urldecode(json_encode($obj));

        exit;
    }


    $now=time();
    $sql = sprintf("INSERT INTO orders(totalqty,remark,payment,orderno,user_id,amount, name,phone,email,address,addtime,updatetime,status,`state`,`city`) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
        GetSQLValueString($totalqty, "text"),
        GetSQLValueString($remark, "text"),
        GetSQLValueString($payment, "text"),
        GetSQLValueString($orderno, "text"),
        GetSQLValueString($user_id, "text"),
        GetSQLValueString($amount, "text"),
        GetSQLValueString($name, "text"),
        GetSQLValueString($phone, "text"),
        GetSQLValueString($email, "text"),
        GetSQLValueString($address, "text"),
        GetSQLValueString($now, "text"),
        GetSQLValueString($now, "text"),
        GetSQLValueString(1, "text"),
        GetSQLValueString($state, "text"),
        GetSQLValueString($city, "text")
    );




    $result = mysqli_query($link, $sql);
    $id=mysqli_insert_id($link);
    if ($id>0) {

//var_dump($arrObj);
        foreach ( $arrObj as $obj ){
            $sql2 = "update products set in_stock=in_stock-".$obj->count." where id=".$obj->itemId;
            $result2 = mysqli_query($link,$sql2);
//            var_dump($obj);

            $sql3 = sprintf("INSERT INTO orderitems(orders_id,product_id,name,photo,price,qty, subtotal) values (%s,%s,%s,%s,%s,%s,%s)",
                GetSQLValueString($id, "text"),
                GetSQLValueString($obj->itemId, "text"),
                GetSQLValueString($obj->name, "text"),
                GetSQLValueString($obj->photo, "text"),
//                GetSQLValueString($obj->unit, "text"),
                GetSQLValueString($obj->uprice, "text"),
                GetSQLValueString($obj->count, "text"),
                GetSQLValueString($obj->price, "text"));

            mysqli_query($link, $sql3);
        }

        $obj = new stdClass();
        $obj->code = "1";
        $obj->msg = "Order placed successfully, please wait!";
        $obj->order_id = $id;
        echo urldecode(json_encode($obj));
        exit;
    } else {
        $obj = new stdClass();
        $obj->code = "0";
        $obj->msg = "Order failed!";
        echo urldecode(json_encode($obj));
        exit;
    }
}

mysqli_close($link);
@mysqli_free_result($result);