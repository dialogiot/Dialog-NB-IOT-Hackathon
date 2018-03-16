<?php

$p = file_get_contents("conf.json");
$json = json_decode($p, true);

$curl = curl_init();

$bodyJson = '{ "mac_address":"MAC","eventName":"EVENTNAME", "noOfEvents":NUMBEROFEVENTS}';

curl_setopt_array($curl, array(
    CURLOPT_URL => "https://iot.dialog.lk/expand_iot/solarservice/getDataByCount",
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_CUSTOMREQUEST => "POST",
	CURLOPT_POSTFIELDS => $bodyJson,
    CURLOPT_HTTPHEADER => array(
        "accept: application/json",
        "content-type: application/json",
        "IotMife-AccessToken:".$json["accessToken"],
        "X-Key:".$json["userToken"]
        
    ),
));

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $jd = json_decode($response, true);
	
	
	if($jd['response']['docs'][0]['humidity'] != null){
		$humidity = $jd['response']['docs'][0]['humidity'];
		
	}
	
	if($jd['response']['docs'][0]['temperature'] != null){
		$temp = $jd['response']['docs'][0]['temperature'];
	}

	
	if($long = $jd['response']['docs'][0]['mac_s'] != null){		
		$mac = $jd['response']['docs'][0]['mac_s'];
	}

}
?>