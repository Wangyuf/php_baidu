<?php
namespace Vendor\Baidu;
//error_reporting(0); //勿删

//此函数调试程序用
//function edump($val) {
//	echo '<pre>';
//	var_dump($val);
//	echo '</pre>';
//	exit;
//}

define('USER', 'wuhesheng'); //优优云账号
define('PWD', 'ADSP7811'); //优优云密麻麻

//define('USER', 'b98982007com'); //优优云账号
//define('PWD', '8023yu...'); //优优云密麻麻

//define('USER', 'lingling1224'); //优优云账号
//define('PWD', 'ling0125'); //优优云密麻麻

define('CODE_TYPE', '1004'); //打码类型

define('SERVER_URL', 'http://getcode.fangsong88.com/dama/server.php'); //获取验证码url
define('CLIENT_FILE_PATH', ''); //本地文件打码使用 使用绝对路径

class GetcodeCurl {
	
	public function simpleGet($url) {
		$ch = curl_init($url);
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		$output = curl_exec($ch);
//edump(curl_error($ch));
		curl_close($ch);
		
		return $output;
	}

	/**
	 * 下载验证码文件 保存到本地
	 * 
	 * Enter description here ...
	 * 
	 * @return filePath 验证码文件绝对路径
	 */
	public function uploadCode($url) {
		$dirPath = str_replace('\\', '/', dirname(dirname(dirname(__FILE__)))).'/yanzhengma/';
		$fileName = date('YmdHis', time()).rand(100, 999).'.jpg';
		
		$filePath = $dirPath.$fileName;
		
		$codeRes = $this->simpleGet($url);

		file_put_contents($filePath, $codeRes);
		chmod($filePath, 0777);
		
		return $filePath;
	}
	
	/**
	 * 获取验证码
	 * Enter description here ...
	 */
	public function getCode($code_url) {
		if(''==SERVER_URL) exit('server_url is empty!!');
		
		$filePath = $this->uploadCode($code_url);
		if(!file_exists($filePath)) exit('create code file error!!');
	
		$ch = curl_init(SERVER_URL);
    	
    	$data = array(
    		'user' => USER,
    		'pwd' => PWD,
    		'type' => CODE_TYPE,
    		'imagePath' => '@'.$filePath.';type=image/jpeg'
    	);
    	
    	if(empty($data['user']) || empty($data['pwd']) || empty($data['type'])) exit('param error!!');
  	
    	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    	
    	curl_setopt($ch, CURLOPT_POST, 1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
  
    	$output = curl_exec($ch);
    	curl_close($ch);
 	
    	unlink($filePath);
//edump($output);
    	return $output;
	}
}

/* 范例 */
//$curlObj = new GetcodeCurl();
//$code = $curlObj->getCode('https://pin.aliyun.com/get_img?sessionid=3c889c5d9a06f8a9b41c3611d86c44bb&identity=taobao.login&type=150_40');

//echo $code;



















