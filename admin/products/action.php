<?php
	session_start();
	include("../../config.php");

	switch($_POST['a']){
		case 'insert':
		
			$product_name    = $_POST['product_name'];
			$category_id   = $_POST['category_id'];
            $status   = $_POST['status'];
            $unit_price   = $_POST['unit_price'];
            $unit_quantity   = $_POST['unit_quantity'];
            $in_stock   = $_POST['in_stock'];
			$content = $_POST['content'];
            $now=time();

            if (empty($category_id)) {
                echo "<script>alert('Please select category');window.history.back(-1)</script>";
                exit;
            }



			$path = "../../upload";

			$upfile = $_FILES['pic'];
			$typelist = array("image/png","image/jpeg","image/gif");
			$maxsize = 0;
			$pic = fileupload($path,$upfile,$typelist,$maxsize);	
			if ($pic['error'] == false) {
				echo "<script>alert('Image upload failed:'".$pic['info'].");window.history.back(-1)</script>";
				exit;
			}			

			$img     = 'upload/'. $pic['info'];


            $insSql = sprintf("INSERT INTO products(category_id,status,product_name, unit_price,unit_quantity,img,in_stock,addtime, updatetime, content) values (%s,%s,%s,%s,%s,%s,%s,%s,%s,%s)",
                GetSQLValueString($category_id, "int"),
                GetSQLValueString($status, "int"),
                GetSQLValueString($product_name, "text"),
                GetSQLValueString($unit_price, "text"),
                GetSQLValueString($unit_quantity, "text"),
                GetSQLValueString($img, "text"),
                GetSQLValueString($in_stock, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($content, "text"));

            $result = mysqli_query($link, $insSql);
			if (mysqli_insert_id($link)>0) {
				echo "<script>alert('Added successfully!');location.href='index.php'</script>";
			}else{
				echo "<script>alert('add failed!');window.history.back(-1)</script>";
			}
			break;

		case 'update': 
			$img    = $_POST['img'];
			$minImg = $_POST['minImg'];
			if($_FILES['pic']['size']!=0){
				$path = "../../upload";
				$upfile = $_FILES['pic'];
				$typelist = array("image/png","image/jpeg","image/gif");
				$maxsize = 0;
				$pic = fileupload($path,$upfile,$typelist,$maxsize); 	
				if ($pic['error'] == false) {
					echo "<script>alert('Image upload failed:'".$pic['info'].");window.history.back(-1)</script>";
					exit;
				}				
				imagezoom($pic['info'], $path, $width=200, $height=200, $pre="m_");
				$img = 'upload/'. $pic['info'];
			}

	
            $product_name    = $_POST['product_name'];
            $category_id   = $_POST['category_id'];
            $status   = $_POST['status'];
            $unit_price   = $_POST['unit_price'];
            $unit_quantity   = $_POST['unit_quantity'];
            $in_stock   = $_POST['in_stock'];
            $content = $_POST['content'];
            $now=time();

            if (empty($category_id)) {
                echo "<script>alert('Plese select category！');window.history.back(-1)</script>";
                exit;
            }


            $sql = sprintf("update products set category_id=%s,status=%s,product_name=%s, unit_price=%s,unit_quantity=%s,img=%s,in_stock=%s,updatetime=%s, content=%s where id=%s",
                GetSQLValueString($category_id, "int"),
                GetSQLValueString($status, "int"),
                GetSQLValueString($product_name, "text"),
                GetSQLValueString($unit_price, "text"),
                GetSQLValueString($unit_quantity, "text"),
                GetSQLValueString($img, "text"),
                GetSQLValueString($in_stock, "text"),
                GetSQLValueString($now, "text"),
                GetSQLValueString($content, "text"),
                GetSQLValueString($_POST['id'], "int"));

            $result = mysqli_query($link,$sql);
			if(mysqli_affected_rows($link)>0){
				if ($img != $_POST['img']) {
					@unlink($_POST['img']);

				}
				echo "<script>alert('Successfully edit!');location.href='index.php'</script>";
			}else{
				echo "<script>alert('Failed to edit!');window.history.back(-1)</script>";
			}
			break;

		case "del":
			$sql = "delete from products where id=".$_POST['id'];
			$result = mysqli_query($link,$sql);
			if(mysqli_affected_rows($link)){
				@unlink($_POST['img1']);
				exit(json_encode(0));
			}else{
				exit(json_encode(1));
			}
		break;

	}

	mysqli_close($link);
	@mysqli_free_result($result);