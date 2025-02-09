<?php

	// 
	/**

	*@param 	string 	$path 	
	*@param 	array 	$upfile 	
	*@param 	array 	$typelist	
	*@param 	int 	$maxsize 	
	*@return 	array 	
	
	*/

	function fileupload($path,$upfile,$typelist,$maxsize){

		$path = rtrim($path,"/")."/";
		$res = array("error"=>false,"info"=>"");



		if ($upfile['error'] != 0) {
			switch ($upfile['error']) {
				case 1: $info = "1 The uploaded file exceeds the limit of the upload_max_filesize option in php.ini";
					break;
				case 2: $info = "2 The uploaded file size exceeds the maximum value specified by the MAX_FILE_SIZE element of the HTML form hidden attribute";
					break;
				case 3: $info = "3 File was only partially uploaded";
					break;
				case 4: $info = "4 No files uploaded";
					break;
				case 6: $info = "6 Temporary file not found";
					break;
				case 7: $info = "7 File write failed";
					break;				
				default: $info = "Unknow error";
					break;
			}
			$res['info'] = $info;
			return $res;
		}


		if (!empty($typelist)) {
			if (!in_array($upfile['type'], $typelist)) {
				$res['info'] = "Wrong file type uploaded".$upfile['type'];
				return $res;
			}
		}



		if ($maxsize != 0) {
			if ($upfile['size']>$maxsize) {
				$res['info'] = "The uploaded file is too large";
				return $res;
			}
		}


		do{
			$ext = pathinfo($upfile['name'],PATHINFO_EXTENSION);
			$newname = time().rand(0,999999).".".$ext;
		}while(file_exists($newname));



		if (is_uploaded_file($upfile['tmp_name'])) {
			if (move_uploaded_file($upfile['tmp_name'], $path.$newname)) {
				$res['info'] = $newname;
				$res['error'] = true;
			}else{
				$res['info'] = "File upload failed: File move failed";
				return $res;
			}
		}else{
			$res['info'] = "File upload failed: Not a valid upload file";
		}

		return $res;
	}

	/**
	*
	*@param 	string 		$pic 		
	*@param 	string 		$path 		
	*@param 	int 		$width 		
	*@param 	int 		$height 	
	*@param 	string 		$pre 		
	*@return 	boolean 			
	*/

	function imagezoom($pic,$path,$width,$height,$pre){
		$path = rtrim($path,"/")."/";
	
		$picinfo = getimagesize($path.$pic);
		$w = $picinfo[0];
		$h = $picinfo[1];

	

		switch ($picinfo[2]) {
			case 1: $srcim = imagecreatefromgif($path.$pic);
				break;
			case 2: $srcim = imagecreatefromjpeg($path.$pic);
				break;
			case 3: $srcim = imagecreatefrompng($path.$pic);
				break;
			default: die("Unknow image format");
		}



		if ($width/$w<$height/$h) {
			$dw = $width;
			$dh = $h*($width/$w);
		}else{
			$dw = $w*($height/$h);
			$dh = $height;
		}



		$dstim = imagecreatetruecolor($dw, $dh);

	

		imagecopyresampled($dstim, $srcim, 0, 0, 0, 0, $dw, $dh, $w, $h);



		switch ($picinfo[2]) {
			case 1: imagegif($dstim,$path.$pre.$pic);
				break;
			case 2: imagejpeg($dstim,$path.$pre.$pic);
				break;
			case 3: imagepng($dstim,$path.$pre.$pic);
				break;
			default:
				die("Unknow image format");
		}



		imagedestroy($dstim);
		imagedestroy($srcim);

		return true;
	}

function getCategoryName($id)
{
    global $link;

    $sql = "select * from categorys where id=".$id;
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);

    if($row){
        return $row['name'];
    }
    return "";
}

function getUserName($id)
{
    global $link;

    $sql = "select * from users where id=".$id;
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);

    if($row){
        return $row['username'];
    }
    return "";
}
function getStock($id)
{
    global $link;

    $sql = "select * from products where id=".$id;
    $result = mysqli_query($link,$sql);
    @$row = mysqli_fetch_assoc($result);

    if($row){
        return $row['in_stock'];
    }
    return 0;
}


function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "")
{
    $theValue = addslashes($theValue) ;

    switch ($theType) {
        case "text":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "long":
            $theValue = ($theValue != ""||$theValue==0) ? doubleval($theValue) : "NULL";
            break;
        case "int":
            $theValue = ($theValue != ""||$theValue==0) ? intval($theValue) : "NULL";
            break;
        case "double":
            $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
            break;
        case "date":
            $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
            break;
        case "defined":
            $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
            break;
        default:
            $theValue = ($theValue != "") ? $theValue: "NULL";
            break;
    }
    return $theValue;
}

