<?php 
  session_start(); 
  if(!isset($_SESSION['admin'])){
    header('location:login/login.php');
    exit;
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Grocery store backstage management system</title>
</head>

<frameset rows="95,*,30" cols="*" frameborder="no" border="0" framespacing="0">

	<frame src="include/top.php" name="topframe" scrolling="no" noresize id="topframe" title="topframe" />

	<frameset framespacing="0" border="0" frameborder="no" cols="200,*" rows="*">
		<frame scrolling="no" noresize frameborder="no" name="leftFrame" src="include/left.php"></frame>

			<frame scrolling="" noresize border="0" name="mainFrame" src="products/index.php"></frame>

	</frameset>
</frameset>
<noframes></noframes>
</html>