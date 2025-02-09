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
<title>Modify product</title>


    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<?php
    include("../../config.php");

    $sql = "select * from products where id=".$_GET['id'];
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);      
  ?>
<div class="box">
	<h1>Modify product</h1>
	<form method="post" class="form-x" action="action.php?a=update" enctype="multipart/form-data">
		<input type="hidden" value="update" name="a" />
		<input type="hidden" value="<?php echo $row['id']; ?>" name="id" />
	    <input type="hidden" value="<?php echo $row['img']; ?>" name="img" />
		<table class="profile-table">
            <tr><th width="200">Category: </th><td>
                    <select name="category_id" required>
                        <option value="">Category: </option>

                        <?php
                        $sql2 = "select * from categorys  order by id asc ";
                        $result2 = mysqli_query($link,$sql2);
                        while($row2 = mysqli_fetch_assoc($result2)){  ?>
                            <option value="<?=$row2["id"]?>"  <?php echo $row['category_id']==$row2["id"]?'selected':''; ?> ><?=$row2["name"]?></option>
                        <?php } ?>

                    </select>

                </td></tr>
            <tr><th>Product name: </th><td><input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required='required' /></td></tr>
			<tr><th>Product original image: </th><td><a href="<?php echo $row['img']; ?>" target="_blank"><img width="100" src="../../<?php echo $row['img']; ?>" alt="Image loading failed"></a></td></tr>
			<tr><th>Product new image: </th><td><input type="file" name="pic"></td></tr>
			<tr><th>Product price: </th><td><input type="number" name="unit_price" value="<?php echo $row['unit_price']; ?>" required='required' /></td></tr>
            <tr><th>Product specifications: </th><td><input type="text" name="unit_quantity" value="<?php echo $row['unit_quantity']; ?>"  required='required' /></td></tr>
            <tr><th>Product stocks: </th><td><input type="number" name="in_stock" value="<?php echo $row['in_stock']; ?>"  required='required' /></td></tr>
            <tr><th>Product introduction: </th><td><textarea name="content" type="text/plain"  rows="10" cols="60"><?php echo $row['content']; ?></textarea></td></tr>
            <tr><th>Status: </th><td>
                    <label><input type="radio" name="status" value="1" required='required' <?php echo $row['status']==1?'checked':''; ?> /> Show </label>
                    <label><input type="radio" name="status" value="2" required='required' <?php echo $row['status']==2?'checked':''; ?>/> Hide </label>

                </td></tr>
            <tr><th>Added time: </th><td>
                    <?php echo date("Y-m-d H:i:s",$row['addtime'])?> </td></tr>
            <tr><th>Modification time: </th><td>
                    <?php echo date("Y-m-d H:i:s",$row['updatetime'])?> </td></tr>

            <tr>
				<td colspan="2" class="td-btn">
					<input type="submit" value="Submit" class="button" />
					<input type="reset" value="Reset" class="button" />

                    <a href="javascript://" onclick="history.back()" >Return</a>
				</td>
			</tr>
		</table>
	</form>
</div>
</body>
</html>