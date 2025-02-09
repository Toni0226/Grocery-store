<?php 
    @session_start();
?>
<html>
    <head>
        <meta charset=utf-8 />
        <title>Admin page</title>
        <style type="text/css">
            *{padding: 0;margin:0;}
            #header {
            min-width: 1024px;
            font-family: Arial, "Helvetica Neue", Helvetica, sans-serif;
            color: #993333;
            }
            .left{width: 300px;float: left;font:bold 24px Arial;margin-left: 20px;}
            .right{width: 300px;float: right;}
            .logout{border: 1px solid #333;border-radius: 8px; padding: 5px 10px;background-color:#999; color: #fff;text-decoration: none;}
            .logout:hover{border: 1px solid #999;padding: 5px 10px;background-color:#eee; color: #333;text-decoration: none;font-weight: bold;}
        </style>
    </head>
    <body onselectstart="return false" oncontextmenu=return(false) style="margin-top: 20px;overflow-x:hidden;border-bottom:2px solid #993333">
        <div id="header">
            <div class="left">Grocery store backstage management system</div>
            <div class="right">
                Hi，<?php echo $_SESSION['admin']['username']; ?>

            </div>
        </div>
    </body>
</html>