<?php
	session_start();
	include("../../config.php");

	switch($_POST['a']){
		case 'insert':

			$name    = $_POST['name'];

            if (empty($name)) {
                echo "<script>alert('Please enter name!');window.history.back(-1)</script>";
                exit;
            }



            $now=time();

            $insSql = sprintf("INSERT INTO categorys(name, addtime, updatetime) values (%s,%s,%s)",
                GetSQLValueString($name, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($now, "text"));

			$result = mysqli_query($link, $insSql);	
			if (mysqli_insert_id($link)>0) {
				echo "<script>alert('Added successfully!');location.href='index.php'</script>";
			}else{
				echo "<script>alert('Add failed!');window.history.back(-1)</script>";
			}
			break;

		case 'update': 
			include("../include/functions.php"); 


			$name    = $_POST['name'];

            if (empty($name)) {
                echo "<script>alert('Please enter name!');window.history.back(-1)</script>";
                exit;
            }


            $now=time();

            $sql = sprintf("update categorys set name=%s,updatetime=%s where id=%s",
                 GetSQLValueString($name, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($_POST['id'], "int"));




			$result = mysqli_query($link,$sql);

			if(mysqli_affected_rows($link)>0){

				echo "<script>alert('Successfully modified!');location.href='index.php'</script>";
			}else{
				echo "<script>alert('fail to edit!');window.history.back(-1)</script>";
			}
			break;

		case "del":
			$sql = "delete from categorys where id=".$_POST['id'];
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