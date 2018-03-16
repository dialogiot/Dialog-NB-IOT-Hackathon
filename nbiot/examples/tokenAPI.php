<?php
ini_set("log_errors", "1");
ini_set("error_log", "err.txt");
ini_set("display_errors", "1");

include "curl.php";
$refreshURL = "https://iotdev.dialog.lk/axt-iot-mbil-instance0001001/apkios/axtitomblebckenddev/generate/iotmifetokenviatoken";
$loginURL = "https://iotdev.dialog.lk/axt-iot-mbil-instance0001001/apkios/axtitomblebckenddev/proxy/authenticate";
$deviceURL = "https://iotdev.dialog.lk/axt-iot-mbil-instance0001001/apkios/axtitomblebckenddev/iotadmindev/device?user_id=";
if (isset($_GET['method'])) {

    $method = $_GET['method'];

    $in = file_get_contents('php://input');

    if(strlen($in) <5)
        die;
    $input = json_decode($in);
    $p = file_get_contents("conf.json");
    $conf = json_decode($p);

    $result = array("status" => "", "message" => "");

    if ($method == "refresh") {
        $conf->consumerKey = $input->consumerKey;
        $conf->refreshToken = $input->refreshToken;
        if ($input->consumerSecret != null && strlen($input->consumerSecret > 5))
            $conf->consumerSecret = $input->consumerSecret;

        file_put_contents("conf.json", json_encode($conf, JSON_PRETTY_PRINT));

        $mifeToken = base64_encode($conf->consumerKey . ":" . $conf->consumerSecret);
		print_r($mifeToken);
		print_r($conf->refreshToken);
        $a = getHTTP($refreshURL, "", "POST", null, array("IotMife-RefreshToken: " . $conf->refreshToken, "IotMife-Token: " . $mifeToken, "Content-Type: application/x-www-form-urlencoded"), null, true);
        
        if ($a['statusCode'] == 200) {
            $res = json_decode($a['body']);
			
            $conf->accessToken = $res->access_token;
            $conf->refreshToken = $res->refresh_token;
            $result['message'] = "Token Updated";
            $result['status'] = "OK";
            file_put_contents("conf.json", json_encode($conf, JSON_PRETTY_PRINT));

        } else {
            $result['message'] = "Error refresh token";
            $result['status'] = "ERROR";
        }


    } else if ($method == "login") {
        $conf->userName = $input->userName;
        $conf->accessToken = $input->accessToken;
        if ($input->password != null && strlen($input->password) > 2)
            $conf->password = $input->password;

        file_put_contents("conf.json", json_encode($conf, JSON_PRETTY_PRINT));

        $j = array("user_name" => $conf->userName, "password" => $conf->password);
        $a = getHTTP($loginURL, json_encode($j), "POST", null, array("IotMife-AccessToken: " . $conf->accessToken, "Content-Type: application/json"), null, true);
        //echo var_dump($a);
        if ($a['statusCode'] == 200) {
            $res = json_decode($a['body']);
            if ($res->auth == true) {
                $conf->userToken = $res->token;
                $conf->userId = $res->data->user_id;
                $result['message'] = "User Updated";
                $result['status'] = "OK";
                file_put_contents("conf.json", json_encode($conf, JSON_PRETTY_PRINT));
            } else {
                $result['message'] = "Error login user";
                $result['status'] = "ERROR";
            }


        } else {
            $result['message'] = "Error login user";
            $result['status'] = "ERROR";
        }


    } else if ($method == "getDevice") {


        $a = getHTTP($deviceURL.$conf->userId, null, "GET", null, array("IotMife-AccessToken: " . $conf->accessToken, "X-Key: " . $conf->userToken, "Content-Type: application/json"), null, true);
        //echo var_dump($a);
        if ($a['statusCode'] == 200) {
            $res = json_decode($a['body']);
            $result['data'] = $res;
            $result['message'] = "User Updated";
            $result['status'] = "OK";
        } else {
            $result['message'] = "Error getting device";
            $result['status'] = "ERROR";
        }


    }else if ($method == "saveDevice") {

        $conf->deviceId = $input->deviceId;
        file_put_contents("conf.json", json_encode($conf, JSON_PRETTY_PRINT));
        $result['message'] = "Device saved";
        $result['status'] = "OK";

    }

    echo json_encode($result);
}


?>