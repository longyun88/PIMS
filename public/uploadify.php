<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

	require dirname(__FILE__)."/common/common.inc.php"; 
	include COMMON_PATH."connect.php";		//Æô¶¯session
	
	$my_id = $_SESSION["my_id"];
	$my_db = $_SESSION["my_db_name"];
	$home_db = $_SESSION["db_home"];
	//echo $my_db;
// Define a destination
$targetFolder = 'images/uploads'; // Relative to the root
//echo $_SERVER['DOCUMENT_ROOT'].$targetFolder;

$verifyToken = md5('unique_salt' . $_POST['timestamp']);

if (!empty($_FILES) && $_POST['token'] == $verifyToken) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $targetFolder;
	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('png','jpg','jpeg','gif'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		echo '1';
	} else {
		echo 'Invalid file type.';
	}
}
?>