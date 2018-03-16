
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
//print_r($response);
$err = curl_error($curl);

curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
} else {
    $jd = json_decode($response, true);
	

$hum0 = $jd['response']['docs'][0]['humidity'];
$tempe0 = $jd['response']['docs'][0]['temperature'];

$hum1 = $jd['response']['docs'][3]['humidity'];
$tempe1 = $jd['response']['docs'][3]['temperature'];
	
$hum2 = $jd['response']['docs'][2]['humidity'];
$tempe2 = $jd['response']['docs'][2]['temperature'];	

$hum2 = $jd['response']['docs'][2]['humidity'];
$tempe2 = $jd['response']['docs'][2]['temperature'];

$hum3 = $jd['response']['docs'][3]['humidity'];
$tempe3 = $jd['response']['docs'][3]['temperature'];

$hum4 = $jd['response']['docs'][4]['humidity'];
$tempe4 = $jd['response']['docs'][4]['temperature'];

$hum5 = $jd['response']['docs'][4]['humidity'];
$tempe5 = $jd['response']['docs'][4]['temperature'];

$hum6 = $jd['response']['docs'][4]['humidity'];
$tempe6 = $jd['response']['docs'][4]['temperature'];

$hum7 = $jd['response']['docs'][4]['humidity'];
$tempe7 = $jd['response']['docs'][4]['temperature'];

$hum8 = $jd['response']['docs'][4]['humidity'];
$tempe8 = $jd['response']['docs'][4]['temperature'];

$hum9 = $jd['response']['docs'][4]['humidity'];
$tempe9 = $jd['response']['docs'][4]['temperature'];


}
?>