<?php

error_reporting(0);
include('getDevice.php');


?>

<?php

include('getDevices.php');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Dashboard</title>
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

<style>

 

.container {
  width: 100%;
  margin: 5px auto;
  align:left;
}
.container2 {
  width: 100%;
  margin: 5px auto;
  align:right;
}

</style>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="blue">
            <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
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
                        <a class="navbar-brand" href="#">Dashboard</a>
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
                    <div class="col-lg-8">
                        <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Info</h5>
                                <h4 class="card-title">Device Data</h4>
                                <div class="dropdown">
                                    <img src="../assets/img/gps.png"> 
                                   
                                </div>
                            </div>
                            <div class="card-body">
							 <div class="imei" font size="10">
							 <p style="font-size: 120%"><img src="../assets/img/imei.png" > <b> Mac </b> <span style="margin-right=200px"> <?php echo $mac ?> </span>   </p>								
							</div>
                             <div class="imei">
							 <p style="font-size: 120%"><img src="../assets/img/thermometer.png" >  <b> Temperature (°C) </b> <span style="margin-right=200px"> <?php echo $temp ?> </span>   </p>								
							</div>
							 <div class="speed">
							 <p style="font-size: 120%"> <img src="../assets/img/humidity.png">  <b> Humidity (%) </b> <?php echo $humidity ?></p>														
							</div>
							<div class="battery">
							<!--<p><img src="../assets/img/battery.png">Battery Level  <?php echo "87"?> </p>-->							
							</div>
							<div class="time">
							<!--<p><img src="../assets/img/icons8-watch-64.png">Last Updated Time </p>-->											
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
                  <div class="col-md-6">
                    <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Graph</h5>
                                <h4 class="card-title">Graph Data</h4>
                                <div class="dropdown">
                                <img src="../assets/img/stats.png"> 
                                       
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height:600px">
                                  <div class="container" >
									  <div align="left">
										<canvas  id="line-chart" width="100" height="50"></canvas>
									  </div>
									</div>
                                </div>
                            </div>
							
							
							
							
                            <div class="card-footer" >
                                <p> &copy;  Ideamart </p>
                            </div>
                        </div>
                  </div>
				  
				  
				    <div class="col-md-6">
                    <div class="card card-chart">
                            <div class="card-header">
                                <h5 class="card-category">Graph</h5>
                                <h4 class="card-title">Graph Data</h4>
                                <div class="dropdown">
                                <img src="../assets/img/stats.png"> 
                                       
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="chart-area" style="height:600px">
                                  <div class="container2" >
									  <div align="right">
										<canvas  id="line" width="100" height="50"></canvas>
									  </div>
									</div>
                                </div>
                            </div>
							
							
							
							
                            <div class="card-footer" >
                                <p> &copy;  Ideamart </p>
                            </div>
                        </div>
                  </div>

                </div>
				
				
            </div>
            <footer class="footer">
                <div class="container-fluid">
                  <p> &copy;  Ideamart </p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>

<script>


new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
    labels: [1,2,3,4,5,6,7,8,9,10],
    datasets: [{ 
        data: [<?php echo $tempe0 ?>, <?php echo $tempe1 ?>, <?php echo $tempe2 ?> , <?php echo $tempe3 ?>, <?php echo $tempe4 ?>, <?php echo $tempe5 ?> , <?php echo $tempe6 ?>, <?php echo $tempe7 ?>, <?php echo $tempe8 ?> , <?php echo $tempe9 ?>],
        label: "Temperature",
        borderColor: "#3e95cd",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'X Axis - Event : Y Axis - Temperature'
    }
  }
});


</script>



<script>

new Chart(document.getElementById("line"), {
  type: 'line',
  data: {
    labels: [1,2,3,4,5,6,7,8,9,10],
    datasets: [{ 
        data: [<?php echo $hum0 ?>, <?php echo $hum1 ?> , <?php echo $hum2 ?> , <?php echo $hum3 ?>, <?php echo $hum4 ?>, <?php echo $hum5 ?> , <?php echo $hum6 ?>, <?php echo $hum7 ?>, <?php echo $hum8 ?> , <?php echo $hum9 ?>,],
        label: "Humidity",
        borderColor: "#8e5ea2",
        fill: false
      }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'X Axis - Event : Y Axis - Humidity'
    }
  }
});


</script>



<script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/js/demos.js
        demo.initDashboardPageCharts();
    });
</script>

</html>
