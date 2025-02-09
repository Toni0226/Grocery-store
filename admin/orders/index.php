<?php
session_start();
if(!isset($_SESSION['admin'])){
    header('location:login/login.php');
    exit;
}

include('../../config.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Order information list</title>
    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<div class="box">
    <div class="title">Order list</div>
    <div class="search">
        <?php
        $user_id="";
        if(!empty($_GET['user_id'])){
            $user_id=$_GET['user_id'];
        }
        $status="";
        if(!empty($_GET['status'])){
            $status=$_GET['status'];
        }
        ?>
        <form method="get" action="index.php">


            <select name="user_id">
                <option value="">User</option>

                <?php
                $sql = "select * from users  order by id desc ";
                $result = mysqli_query($link,$sql);
                while($row = mysqli_fetch_assoc($result)){  ?>
                    <option value="<?=$row["id"]?>"  <?php echo $user_id==$row["id"]?'selected':''; ?> ><?=$row["username"]?></option>
                <?php } ?>

            </select>


            <select name="status">
                <option value="">Status</option>
                <option value="1"  <?php echo $status==1?'selected':''; ?> >Pending</option>
                <option value="2"  <?php echo $status==2?'selected':''; ?> >Processed</option>
            </select>
            <span>Please enter order number: </span>
            <input type="text" name="keywords" value="<?php if(!empty($_GET['keywords'])){echo $_GET['keywords'];} ?>" class="text-word">
            <input type="submit" value="查询" class="text-but">
        </form>
    </div>
    <table border="1">
        <tr>
            <th >ID</th>
            <th>User</th>
            <th>Order number</th>
            <th>Price</th>
            <th>Status</th>
            <th>Order time</th>
            <th>Related operations</th>
        </tr>
        <?php


        $wherelist = array();
        $urllist = array();

        if(!empty($_GET['keywords'])){
            $wherelist[] = " orderno like '%".$_GET['keywords']."%'";
            $urllist[] = "keywords={$_GET['keywords']}";
        }

        if($user_id){
            $wherelist[] = " user_id ='".$user_id."'";
            $urllist[] = "user_id={$user_id}";
        }


        if($status){
            $wherelist[] = " status='".$status."'";
            $urllist[] = "status={$status}";
        }

        $where = "";
        $url = "";
        if(count($wherelist)>0){
            $where =  " where ".implode(' and ', $wherelist);
            $url = implode('&', $urllist);
        }

        $page = !empty($_GET['p']) ? $_GET['p'] : 1 ;
        $pagesize = 6;
        $maxrow = 0;
        $maxpage = 0;

        $sql = "select id from orders  ".$where;
        $result = mysqli_query($link,$sql);
        $maxrow = mysqli_num_rows($result);
        $maxpage = ceil($maxrow/$pagesize);  
        if ($maxpage<1) {
            $maxpage=1;
        }

   
        if($page>$maxpage){
            $page = $maxpage;
        }
        if($page<1){
            $page = 1;
        }

        $limit = " limit ".($page-1)*$pagesize.",".$pagesize;
        $sql = "select * from orders ".$where.' order by id desc '.$limit;
        $result = mysqli_query($link,$sql);

        $i=1;

        while($row = mysqli_fetch_assoc($result)){


            ?>
            <tr>
                <td><?php echo ($page-1)*$pagesize+$i++; ?></td>
                <td><?php echo getUserName($row['user_id']); ?></td>
                <td><?php echo $row['orderno']; ?></td>
                <td><?php echo $row['amount']; ?></td>
                <td><?php echo $row['status']==1?'Pending':'Processed'; ?></td>
                <td><?php echo date("Y-m-d H:i:s",$row['addtime']); ?></td>

                <td>
                    <div align="center">
					<span>
						<a class='page' href="edit.php?id=<?php echo $row['id'];?>">Edit</a> |
						<a class='page' href="javascript:delSure(<?php echo $row['id']; ?>)">Delete</a>

					</span>
                    </div>
                </td>
            </tr>
        <?php } ?>
        <tr>
            <td  colspan="9" class="fenye"><?php echo $maxrow; ?> Data <?php echo $page."/"; echo $maxpage; ?> Page&nbsp;&nbsp;
                <?php
                echo "<a class='page' href='index.php?p=1&{$url}'>Home</a>&nbsp;&nbsp;";
                echo "<a class='page' href='index.php?p=".($page-1)."&{$url}'>Previous page</a>&nbsp;&nbsp;";
                echo "<a class='page' href='index.php?p=".($page+1)."&{$url}'>Next page</a>&nbsp;&nbsp;";
                echo "<a class='page' href='index.php?p={$maxpage}&{$url}'>Last page</a>";
                ?>
            </td>
        </tr>
    </table>
</body>
</html>
<script src="../include/js/jquery.min.js"></script>
<script type="text/javascript">
    function delSure(id,img1){
        if(confirm("Are you sure to delete?")){
            $.post("action.php",{a:"del",id:id},function(data){
                if (data == 0) {
                    alert("Successfully deleted!");
                    window.location.href= "index.php";
                }else {
                    alert("Failed to delete!");
                };
            },"json");
        }
    }
</script>