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
<title>Modify user</title>


    <link rel="stylesheet" type="text/css" href="../css/style.css" />
</head>
<body>
<?php
    include("../../config.php");

    $sql = "select * from users where id=".$_GET['id'];
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);      
  ?>
<div class="box">
	<h1>修改用户</h1>
	<form method="post" class="form-x" action="action.php?a=update"  onSubmit="return check()">
		<input type="hidden" value="update" name="a" />
		<input type="hidden" value="<?php echo $row['id']; ?>" name="id" />
        <input type="hidden" value="<?php echo $row['username']; ?>" name="oldusername" />
        <table class="profile-table">

            <tr><th>Username: </th><td><input type="text" name="username" value="<?php echo $row['username']; ?>" required='required' /></td></tr>
            <tr><th>Name: </th><td><input type="text" name="name" value="<?php echo $row['name']; ?>" required='required' /></td></tr>
            <tr><th>Password: </th><td><input type="password" name="password" value="<?php echo $row['password']; ?>" required='required' /></td></tr>
            <tr><th>Email: </th><td><input type="text" name="email" value="<?php echo $row['email']; ?>" required='required' /></td></tr>
            <tr><th>Phone number: </th><td><input type="text" name="phone" value="<?php echo $row['phone']; ?>"  required='required' /></td></tr>
            <tr><th>Address: </th><td><input type="text" name="address" value="<?php echo $row['address']; ?>"  required='required' /></td></tr>
            <tr><th>Status: </th><td>
                    <label><input type="radio" name="status" value="1" required='required' <?php echo $row['status']==1?'checked':''; ?> /> Show </label>
                    <label><input type="radio" name="status" value="2" required='required' <?php echo $row['status']==2?'checked':''; ?>/> Hide </label>

                </td></tr>
            <tr><th>Added time</th><td>
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
<script src="../../js/jquery.min.js"></script>
<script>
    function validateEmail(email) {
        var emailRegex = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return emailRegex.test(email);
    }
    function check() {
        var username = $("#username").val();
        var phone = $("#phone").val();
        var email = $("#email").val();
        var address = $("#address").val();

        if (!username) {
            alert("Username can not to empty");
            $("#username").focus();
            return false;
        }

        if (!phone) {
            alert("Phone number can not be empty");
            $("#phone").focus();
            return false;
        }


        if (!email) {
            alert("Email can not be empty");
            $("#email").focus();
            return false;
        }else if(!validateEmail(email)){
            alert("Email format error");
            $("#email").focus();
            return false;
        }

        if (!address) {
            alert("Address can not be empty");
            $("#address").focus();
            return false;
        }
        return true;
    }
</script>