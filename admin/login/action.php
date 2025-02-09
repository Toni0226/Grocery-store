<?php
	header("Content-type: text/html; charset=utf-8");
	session_start();

	switch ($_GET['a']) {
		case 'login':
	
			$username = $_POST['username'];
			$password = $_POST['password'];



			include('../../config.php');

			
			$sql = "select * from admin where username='{$username}'";
			$result = mysqli_query($link,$sql);
			if($result && mysqli_num_rows($result)>0){
				$row = mysqli_fetch_assoc($result);
				if($password != $row['password']){
					echo "<script>alert('Wrong password, please re-enter!');window.history.back(-1)</script>";
					exit;			
				}

				$_SESSION['admin'] = $row;
				echo "<script>location.href='../index.php'</script>";
			}else{
				echo "<script>alert('The account does not exist, please re-enter!');window.history.back(-1)</script>";
				exit;
			}
			break;

		case 'exit': 
			unset($_SESSION['admin']);
			echo "<script>location.href='login.php'</script>";
			break;
		default: 
			echo "<script>alert('Parameter error, please refresh the page and try again!');location.href='../index.php'</script>";
			exit;
			break;
	}
	

	mysqli_close($link);
	mysqli_free_result($result);