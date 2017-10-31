<?php
/**
 * 全局公共方法
 */


if(!function_exists('enCode')){
	function enCode($str,$module){
		return medsci_encode($str,config("crypt.{$module}_pass_key"));
	}
}

if(!function_exists('deCode')){
	function deCode($str,$module){
		return medsci_decode($str,config("crypt.{$module}_pass_key"));
	}
}



/**
 * 上传文件
 */
if (!function_exists('upload')) {
	function upload($file, $saveFolder, $patch = 'research')
	{
		$allowedExtensions = [
			'jpg', 'jpeg', 'png', 'csv',
		];
		$extension = $file->getClientOriginalExtension();

		/*判断后缀是否合法*/
		if (in_array($extension, $allowedExtensions)) {
			$image = Image::make($file);
			/*保存图片*/
			$date = date('Y-m-d');
			$upload_path = <<<EOF
resource/$patch/$saveFolder/$date/
EOF;

			$mysql_save_path = <<<EOF
$patch/$saveFolder/$date/
EOF;
			$path = storage_path($upload_path);
			if (!is_dir($path)) {
				mkdir($path, 0766, true);
			}
			$filename = uniqid() . time() . '.' . $extension;
			$image->save($path . $filename);
			$returnData = [
				'result' => true,
				'msg' => '上传成功',
				'local' => $mysql_save_path . $filename,
				'extension' => $extension,
			];
		} else {
			$returnData = [
				'result' => false,
				'msg' => '上传图片格式不正确',
			];
		}
		return $returnData;
	}


}

function commonUpload($file, $saveFolder)
{
	$allowedExtensions = [
		'jpg', 'jpeg', 'png', 'csv','xls','pdf','gif'
	];
	$extension = $file->getClientOriginalExtension();

	/*判断后缀是否合法*/
	if (in_array($extension, $allowedExtensions)) {

		/*保存图片*/
		$upload_path = 'resource/research/' . $saveFolder . '/' . date('Y-m-d') . '/';
		$mysql_save_path = 'research/' . $saveFolder . '/' . date('Y-m-d') . '/';
		$path = storage_path($upload_path);
		if (!is_dir($path)) {
			mkdir($path, 0766, true);
		}
		$filename = uniqid() . time() . '.' . $extension;

		$file->move($path, $filename);

		$returnData = [
			'result' => true,
			'msg' => '上传成功',
			'local' => $mysql_save_path . $filename,
			'extension' => $extension,
		];
	} else {
		$returnData = [
			'result' => false,
			'msg' => '上传图片格式不正确',
		];
	}
	return $returnData;
}