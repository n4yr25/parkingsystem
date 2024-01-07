<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    if (strlen($_SESSION['vpmsaid']==0)) {
        header('location:logout.php');
        } else {
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>VPS</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/datatable.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="reports";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">View Report</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">Parking Reports</div>
						<?php
						
						$query = "SELECT YEAR(InTime) AS Year, MONTH(InTime) AS Month,
              SUM(CASE WHEN VehicleCategory = 'Bike' THEN 1 ELSE 0 END) AS BikeCount,
              SUM(CASE WHEN VehicleCategory = 'Motor' THEN 1 ELSE 0 END) AS MotorCount,
              SUM(CASE WHEN VehicleCategory = 'Car' THEN 1 ELSE 0 END) AS CarCount,
              SUM(CASE WHEN VehicleCategory = 'E-bike' THEN 1 ELSE 0 END) AS EBikeCount
              FROM vehicle_info 
              GROUP BY YEAR(InTime), MONTH(InTime) 
              ORDER BY YEAR(InTime), MONTH(InTime)";

    $result = mysqli_query($con, $query);

    $labels = [];
    $bikeCounts = [];
    $motorCounts = [];
    $carCounts = [];
    $eBikeCounts = [];

    while ($row = mysqli_fetch_assoc($result)) {
        $labels[] = $row['Year'] . '-' . $row['Month']; // Format: YYYY-MM
        $bikeCounts[] = $row['BikeCount'];
        $motorCounts[] = $row['MotorCount'];
        $carCounts[] = $row['CarCount'];
        $eBikeCounts[] = $row['EBikeCount'];
    }

    // Converting PHP arrays to JavaScript arrays
    $labelsJSON = json_encode($labels);
    $bikeCountsJSON = json_encode($bikeCounts);
    $motorCountsJSON = json_encode($motorCounts);
    $carCountsJSON = json_encode($carCounts);
    $eBikeCountsJSON = json_encode($eBikeCounts);
						?>
						<div class="panel-body">
							<center><h1>Parking Costumer's Graph</h1></center>
							<div class="graph">
								<canvas id="bar-chart" width="800" height="400"></canvas>
							</div>
						</div>

                        <form method="POST" enctype="multipart/form-data" name="datereports" action="generate-reports.php">

                            <div class="panel-body">
            
                                <?php if($msg)
                                echo "<div class='alert bg-danger' role='alert'>
                                <em class='fa fa-lg fa-warning'>&nbsp;</em> 
                                $msg
                                <a href='#' class='pull-right'>
                                <em class='fa fa-lg fa-close'>
                                </em></a></div>" ?> 

                                    <div class="form-group">
                                        
                                        <div class="col-lg-6">
                                        <label for="">From</label>
                                            <input class="form-control" type="date" name="fromdate" id="fromdate" required="true">
                                        </div>

                                    
                                        <div class="col-lg-6">
                                        <label for="">To</label>
                                            <input class="form-control" type="date" name="todate" id="todate" required="true">
                                        </div>
                                        
                                        
                                    </div>    
                                    
                                </div>
                                    <center><button type="submit" class="btn btn-primary" name="submit">Generate Report</button></center>
                        
                        </form>
					</div>
				</div>
				
				
				
</div><!--/.row-->
<script>
    var labels = <?php echo $labelsJSON; ?>;
    var bikeCounts = <?php echo $bikeCountsJSON; ?>;
    var motorCounts = <?php echo $motorCountsJSON; ?>;
    var carCounts = <?php echo $carCountsJSON; ?>;
    var eBikeCounts = <?php echo $eBikeCountsJSON; ?>;

    var ctx = document.getElementById('bar-chart').getContext('2d');
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Bike',
                    data: bikeCounts,
                    backgroundColor: 'rgba(255, 99, 132, 0.5)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Motor',
                    data: motorCounts,
                    backgroundColor: 'rgba(54, 162, 235, 0.5)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Car',
                    data: carCounts,
                    backgroundColor: 'rgba(75, 192, 192, 0.5)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'E-bike',
                    data: eBikeCounts,
                    backgroundColor: 'rgba(255, 206, 86, 0.5)',
                    borderColor: 'rgba(255, 206, 86, 1)',
                    borderWidth: 1
                }
            ]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>
		
		

        <?php include 'includes/footer.php'?>
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/jquery.dataTables.min.js"></script>
    <script src="js/dataTables.bootstrap4.min.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
	<script>
		window.onload = function () {
		var chart1 = document.getElementById("line-chart").getContext("2d");
		window.myLine = new Chart(chart1).Line(lineChartData, {
		responsive: true,
		scaleLineColor: "rgba(0,0,0,.2)",
		scaleGridLineColor: "rgba(0,0,0,.05)",
		scaleFontColor: "#c5c7cc"
		});
};
	</script>

    <script>
        $(document).ready(function() {
    $('#example').DataTable();
} );
    </script>
		
</body>
</html>

<?php }  ?>