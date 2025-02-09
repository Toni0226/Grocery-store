<!DOCTYPE html>
<html lang="zh-cn">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <meta name="renderer" content="webkit">
    <title>Grocery store backstage management system</title>
    <style>
	body{background:url(../include/images/bg.jpg) no-repeat top center; background-size:cover}
        .container{margin-top: 200px; border:1px solid #fff; width:600px; margin:200px auto; background:rgba(0,0,0,.5)}
        input{width: 300px;height: 40px;line-height: 40px;margin-bottom:20px;}
        #yzm{width: 190px;}
		.yzm{margin-bottom:20px}
		h2{color:#fff}
		.flex{display:flex; align-items:center;justify-content:center;padding:0;flex-direction: row;}
		
    </style>
</head>
<body>
    <div class="container">
        <center>
            <h2>Administrator login</h2>
            <form action="action.php?a=login" method="post">
            <dl>
                <dt>
                    <dd><input type="text" id="username" name="username" placeholder="Account" required="required" /></dd>
                </dt>
                <dt>
                    <dd><input type="password" id="password" name="password" placeholder="Password" required="required" /></dd>
                </dt>

                <dt>
                    <dd><input type="submit" value="Login"></dd>
                </dt>
            </dl>   
            </form>
        </center> 
    </div>
    <script src="../include/js/jquery.min.js"></script>
    <script>
        function check() {
            var name = $("#name").val();
            var pass = $("#password").val();
            var yzm = $("#yzm").val();
            if (name == "") {
                alert("Account can not be empty");
                $("#name").focus();
                return false;
            }
            if (pass == "") {
                alert("Password can not be empty");
                $("#password").focus();
                return false;
            }
            return true;
        }
    </script>
</body>
</html>