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
<title>Add product</title>
<script src="../include/js/jquery.min.js"></script>


    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<div class="box">
	<h1>Add product</h1>
	<form method="post" class="form-x" action="action.php" enctype="multipart/form-data">  
		<input type="hidden" name="a" value="insert" />
		<table class="profile-table">
            <tr><th width="200">Category: </th><td>
                    <select name="category_id"  required >
                        <option value="">Category: </option>

                        <?php
                        $sql = "select * from categorys  order by id asc ";
                        $result = mysqli_query($link,$sql);
                        while($row = mysqli_fetch_assoc($result)){  ?>
                            <option value="<?=$row["id"]?>"   ><?=$row["name"]?></option>
                        <?php } ?>

                    </select>

                </td></tr>
            <tr><th>Product name: </th><td><input type="text" name="product_name" required='required' /></td></tr>
			<tr><th>Product image: </th><td><input type="file" name="pic" required='required' ></td></tr>
			<tr><th>Product price: </th><td><input type="number" name="unit_price" required='required' /></td></tr>
            <tr><th>Product specifications: </th><td><input type="text" name="unit_quantity" required='required' /></td></tr>
            <tr><th>Product stocks: </th><td><input type="number" name="in_stock" required='required' /></td></tr>
            <tr><th>Product introduction: </th><td><textarea name="content" type="text/plain"  rows="10" cols="50"></textarea></td></tr>
            <tr><th>Status: </th><td>
                    <label><input type="radio" name="status" value="1" required='required' checked /> Show </label>
                    <label><input type="radio" name="status" value="2" required='required' /> Hide </label>

                </td></tr>
            <tr><td colspan="2" class="td-btn">
			<input type="submit" value="Submit" class="button" />
			<input type="reset" value="Reset" class="button" />

                    <a href="javascript://" onclick="history.back()" >Return</a>
			</td></tr>
		</table>
	</form>
</div>
</body>
</html>