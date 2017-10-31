<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

	
	$myDB = "db".$_POST['myID'];
	
// Define a destination
	$tempFile = $_FILES['Filedata']['tmp_name'];
	
	//$targetFolder = '/images/'.$myDB.'/'; // Relative to the root
	$targetFolder = '/images/origin/'; // Relative to the root
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;

	//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
	
	$sFileName = $_FILES['Filedata']['name'];
	$sOriginalFileName = $sFileName;
	$sExtension = substr($sFileName, (strrpos($sFileName, '.') + 1));//ÕÒµ½À©Õ¹Ãû
	$sExtension = strtolower($sExtension);
	//$cFileName = "image_".date("YmdHis")."_".rand(1000, 9999).".".$sExtension;
	$cFileName = "img_".$myDB."_".date("YmdHis")."_".rand(1000, 9999).".".$sExtension;
	
	//$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	$targetName = md5($cFileName).".".$sExtension;
	$targetFile = rtrim($targetPath,'/') . '/' . $targetName;
	
	//$attachName = '/images/' . $myDB . '/' . $cFileName;
	$attachName = '/images/origin/'.$targetName;
	
/*	
	// Validate the file type
	$fileTypes = array('png','jpg','jpeg','gif','bmp'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if(in_array(strrpos($fileParts['extension']),$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
	} else {
		echo '<br>Invalid file type.';
	}
*/
	$targetFile = iconv('UTF-8', 'GBK', $targetFile);
	move_uploaded_file($tempFile,$targetFile);
	
	//echo $attachName;
	//echo $targetName;
	$rs['status'] = 1;
	$rs['picUrl'] = $attachName;
	$rs['picName'] = $targetName;
	$rs['cName'] = $cFileName;
	
	echo json_encode($rs);