<?php
error_reporting(0);
include('getDevices.php');

?>

<?php

include('getDevice.php');

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>GPS Tracker</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/css/now-ui-dashboard.css?v=1.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="../assets/demo/demo.css" rel="stylesheet" />
	
	<style>


table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
	
}

td, th {
    border: 1px solid #dddddd;
    text-align: left;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
	
	
	
	</style>
	
	
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
            <div class="logo">
				<a href="" class="simple-text logo-normal"><center>
                    GPS Tracker
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
                        <a href="../examples/map.php">
                            <i class="now-ui-icons location_pin"></i>
                            <p>Location History</p>
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
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-transparent  navbar-absolute bg-primary fixed-top" >
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="#">Location History</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                       
                        <ul class="navbar-nav">
                           
                           
                            <li class="nav-item">
                                <a class="nav-link" href="#">
                                    <i class="now-ui-icons users_single-02"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Account</span>
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="panel-header panel-header-lg">
                
            </div>
            <div class="content">
                <div class="row">
                    <div class="col-lg-12">
                       <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Location</h5>
                                <h4 class="card-title">Last Known Location</h4>
                                <div class="dropdown">
                                <img src="../assets/img/maps-and-flags.png"> 
                                       
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height:300px">
                                   <div id="map" class="map" style="height:300px;margin-left:20px;margin-right:20px"></div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="now-ui-icons loader_refresh spin"></i> Updated
                                </div>
                            </div>
                        </div>
                    </div>
                   
                </div>
                <div class="row">
                  <div class="col-md-12">
                    <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">History</h5>
                                <h4 class="card-title">Location History</h4>
                                <div class="dropdown">
                                
								<div>
								
                                 <table align="left" >
								  <tr>
									<th>Latitude</th>
									<th>Longitude</th> 
									<th>Location Time</th>
								  </tr>
								  <tr>
									<td> <?php echo $lat0?></td>
									<td> <?php echo $long0?></td>
									<td><?php echo $long0?></td>
								  </tr>
								  <tr>
									<td><?php echo $long1?></td>
									<td><?php echo $long1?></td>
									<td><?php echo $long1?></td>
								  </tr>
								  <tr>
									<td><?php echo $long2?></td>
									<td><?php echo $long2?></td>
									<td><?php echo $long2?></td>
								  </tr>
								   <tr>
									<td>Eve</td>
									<td>Jackson</td>
									<td>94</td>
								  </tr>
								   <tr>
									<td>Eve</td>
									<td>Jackson</td>
									<td>94</td>
								  </tr>
								</table>      
                                   </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height:400px">
                                   <div id="map" style="width:90%;height:150px;margin-left:80px"></div>
									
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="stats">
                                    <i class="now-ui-icons arrows-1_refresh-69"></i> Updated
                                </div>
                            </div>
                        </div>
                  </div>

                </div>
            </div>
            <footer class="footer">
                <div class="container-fluid">
                  
                </div>
            </footer>
        </div>
    </div>
</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<!--  Google Maps Plugin    -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5qEiP5mbPB83pmOVnOKFjZp-jbtfAoxE"></script>
<!-- Chart JS -->
<script src="../assets/js/plugins/chartjs.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
<script src="../assets/js/now-ui-dashboard.js?v=1.0.1"></script>
<!-- Now Ui Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/demo/demo.js"></script>
<script>
    $(document).ready(function() {
        var lat = <?php echo $lat ?>;
		var long = <?php echo $long ?>;
        demo.initGoogleMaps(lat, long);
    });
</script>

</html>
