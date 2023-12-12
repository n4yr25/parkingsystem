<?php
	session_start();
	error_reporting(0);
	include('includes/dbconn.php');
	$entryid = $_GET['entryid'];
	if (strlen($_SESSION['vpmsaid']==0)) {
	header('location:logout.php');
	} else {

	if(isset($_POST['submit-vehicle'])) {
		$area=$_POST['area'];
		$slotid=$_POST['slotnum'];
		$catename=$_POST['catename'];
		$vehcomp=$_POST['vehcomp'];
		$vehreno=$_POST['vehreno'];
		$ownername=$_POST['ownername'];
		$ownercontno=$_POST['ownercontno'];
		$enteringtime=$_POST['enteringtime'];
			
		$query=mysqli_query($con, "INSERT into vehicle_info(area,slotid,VehicleCategory,VehicleCompanyname,RegistrationNumber,OwnerName,OwnerContactNumber,ParkingCharge) value('$area','$slotid','$catename','$vehcomp','$vehreno','$ownername','$ownercontno','25')");
		if ($query) {
			include('phpqrcode/qrlib.php');
			$qrCodeImagePath = 'qrcodes/' . $areaCode . '.png';
		
			$tempDir = "qrcodes/";
			
			$codeContents = "VEHICLE INFO\nName: $ownername\nVehicle Number: $vehreno\nPark Area: $area\nSlot Number: $slotid";
			
			// we need to generate filename somehow, 
			// with md5 or with database ID used to obtains $codeContents...
			$fileName = $ownername.'.png';
			
			$pngAbsoluteFilePath = $tempDir.$fileName;
			$urlRelativeFilePath = $tempDir.$fileName;
			
			// generating
			if (!file_exists($pngAbsoluteFilePath)) {
				QRcode::png($codeContents, $pngAbsoluteFilePath);
				echo 'File generated!';
				echo '<hr />';
			} else {
				echo 'File already generated! We can use this cached file to speed up site on common codes!';
				echo '<hr />';
			}

			mysqli_query($con,"UPDATE slotinfo SET status='reserved' where slotid='$slotid'");
			echo "<script>alert('Vehicle Entry Detail has been added');</script>";
			echo "<script>window.location.href ='payment.php'</script>";
			
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="manage-vehicles";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Manage Vehicle</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
			<div class="col-lg-12">
				<!-- <h1 class="page-header">Vehicle Management</h1> -->
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-default">
					<div class="panel-heading">Vehicle Entry</div>
					<div class="panel-body">

						<div class="col-md-12">
							<form method="POST">
								<div class="form-group">
									<label>Area</label>
									<select class="form-control" name="area" id="catename">
									<?php $query=mysqli_query($con,"select * from slotinfo where slotid='$entryid'");
									if(!empty($_GET['entryid'])){
										$row=mysqli_fetch_array($query);
										if($row>0){
									?>
                                    <option value="<?php echo $row['areaName'];?>"><?php echo $row['areaName'];?></option>
									<?php
										}
									}
									else {
										$query=mysqli_query($con,"select * from parkarea");
										echo "<option value='0'>Select Area</option>";
										while($row=mysqli_fetch_array($query))
										{
									?>    
                                    <option value="<?php echo $row['areaCode'];?>"><?php echo $row['areaCode'];?></option>
                  					<?php } } ?> 
									</select>
								</div>

								<div class="form-group">
									<label>Slot Number</label>
									<select class="form-control" name="slotnum" id="slotnum">
									<?php $query=mysqli_query($con,"select * from slotinfo where status='available'");
									if(!empty($_GET['entryid'])){
										echo "<option value='$entryid'>$entryid</option>";
									}
									else {
										echo "<option value='0'>Select Slot</option>";
										while($row=mysqli_fetch_array($query))
										{
										?>    
                                    <option value="<?php echo $row['slotid'];?>"><?php echo $row['slotid'];?></option>
                  					<?php } } ?> 
									</select>
								</div>
								<div class="form-group">
									<label>Registration Number</label>
									<input type="text" class="form-control" placeholder="LOL-1869" id="vehreno" name="vehreno">
								</div>


								<div class="form-group">
									<label>Vehicle's Brand</label>
									<input type="text" class="form-control" placeholder="Tesla" id="vehcomp" name="vehcomp" required>
								</div>
								
						
									<div class="form-group">
										<label>Vehicle Category</label>
										<select class="form-control" name="catename" id="catename">
										<option value="0">Select Category</option>
										<?php $query=mysqli_query($con,"select * from vcategory");
											while($row=mysqli_fetch_array($query))
											{
											?>    
                                        <option value="<?php echo $row['VehicleCat'];?>"><?php echo $row['VehicleCat'];?></option>
                  						<?php } ?> 
										</select>
									</div>
									

								<div class="form-group">
									<label>Owner's Full Name</label>
									<input type="text" class="form-control" placeholder="Enter Here.." id="ownername" name="ownername" required>
								</div>


								<div class="form-group">
									<label>Owner's Contact</label>
									<input type="text" class="form-control" placeholder="Enter Here.." maxlength="10" pattern="[0-9]+" id="ownercontno" name="ownercontno" required>
								</div>
								<!-- <div class="form-group">
									<label>Payment</label>
									<select name="payment" id="" class="form-control">
										<option>--Select Payment--</option>
										<option value="Manual">Manual Payment</option>
										<option value="G-Cash">G-Cash</option>
									</select>
								</div> -->

									<button type="submit" class="btn btn-success" name="submit-vehicle">Submit</button>
									<button type="reset" class="btn btn-default">Reset</button>
								</div> <!--  col-md-12 ends -->
							</form>
						</div> 
					</div>
        <?php 
		// echo "
		// <script>
		// 	Swal.fire({
		// 		title: 'QR Code Generated!',
		// 		imageUrl: '$urlRelativeFilePath/',
		// 		imageWidth: 200,
		// 		imageHeight: 200,
		// 		imageAlt: 'QR Code',
		// 		showCancelButton: true,
		// 		confirmButtonColor: '#3085d6',
		// 		cancelButtonColor: '#d33',
		// 		confirmButtonText: 'Download QR Code'
		// 	}).then((result) => {
		// 		if (result.isConfirmed) {
		// 			// Trigger download
		// 			var a = document.createElement('a');
		// 			a.href = '$filename';
		// 			a.download = 'qrcode.png';
		// 			a.click();
		// 		}
		// 	});
		// </script>";
		?>
	</div>	<!--/.main-->
	<script>
		function downloadQR(qrCodeImagePath) {
			Swal.fire({
				title: 'QR Code Generated!',
				text: 'Click the button to download the QR code.',
				icon: 'success',
				showCancelButton: true,
				confirmButtonText: 'Download',
				cancelButtonText: 'Close',
			}).then((result) => {
				if (result.isConfirmed) {
					// Redirect to the download_image.php script to download the QR code image
					window.location.href = 'download_image.php?imagePath=' + qrCodeImagePath;
				}
			});
		}
	</script>
	
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