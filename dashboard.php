<?php
session_start();
error_reporting(0);
include('includes/dbconnection.php');
error_reporting(0);
if (strlen($_SESSION['vpmsaid']==0)) {
  header('location:logout.php');
  } else{ ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VPS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
        <?php
		$page="dashboard";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Dashboard</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header"><?php include 'includes/greetings.php'?></h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div class="row">
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-teal panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-car color-blue"></em>
							<div class="large"><?php include 'counters/parking-count.php'?></div>
							<div class="text-muted">Total Vehicles Parked</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-blue panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-toggle-on color-orange"></em>
							<div class="large"><?php include 'counters/invehicles-count.php'?></div>
							<div class="text-muted">Vehicles IN</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-orange panel-widget border-right">
						<div class="row no-padding"><em class="fa fa-xl fa-toggle-off color-teal"></em>
							<div class="large"><?php include 'counters/outvehicles-count.php'?></div>
							<div class="text-muted">Vehicles OUT</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
					<div class="panel panel-red panel-widget ">
						<div class="row no-padding"><em class="fa fa-xl fa-clock-o color-red"></em>
							<div class="large"><?php include 'counters/current-parkingCount.php'?></div>
							<div class="text-muted">Parking Done within 24 hrs</div>
						</div>
					</div>
				</div>
			</div><!--/.row-->
		</div>

		
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Highlights - IN | OUT 
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="myChart" height="160" ></canvas>

						</div>

					</div>
				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Highlights - Vehicle Category
						
						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em class="fa fa-toggle-up"></em></span></div>
						<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="chart" id="myChart2" height="160" ></canvas>

						</div>

					</div>
				</div>
			</div>
		</div> <!-- /.row -->
		
		<?php 

			include 'includes/dbconn.php';

			$ret=mysqli_query($con,"SELECT count(ID) id1 from vehicle_info where Status=''");
			$row5=mysqli_fetch_array($ret);
			
			$ret=mysqli_query($con,"SELECT count(ID) id2 from vehicle_info where Status='Out'");
			$row6=mysqli_fetch_array($ret);

			$ret=mysqli_query($con,"SELECT count(ID) as id1 from vehicle_info where VehicleCategory='Bike'");
			$row=mysqli_fetch_array($ret);  
				
			$ret=mysqli_query($con,"SELECT count(ID) as id2 from vehicle_info where VehicleCategory='Motor'");
			$row2=mysqli_fetch_array($ret); 

			$ret=mysqli_query($con,"SELECT count(ID) as id4 from vehicle_info where VehicleCategory='Car'");
			$row4=mysqli_fetch_array($ret);
			
			$ret=mysqli_query($con,"SELECT count(ID) as id7 from vehicle_info where VehicleCategory='E-bike'");
			$row7=mysqli_fetch_array($ret);
			
		?>
		<hr>
		<div class="text-primary text-center font-weight-bold bg-success">
			<h1>AVAILABLE PARK AREA</h1>
		</div>
		<div class="panel panel-container">
			<?php $query=mysqli_query($con,"select * from slotinfo where status='available'");
				while($row=mysqli_fetch_array($query))
				{
			?>    
			<div class="col-xs-6 col-md-3 col-lg-3 no-padding">
				<div class="panel panel-orange panel-widget border-right">
					<div class="row no-padding">
						<div class="large">
						<div class="text-secondary"><?php echo $row['areaName'];?></div>
							<a href="manage-vehicles.php? entryid=<?php echo $row['slotid']; ?>">
								<img src="assets/icons/car_ava.png" alt="" style="height: 140px; width: auto;">
							</a>
						</div>
						<div class="text-secondary"><?php echo $row['slotid'];?></div>
					</div>
				</div>
			</div>
			<?php } ?>
		</div>
	
		
		
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js'></script>
	
	<script>
		window.onload = function () {
	// var chart1 = document.getElementById("line-chart").getContext("2d");
	// window.myLine = new Chart(chart1).Line(lineChartData, {
	// responsive: true,
	// scaleLineColor: "rgba(0,0,0,.2)",
	// scaleGridLineColor: "rgba(0,0,0,.05)",
	// scaleFontColor: "#c5c7cc"
	// });

	var ctx = document.getElementById("myChart").getContext('2d');
	var myChart = new Chart(ctx, {
	type: 'pie',
	data: {
	labels: ["Vehicle In-Time","Vehicle Out-Time"],
	datasets: [{
	backgroundColor: ["#30a5ff","#33cccc"],
	data: [<?php echo $row5['id1']; ?>,<?php echo $row6['id2']; ?>]
	}]
	}
	});

	var ctx = document.getElementById("myChart2").getContext('2d');
	var myChart = new Chart(ctx, {
	type: 'pie',
	data: {
	labels: [
	"Bike","E-bike","Motor", "Car"
	],
	datasets: [{
	backgroundColor: ["#f55d42","#f5c542", "#6b6b6b", "#355E3B"],
	data: [<?php echo $row['id1']; ?>,
		   <?php echo $row2['id2']; ?>,
		   <?php echo $row4['id4']; ?>,
		   <?php echo $row7['id7']; ?>
		   
		]
	}]
	}
	});


	};

	

	


	</script>

		
</body>
</html>

<?php } ?>