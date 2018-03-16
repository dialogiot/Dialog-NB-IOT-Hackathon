<?php

$p = file_get_contents("conf.json");
$data = json_decode($p);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Generate Tokens</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />

</head>

<body class="container">
 <div class="sidebar" data-color="blue">
    <div class="logo">
                <a href="" class="simple-text logo-normal"><center>
                    Dashboard
             </center> </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="active">
                        <a href="../examples/dashboard.php">
                            <i class="now-ui-icons design_app"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                 
                    <li>
                       <a href="../examples/token.php">
                            <i class="now-ui-icons loader_gear"></i>
                            <p>Generate API Tokens</p>
                        </a>
                    </li>
                                
                </ul>
            </div>
        </div>
</div>


<div style="margin-left:250px">
<h1 class="h3 mb-3 font-weight-normal">API Authentication</h1>
<label for="consumerKey" class="sr-only">Consumer Key</label>
<input type="text"  style ="margin-bottom:10px" id="consumerKey" class="form-control" placeholder="Consumer Key" required autofocus
       >
<label for="consumerSecret" class="sr-only">Consumer Secret</label>
<input type="password" style ="margin-bottom:10px" id="consumerSecret" class="form-control" placeholder="ConsumerSecret" required value="">
<label for="refreshToken" class="sr-only">Refresh Token</label>
<input type="text"  style ="margin-bottom:10px" id="refreshToken" class="form-control" placeholder="Refresh Token" required
       >
<br>
<div class="col-sm-4">
    <button command="right" class="btn btn-sm btn-primary btn-block remoteButton" id="btnright"
            onclick="refreshToken();">Refresh
    </button>
</div>
<br> <br>
<h1 class="h3 mb-3 font-weight-normal">User Authentication</h1>
<label for="accessToken" class="sr-only">Access Token</label>
<input type="text" style ="margin-bottom:10px"id="accessToken" class="form-control" placeholder="Access Token" required autofocus
       >


<label for="username" class="sr-only">User Name</label>
<input type="text" style ="margin-bottom:10px" id="username" class="form-control" placeholder="User Name" required
       >
<label for="password" class="sr-only">password</label>
<input type="password"  style ="margin-bottom:10px" id="password" class="form-control" placeholder="Password" required value="">
<label for="userToken" class="sr-only">User Token</label>
<input type="text" style ="margin-bottom:10px" id="userToken" class="form-control" placeholder="User Token" required
       >
<br>
<div class="col-sm-4">
    <button command="right" class="btn btn-sm btn-primary btn-block remoteButton" id="btnright" onclick="loginUser()">
        Login
    </button>
</div>
<br><br>
<h1 class="h3 mb-3 font-weight-normal">Device</h1>
<label for="userId" class="sr-only">UserId</label>
<input type="text"  style ="margin-bottom:10px" id="userId" class="form-control" placeholder="userId" required
       >
<label for="device" class="sr-only">Device</label>
<input type="text" style ="margin-bottom:10px" id="deviceId" class="form-control" placeholder="deviceId" required
       >
<select class="form-control" id="device" class="form-control" placeholder="">
</select>
<br>
<div class="col-sm-4">
    <button command="right" class="btn btn-sm btn-primary btn-block remoteButton" id="btnright" onclick="saveDevice();">Save Device</button>
    <button command="right" class="btn btn-sm btn-success btn-block remoteButton" id="btnright" onclick="getDevice();">Get Device</button>
</div>
<br><br><br><br>
<p> &copy;  Ideamart </p>
</div>
</body>
</html>

<script>
    function refreshToken() {
        var consumerKey = $("#consumerKey").val();
        var consumerSecret = $("#consumerSecret").val();
        var refreshToken = $("#refreshToken").val();

        var j = {
            consumerKey: consumerKey,
            consumerSecret: consumerSecret,
            refreshToken: refreshToken
        }

        $.ajax({
            dataType: 'json',
            url: "tokenAPI.php?method=refresh",
            type: "POST",
            data: JSON.stringify(j),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: successRefresh
        });

    }
    function loginUser() {
        var userName = $("#username").val();
        var password = $("#password").val();
        var accessToken = $("#accessToken").val();


        var j = {
            userName: userName,
            password: password,
            accessToken: accessToken
        }

        $.ajax({
            dataType: 'json',
            url: "tokenAPI.php?method=login",
            type: "POST",
            data: JSON.stringify(j),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: successRefresh
        });

    }
    function getDevice() {
        var userId = $("#userId").val();

        var j = {
            userId : userId
        }

        $.ajax({
            dataType: 'json',
            url: "tokenAPI.php?method=getDevice",
            type: "POST",
            data: JSON.stringify(j),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: loadDevice
        });

    }
    function saveDevice() {
        var deviceId = $("#deviceId").val();

        var j = {
            deviceId : deviceId
        }

        $.ajax({
            dataType: 'json',
            url: "tokenAPI.php?method=saveDevice",
            type: "POST",
            data: JSON.stringify(j),
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            success: loadDevice
        });

    }
    function successRefresh(data) {

        console.log(data);
        if (data.status == "OK") {
            alert(data.message);

        } else {
            alert(data.message);
        }
        location.reload();
    }
    function loadDevice(data) {

        console.log(data);
        if (data.status == "OK") {
            alert(data.message);
            var t = "";
            for(var x = 0; x< data.data.length; x++){
                if( $("#deviceId").val() ==  data.data[x].id)
                        t +='<option value="' + data.data[x].id + '" selected>' + data.data[x].id + " : " + data.data[x].name+ " [ " + data.data[x].brand + "|" + data.data[x].type  + '] ' + data.data[x].version + ' - ' + data.data[x].mac_address + '</option>';
                    else
                        t +='<option value="' + data.data[x].id + '">' + data.data[x].id + " : " + data.data[x].name+ " [ " + data.data[x].brand + "|" + data.data[x].type  + '] ' + data.data[x].version + ' - ' + data.data[x].mac_address + '</option>';

            }
            $("#device").empty();
            $("#device").append(t);

        } else {
            alert(data.message);
        }
    }
</script>
