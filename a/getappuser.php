<?php
// SE NAO ESTIVER COMENTADO NAO FUNCIONA
ini_set("log_errors", 1);
ini_set("error_log", "errorlog.txt");

// $ob_file = fopen('log.txt','w');

// function ob_file_callback($buffer)
// {
//   global $ob_file;
//   fwrite($ob_file,$buffer);
// }

// ob_start('ob_file_callback');

function decode($encoded) {
    $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
    
    $length = strlen($encoded);
    
    $pos1 = strpos($chars, $encoded[$length - 2]);
    $pos2 = strpos($chars, $encoded[$length - 1]);
    
    $decoded = substr($encoded, 0, $length - 2);
    
    $decoded = substr($decoded, 0, $pos1) . substr($decoded, $pos1 + $pos2);
    return base64_decode($decoded);
}

function trial($mac) {
    global $db2, $res;
    
    $res = $db2->query('SELECT * FROM ibo WHERE mac_address="'.$mac .'"');
	$count = 0;
	while ($row = $res->fetchArray()) {
	    $count++;
	}
	
	if ($count == 0){
	    $json ='{"receiveMessageAppId":"com.whatsapp","receiveMessagePattern":["*"],"senderName":"API DE CADASTRO","groupName":"","senderMesage":"api_cadastro","senderMessage":"api_cadastro","messageDateTime":'.time().',"isMessageFromGroup":false}';
	    
	    /*exemplo do retorno recebido*/
		/*$retorno = '{"data":[{"message":"xx-usuario-xx|xx-senha-xx"}]}';*/
	
		/*ENVIA O JSON PARA O SERVIDOR VIA POST*/
		/*
		*/
		/*url do servidor*/
		//$url_server = 'https://office2.cloudnation.vip/chatbot/check/?k=1eb4b60fb4';
// 		/*coloque a dns*/
 		//$dns = 'http://srv.cldplay.net:80';
        $url_server = file_get_contents("../app_url");
		/*coloque a dns*/
		$dns = file_get_contents("../app_dns");
		/*no servidor configure uma mensagem com o texto: api_cadastro
		/*e uma resposta assim: {USERNAME}|{PASSWORD}
		/*usando a barra vertical para separar o usuario da senha
		/*
		*/
		$ch = curl_init($url_server);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' . strlen($json))	
		);
		/**************************************/
		
		/*RECUPERA A RESPOSTA DO JSON ENVIADO*/
		$jsonRetorno = json_decode(curl_exec($ch), true);
		/****************************/
		
		/*VERIFICA SE OBTEVE UMA RESPOSTA VALIDA*/
		if(isset($jsonRetorno['data'][0]['message'])){
			$user_pass = explode("|", $jsonRetorno['data'][0]['message']);
			/*SEPARA USERNAME E PASSWORD*/
			if(isset($user_pass[0]) && isset($user_pass[1]) ){
				$username = $user_pass[0];
				$password = $user_pass[1];
				/*RECUPERA A DATA DO PRÓXIMO DIA*/
				$expire_date2 = date('Y-m-d', strtotime("+1 DAY"));
				/*monta a url da m3u*/
				$url = $dns."/get.php?username=".$username."&password=".$password."&type=m3u_plus&output=ts";
				
				/*CADASTRA O MAC COM O TESTE*/
				$db2->exec("INSERT INTO ibo (mac_address, username, password, expire_date, title, url) VALUES ('$mac', '$username', '$password', '$expire_date2', 'NOVO*** (TESTE CADASTRADO)', '$url' )");
			}else{
				
				$db2->exec("INSERT INTO ibo (mac_address, title) VALUES ('$mac', 'NOVO*** (SEM DNS, USUARIO E SENHA)' )");
				/*CADASTRA O MAC SEM O TESTE*/
				
				/***************/
				
			}
			/***************************/
			
			
			
		}else{
		    $db2->exec("INSERT INTO ibo (mac_address, title) VALUES ('$mac', '$username', 'NOVO*** (TESTE CADASTRADO)')");
		}
		/*API DE CADASTRO DE TESTE VIA JSON BY: XtremeApps 16 981019147*/
		/*******************************************************************/
	}
}

function defaultHandle($mac) {
    global $db2, $res;
    if(!isset($mac)) return;
    
    $res = $db2->query('SELECT * FROM ibo WHERE mac_address="'.$mac .'"');
	$count = 0;
	while ($row = $res->fetchArray()) {
	    $count++;
	}
    
    if ($count == 0) {
        $db2->exec("INSERT INTO ibo (mac_address, title, expire_date) VALUES ('$mac', 'NOVO*** (SEM DNS, USUARIO E SENHA)', '2050-01-01')");
    }
}


//$x = '{"data":"eyJhcHrBfZGV2aWNlX2lkIjoiWm1RMlpUSTFORGRqTkRsaU5XWmhPUT09IiwiYXBwX3R5cGUiOiJt\nb2JpbGUiLCJ2ZXJzaW9uIjoiMS4wIiwiaXNfcGFpZCI6ZmFsc2V9gb"}';
// $data = json_decode($x, true);
$data = json_decode(file_get_contents('php://input'), true);

if($data){
    $data = $data['data'];
    $data = json_decode(decode($data), true);
    $mac = base64_decode($data['app_device_id']);
    $mac = strtoupper($mac);
    $mac = preg_replace('~..(?!$)~', '\0:', str_replace(".", "", $mac));
}

$db1 = new SQLite3('./.eggziedb.db');
$res1 = $db1->query('SELECT * FROM theme');
while ($row1 = $res1->fetchArray()) {
	$themes[] = ['name'=>$row1['name'],'url'=>$row1['url']];
}

$themes = json_encode($themes);
$ibo_json = file_get_contents('./ibo.json');
$ibo_data = json_decode($ibo_json,true);

$app_info = $ibo_data['app_info'];
$android_version_code = $app_info['android_version_code'];
$apk_url = $app_info['apk_url'];
$db2 = new SQLite3('./.eggziedb.db');
$languages = file_get_contents('./language.json');
$notification = file_get_contents('./note.json');

if (isset($mac)) {
	$mode = file_get_contents('../trial_mode');
    if ($mode == 'trial'){
        trial($mac);
    } else {
        defaultHandle($mac);
    }
	
	while ($row = $res->fetchArray()) {
		$expire_date = $row['expire_date'];
	}
	if (empty($expire_date)) {
		$api = file_get_contents('./nr.json');
		if (isset($paths[0])) {
			$mac = strtoupper($paths[0]);
		} else {
			$mac = 'No Mac when page loaded';
		}
		$date = date('d-m-Y H:i:s');
		$db2 = new SQLite3('./catch.db');
		$db2->exec('CREATE TABLE IF NOT EXISTS catch(id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,device TEXT,date TEXT)');
		$db2->exec('INSERT INTO catch(device, date) VALUES(\''.$mac .'\', \''.$date .'\')');
	} else {
		$db3 = new SQLite3('./.eggziedb.db');
		$res3 = $db3->query('SELECT * FROM ibo WHERE mac_address="'.$mac .'"');
		while ($row3 = $res3->fetchArray()) {
		    $url = $row3['url'];
		    $username = $row3['username'];
		    $password = $row3['password'];
    
            if ($url) {
                $url .= "/get.php?username=" . $username . "&password=" . $password . "&type=m3u_plus&output=ts";
            }
		    
			$urls[] = ['is_protected'=>0,'id'=>md5($password .$row3['id']),'url'=>$url,'name'=>$row3['title'],'username'=>$username ,'password'=>$password,'epg_url'=>$row3['url'] .'/xmltv.php','pin'=>'0000','playlist_type'=>'xc'];
		}
		$urls = json_encode($urls);
		
		$api = '{
            "android_version_code": "2.9",
            "apk_url": "'.$apk_url .'",
            "mac_address" : "'. $mac . '",
            "device_key": "136115",
            "expire_date": "'.$expire_date .'",
            "is_google_paid": true,
            "is_trial": 0,
            "notification": ' . $notification . ',
            "urls": '.$urls .',
            "mac_registered": true,
            "trial_days": 7,
            "plan_id": "03370629",
            "pin": "0000",
            "price": "0",
            "app_version": "2.9",
            "apk_link": "",
            "themes":'.$themes .',
            "languages":'.$languages .'
		}
		';
	}
}else {
	$api = 'invalid';
}

$api = base64_encode($api) . "aa";
echo "{\"data\": \"$api\"}";

return;
?>
