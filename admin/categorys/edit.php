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
<title>Modify category</title>

    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<?php
    include("../../config.php");

    $sql = "select * from categorys where id=".$_GET['id'];
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);      
  ?>
<div class="box">
	<h1>Modify category</h1>
	<form method="post" class="form-x" action="action.php?a=update" enctype="multipart/form-data">
		<input type="hidden" value="update" name="a" />
		<input type="hidden" value="<?php echo $row['id']; ?>" name="id" />
	    <table class="profile-table">
            <tr><th>Name: </th><td><input type="text" name="name" value="<?php echo $row['name']; ?>" required='required' /></td></tr>
			<tr><th>Add time: </th><td>
                 <?php echo date("Y-m-d H:i:s",$row['addtime'])?> </td></tr>
            <tr><th>Modify time: </th><td>
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