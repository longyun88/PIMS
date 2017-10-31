<?php
/**********  仅测试程序 **********/


	
	$src=base64_decode($_POST['pic']);
	$pic1=base64_decode($_POST['pic1']);   
	$pic2=base64_decode($_POST['pic2']);  
	$pic3=base64_decode($_POST['pic3']); 
	
	//$savePath = 'http://longyun.pub:8080/images/'.$myDB.'/';  //图片存储路径
	//$savePath = './images/'.$myDB.'/';  //图片存储路径
	$savePath = './images/';  //图片存储路径
	$savePicName = time();  //图片存储名称   
	
	//$file_form = end(explode('.',$pic1));
	
	$file_name = $savePicName."_src_".date("YmdHis")."_".rand(100, 999).".jpg";
	$file_src = $savePath.$file_name;
	$filename162 = $savePath.$savePicName."_162.jpg"; 
	$filename48 = $savePath.$savePicName."_48.jpg"; 
	$filename20 = $savePath.$savePicName."_20.jpg"; 
	
	if($src) 
	{
		file_put_contents($file_src,$src);
	}
	
	//file_put_contents($filename162,$pic1);
	//file_put_contents($filename48,$pic2);
	//file_put_contents($filename20,$pic3);
	
	file_put_contents($file_src,$pic1);
	//file_put_contents($savePath."portrait.jpg",$pic1);
	//file_put_contents($savePath."portrait_tem.jpg",$pic1);
	
	//$rs['scr'] = $_POST['pic1'];
	$rs['status'] = 1;
	$rs['picUrl'] = $file_name;
	
	print json_encode($rs);



?>
