<?php 
    @session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>Left navigation</title>
        <style>
            /*a{width: 180px;height: 50px;line-height: 50px}*/
            *{padding: 0;margin:0;}
            html,body{width: 100%; height: 100%}
            .wrap{ height: 100%; width:190px; border-right:2px solid #993333; }
            div{display: inline-block;width: 150px;color: #eee;margin-bottom: 5px;}
            span,a{display: inline-block;width: 150px;padding: 5px 10px;margin-top: 5px;}
            span{font: bold 20px Arial;color: #fff;background:#993333;}
            a{text-align: center;font: bold 18px Arial;color: #fff;background: #993333;text-decoration: none;}
            a:hover{text-align: center;font: bold 18px Arial;color: #fff;background:#581b1b;text-decoration: none;}
        </style>
    </head>
    <body onselectstart="return false" oncontextmenu="return(false)" style="margin-left: 8px;overflow-x:hidden;height: 100% ">
    <div class="wrap">
        <div id="left-top"></div>
        <div>
            <div>
                <a href="../products/index.php" target="mainFrame" onFocus="this.blur()">Product management</a>
                <a href="../products/add.php" target="mainFrame" onFocus="this.blur()">Add new product</a>
                <a href="../categorys/index.php" target="mainFrame" onFocus="this.blur()">Category management</a>
                <a href="../categorys/add.php" target="mainFrame" onFocus="this.blur()">Add new category</a>
                <a href="../orders/index.php" target="mainFrame" onFocus="this.blur()">Order management</a>
                <a href="../users/index.php" target="mainFrame" onFocus="this.blur()">User management</a>
              <a  href="../login/action.php?a=exit" target="_top" onFocus="this.blur()">Logout</a>
            </div>
        </div>
    </body>
</html>