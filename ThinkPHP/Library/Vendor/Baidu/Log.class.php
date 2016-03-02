<?php
namespace Vendor\Baidu;

class Log {

	private $_logFilePath = '';
	private $_rootPath = '';
	
	public function __construct() {
		$this->_rootPath = str_replace('\\', '/', dirname(__FILE__));
	}
	
	public function writeLog($data, $fileName='') {
		if(empty($fileName)) $fileName = date('Ymd', time()).'.txt';
		
		$this->_logFilePath = $this->_rootPath.'/loginLog/'.$fileName;

		file_put_contents($this->_logFilePath, $data."\n", FILE_APPEND);
	}
	
	public function createLogStr($str) {
		return date('Y-m-d H:i:s', time()).'->'.$str.';';
	}
}