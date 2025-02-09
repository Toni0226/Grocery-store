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
<title>Add new category</title>
<script src="../include/js/jquery.min.js"></script>

    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<div class="box">
	<h1>Add new category</h1>
	<form method="post" class="form-x" action="action.php" enctype="multipart/form-data">  
		<input type="hidden" name="a" value="insert" />
		<table class="profile-table">

            <tr><th>Name: </th><td><input type="text" name="name" required='required' /></td></tr>

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