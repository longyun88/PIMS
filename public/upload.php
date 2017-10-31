<?php
	require dirname(__FILE__)."/common/common.inc.php"; 		//加载配置文件

	require COMMON_PATH."init.inc.php";		//加载smarty；
	include COMMON_PATH."connect.php";		//启动session；
	include COMMON_PATH."connect.inc.php";		//连接数据库；



	$up=new FileUpload(array("isRandName"=>true,"allowType"=>array("png","gif","jpg","jepg","bmp"),"FilePath"=>$_SESSION["my_image_url"]."/","MAXSIZE"=>4000000));

	

	if($up->uploadFile("spic"))
	{

		$portrait_url = $_SESSION["my_image_url"]."/".$up->getNewFileName();
		$portrait_tem_url = $_SESSION["my_image_url"]."/portrait_tem.jpg";//.$up->fileType


		copy($portrait_url,$portrait_tem_url);
	}
	else
	{
		print_r($up->getErrorMsg());	
	}


