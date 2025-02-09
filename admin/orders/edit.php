<?php 
  session_start(); 
  if(!isset($_SESSION['admin'])){
    header('Location:login.php');
    exit;
  }
?><!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Modify order</title>


    <link rel="stylesheet" type="text/css" href="../css/style.css" />
    <style>
        .checkout-select {
            font-size: 18px;
        }
    </style>
</head>
<body>
<?php
    include("../../config.php");

    $sql = "select * from orders where id=".$_GET['id'];
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);      
  ?>
<div class="box">
	<h1>Modify order</h1>
	<form method="post" class="form-x" action="action.php?a=update" enctype="multipart/form-data">
		<input type="hidden" value="update" name="a" />
		<input type="hidden" value="<?php echo $row['id']; ?>" name="id" id="id"/>

        <div class="order-confirm-content">
            <div class="checkout-info">
                <div class="checkout-title">
                    <h2>Order details</h2>
                    <?php echo $row['orderno']; ?>
                </div>
                <div class="checkout-tablehead">
                    <div class="cell itemname">Product</div><div class="cell itemquantity">Quantity</div><div class="cell itemtotal">Subtotal</div>
                </div>
                <ul class="checkout-body" style="margin: 0px; padding: 0px">

                    <?php
                    //     $arrObj=json_decode($row['items']);

                    $total=0;
                    $count=0;

                    $sql = "select * from orderitems where orders_id=".$row['id']."  order by id asc ";
                    $result = mysqli_query($link,$sql);
                    while($obj = mysqli_fetch_assoc($result)){
                        ?>
                        <li class='checkout-tablerow'>
                            <div class='cell itemname'><div class='fl'><img src="../<?php echo $obj['photo'];?>" width='50' /></div><div class='fl' style='width: 100px'><?php echo $obj['name'];?> <?php echo $obj['price'];?> <?php echo $obj['unit'];?></div></div>

                            <div class='cell itemquantity'><?php echo $obj['qty'];?></div>
                            <div class='cell itemtotal'>$<?php echo $obj['subtotal']; ?></div>
                        </li>

                        <?php
                        $total+=$obj['subtotal'];
                        $count+=$obj['qty'];

                    }
                    ?>
                    <li class='checkout-tablerow'>
                        <div class='cell itemname'>Total</div>
                        <div class='cell itemquantity'><?php echo $count;?></div>
                        <div class='cell itemtotal'>$<?php echo $total; ?></div>
                    </li>
                </ul>
                <div class="checkout-bottom">
                <span>Paid: <a style="color:#f74342;">$</a><a class="checkout-bottom-price"><?php echo $row['amount']; ?></a>
                </span>
                </div>
            </div>

            <div class="checkout-content">


                <div class="checkout-select">
                    <h2>User</h2>

                    <select name="user_id"  id="user_id" required>
                        <option value="">User</option>

                        <?php
                        $sql2 = "select * from users  order by id desc ";
                        $result2 = mysqli_query($link,$sql2);
                        while($row2 = mysqli_fetch_assoc($result2)){  ?>
                            <option value="<?=$row2["id"]?>"  <?php echo $row['user_id']==$row2["id"]?'selected':''; ?> ><?=$row2["username"]?></option>
                        <?php } ?>

                    </select>


                </div>
                <div class="checkout-select">
                    <h2>Name</h2>

                    <input  required class="liuyan-txt" id="name" name="name"  value="<?php echo $row["name"]; ?>"  >

                </div>
                <div class="checkout-select">
                    <h2>Phone number</h2>

                    <input  required class="liuyan-txt" id="phone" name="phone"  value="<?php echo $row["phone"]; ?>"  >

                </div>
                <div class="checkout-select">
                    <h2>Email</h2>

                    <input  required class="liuyan-txt" id="email" name="email"  value="<?php echo $row["email"]; ?>" >

                </div>
                <div class="checkout-select">
                    <h2>Address</h2>

                    <input  required class="liuyan-txt" id="address" name="address"  value="<?php echo $row["address"]; ?>"  >

                </div>
                <div class="checkout-select">
                    <h2>Paid method</h2>
                    <select name="payment" id="payment" required>
                        <option value="">Paid method</option>


                        <option value="1"  <?php echo $row['payment']==1?'selected':''; ?> >Online payment</option>
                        <option value="2"  <?php echo $row['payment']==2?'selected':''; ?> >Cash on delivery</option>

                    </select>
                </div>
                <div class="checkout-select">
                    <h2>Note</h2>

                    <input class="liuyan-txt" id="remark" name="remark"  value="<?php echo $row["remark"]; ?>" >

                </div>
                <div class="checkout-select">
                    <h2>Status</h2>
                    <select name="status" id="status" required>
                        <option value="">Status</option>


                        <option value="1"  <?php echo $row['status']==1?'selected':''; ?> >Pending</option>
                        <option value="2"  <?php echo $row['status']==2?'selected':''; ?> >Processed</option>

                    </select>
                </div>
                <input id="totalqty" name="totalqty"  type="hidden" value="<?php echo $row["totalqty"]; ?>" >

                <div class="checkout-select">
                    <h2>Added time</h2>
                   <?php echo date("Y-m-d H:i:s",$row["addtime"]); ?>
                </div>
                <div class="checkout-select">
                    <h2>Modification time</h2>
                    <?php echo date("Y-m-d H:i:s",$row["updatetime"]); ?>
                </div>


                <div class="checkout-select">
                    <a class="commit-btn update-btn" style="width: 40%; display: inline-block" >Modify</a>
                    <a class="commit-btn" style="width: 40%; display: inline-block" href="index.php" >Return</a>
                </div>
            </div>
            <div class="clear"></div>
        </div>


    </form>
</div>
<script src="../include/js/jquery.min.js"></script>
<script type="text/javascript">


    $(function(){



        $('.update-btn').click(function(event) {


            var id=$('#id').val();

            var user_id=$('#user_id').val();
            var email=$('#email').val();
            var phone=$('#phone').val();
            var address=$('#address').val();
            var payment=$('#payment').val();
            var status=$('#status').val();
            var orderName=$('#name').val();
            var orderRemark=$('#remark').val(); 



            if(!user_id){
                alert("Please select user");
                return false;
            }else if(!orderName){
                alert("Please enter name");
                return false;
            }else{


                var postUrl="action.php";






                $.post(postUrl,
                            {

                                a:'update',
                                id:id,
                                user_id:user_id,
                                phone:phone,
                                email:email,
                                address:address,
                                payment:payment,
                                name:orderName,
                                remark:orderRemark,
                                status:status
                            },
                            function(data,status,xhr) {

                                if(status=="success"){
                                    $res= $.parseJSON(data);
                                    if($res.code=="1"){
              

                                        alert($res.msg);
                                        window.location.href="edit.php?id="+$res.id;

                                    }else if($res.code=="0"){
                                        alert($res.msg);
                                    }
                                }else{
                                    alert("Sever error");
                                }
                            });

            }
        });



    });
</script>
</body>
</html>