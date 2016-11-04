<?php 
require 'src/Curl.php';
$urls = array(
'http://4.sendvid.com/01yn2x4c.mp4',
'http://4.sendvid.com/003b95dn.mp4',
);

$login = '';
$key = '';
//$folder = ''; //folderID
$curl = new Curl;
$curl->setUserAgent('Mozilla/5.0 (Macintosh; U; PPC Mac OS X Mach-O; fr; rv:1.7) Gecko/20040624 Firefox/0.9');
$curl->setOpt(CURLOPT_FOLLOWLOCATION, true);
	foreach ($urls as $url) {
		$uploadApi = "https://api.openload.co/1/remotedl/add?login=$login&key=$key&url=$url";
		//$cekfolderApi = "https://api.openload.co/1/file/listfolder?login=$login&key=$key"; // cek folder
		$curl->get($uploadApi);
		$id = $curl->response->result->id;
		sleep(10); //sik upload
		do{
			$cek = "https://api.openload.co/1/remotedl/status?login=$login&key=$key&limit=1&id=$id";
			$ceks = $curl->get($cek);
			//sleep(10);
		}while ($ceks->result->$id->url == false);
		echo $ceks->result->$id->url."\n";
	}

?>

