<?php
function va($value){
	echo "<pre>";
	var_dump($value);
	echo "</pre>";
	
}


function edump($value){
	exit(va($value));
	
}

function getIP() {
    if (getenv('HTTP_CLIENT_IP')) {
        $ip = getenv('HTTP_CLIENT_IP');
    }
    elseif (getenv('HTTP_X_FORWARDED_FOR')) {
        $ip = getenv('HTTP_X_FORWARDED_FOR');
    }
    elseif (getenv('HTTP_X_FORWARDED')) {
        $ip = getenv('HTTP_X_FORWARDED');
    }
    elseif (getenv('HTTP_FORWARDED_FOR')) {
        $ip = getenv('HTTP_FORWARDED_FOR');

    }
    elseif (getenv('HTTP_FORWARDED')) {
        $ip = getenv('HTTP_FORWARDED');
    }
    else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    return $ip;
}

function test_input($data)
{
	$data = trim($data);
	$data = stripslashes($data);
	$data = htmlspecialchars($data);
	return $data;
}

function getTree($data, $pid = 0, $key = 'id', $pKey = 'parentId', $childKey = 'child', $maxDepth = 0){
	static $depth = 0;
	$depth++;
	if (intval($maxDepth) <= 0)
	{
		$maxDepth = count($data) * count($data);
	}
	if ($depth > $maxDepth)
	{
		exit("error recursion:max recursion depth {$maxDepth}");
	}
	$tree = array();
	foreach ($data as $rk => $rv)
	{
		if ($rv[$pKey] == $pid)
		{
			$rv[$childKey] = getTree($data, $rv[$key], $key, $pKey, $childKey, $maxDepth);
			$tree[] = $rv;
		}
	}
	return $tree;
}