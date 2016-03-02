<?php
namespace Vendor\Baidu;

class CommonCurl {
	
	public function get($url, $cookie='', $refer='https://www.baidu.com') {
		$ch = curl_init($url);
		
//		curl_setopt ($ch, CURLOPT_HEADER, 1); //显示请求头信息
		
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
		
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1); //不可删除
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie);
		
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4");
		curl_setopt($ch, CURLOPT_REFERER, $refer);
		
		$output = curl_exec($ch);	
		curl_close($ch);
		
		return $output;
	}
	
	public function curl_get($url, $cookie='', $istamll=false) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
	
		if($istamll) curl_setopt($curl, CURLOPT_FOLLOWLOCATION,1);
		
		curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
		
		curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4");
		curl_setopt($curl, CURLOPT_REFERER, $url);
		
		$output = curl_exec($curl);
		curl_close($curl);
		
		return $output;
	}
	
	public function post($url, $params, $cookie, $refer='https://www.baidu.com') {
		$curl = curl_init($url);
		
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
		
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
		
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); //不可删除
		
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($params));
        
        curl_setopt($curl, CURLOPT_COOKIEJAR, $cookie);
        curl_setopt($curl, CURLOPT_COOKIEFILE, $cookie);
        
        curl_setopt($curl, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.4 (KHTML, like Gecko) Chrome/22.0.1229.94 Safari/537.4");
        curl_setopt($curl, CURLOPT_REFERER, $refer);
        
        $result = curl_exec($curl);
        curl_close($curl);
  
        return $result;
	}
	


}






