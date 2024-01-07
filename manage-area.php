<?php
	session_start();
	error_reporting(0);
	include('includes/dbconn.php');
	if (strlen($_SESSION['vpmsaid']==0)) {
	header('location:logout.php');
	} else {

        if (isset($_POST['submit-vehicle'])) {
            $areaCode = $_POST['areaCode'];
            $areaDesc = $_POST['areaDesc'];
            $areaSlot = $_POST['numSlot'];
        
            $query = mysqli_query($con, "INSERT INTO parkarea(areaCode, areaDesc, areaSlots) VALUES ('$areaCode', '$areaDesc', '$areaSlot')");
            if ($query) {
                echo "<script>alert('Park Area has been added!');</script>";
				
        
                for ($i = 1; $i <= $areaSlot; $i++) {
                    $slotid = 'SLOT' . str_pad($i, 3, '0', STR_PAD_LEFT); // Generates slotid like SLOT001, SLOT002, ..., SLOT010
        
                    // SQL query to insert a row into the slotinfo table
                    $query = "INSERT INTO slotinfo (slotid, areaName, status) VALUES ('$slotid', '$areaCode', 'available')";
        
                    // Execute the query
                    $result = mysqli_query($con, $query);
        
                  
                }
            } else {
                echo "<script>alert('Something Went Wrong');</script>";
            }
        }
        
  ?>

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

</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="manage-area";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Manage Area</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-default">
					<div class="panel-heading">Manage Parking Area</div>
					<div class="panel-body">

						<div class="col-md-12">

							<form method="POST">

								<div class="form-group">
									<label>Park Area Code</label>
									<input type="text" class="form-control" placeholder="Park-A" id="vehreno" name="areaCode" required>
								</div>
                                
                                <div class="form-group">
									<label>Area Description</label>
									<input type="text" class="form-control" placeholder="Enter Here.." id="ownercontno" name="areaDesc" required>
								</div>

								<div class="form-group">
									<label>Number of Slots</label>
									<input type="number" class="form-control" id="vehcomp" name="numSlot" required>
								</div>
								<button type="submit" class="btn btn-success" name="submit-vehicle">Submit</button>
								<button type="reset" class="btn btn-default">Reset</button>
								</div> <!--  col-md-12 ends -->
							</form>
						</div> 
					</div>
                    <table id="example" class="table table-striped table-hover table-bordered" style="width:100%">
                        
        <thead>
            <tr>
                <th>#</th>
                <th>Park Area Code</th>
                <th>Description</th>
                <th>Number of Slots</th>
                <th>Actions</th>

            </tr>
        </thead>
        <tbody>
        <?php
        $ret=mysqli_query($con,"SELECT * from  parkarea");
        $cnt=1;
        while ($row=mysqli_fetch_array($ret)) {

        ?>
   
            <tr>

            <td><?php echo $cnt;?></td>
                 
            <td><?php  echo $row['areaCode'];?></td>

            <td><?php  echo $row['areaDesc'];?></td>
            <td><?php  echo $row['areaSlots'];?></td>
            
            <td><a href="update-area.php?editid=<?php echo $row['areaid'];?>"> <button class="btn btn-success btn-sm"><i class="fa fa-edit"></i></button> </a>
            <a href="remove-area.php?editid=<?php echo $row['areaid'];?>"> <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button> </a>
            </td>

            </tr>
                <?php $cnt=$cnt+1;}?>
        </tbody>

    </table>
	</div>	<!--/.main-->
	
	<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
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
		
</body>
</html>

<?php }  ?>