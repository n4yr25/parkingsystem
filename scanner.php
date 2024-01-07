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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
        <?php include 'includes/navigation.php' ?>
	
		<?php
		$page="scanner";
		include 'includes/sidebar.php'
		?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="dashboard.php">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">QR Code Scanner</li>
			</ol>
		</div><!--/.row-->
		
		<div class="row">
				<div class="col-lg-12">
					<div class="panel panel-default">
						<div class="panel-heading">QR Code Scanner</div>
                        <div class="panel-body">
                            <center><h2>Place your QR Image in the Camera</h2></center>
                            <video id="preview" width="100" height="300"></video>
                            <h3 id="scannedData" hidden></h3>
                        </div>   
					</div>
				</div>
            </div><!--/.row-->
		</div>
	</div>	<!--/.main-->

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

        scanner.addListener('scan', function (content) {
            document.getElementById('scannedData').innerText = 'Scanned: \n' + content;

            Swal.fire({
                icon: 'success',
                title: 'Scan Successful!',
                text: 'Scanned Data: ' + content,
                confirmButtonText: 'OK'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Make an AJAX call to update the database
                    let xhr = new XMLHttpRequest();
                    xhr.onreadystatechange = function () {
                        if (xhr.readyState === XMLHttpRequest.DONE) {
                            if (xhr.status === 200) {
                                // Handle the response if needed
                                console.log(xhr.responseText);
                            } else {
                                // Handle errors if any
                                console.error('Error: ' + xhr.status);
                            }
                            setTimeout(function () {
                                window.location.reload();
                            }, 10000);
                        }
                    };
                    xhr.open('POST', 'update_entry_time.php');
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.send('name=' + name); // Send the scanned content to the PHP script
                }
            });
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
                alert('No cameras found.');
            }
        }).catch(function (e) {
            console.error(e);
            alert(e);
        });
    });
</script>
		
</body>
</html>

<?php }  ?>