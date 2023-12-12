<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    require_once 'payment/paycon.php';
    $name = $_GET['paidid'];
    if (strlen($_SESSION['vpmsaid']) == 0) {
        header('location:logout.php');
    } 
    else {
        if (isset($_POST['payment'])) {
            // Update the charge status in the database
            $sql = "UPDATE vehicle_info SET chargeStatus='Paid' WHERE OwnerName='$name'";
            if ($conn->query($sql) === TRUE) {
                echo "Data saved successfully";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
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
    <script src="https://www.paypal.com/sdk/js?client-id=AWBOH5Pw_cAca0XqQsImWkK65DYRZnxcg4yoXkFlZZBTyaMZuWHj6kVxCIl3PTfkthDFsVcgWiXi6akW"></script>
    <!-- Custom Font -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
</head>
<body>
    <?php include 'includes/navigation.php' ?>
    
    <?php
        $page = "manage-vehicles";
        include 'includes/sidebar.php';
    ?>
    
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="dashboard.php">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Manage Vehicle/Payment/<?php echo $name; ?></li>
            </ol>
        </div><!--/.row-->
        <form method="POST">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Charge <?php echo $currency.$itemprice; ?> with PayPal</h3>
                
                <!-- Product Info -->
                <p><b>Item Name:</b> <?php echo $itemname; ?></p>
                <p><b>Price:</b> <?php echo '$'.$itemprice.' '.$currency; ?></p>
            </div>
            <div class="panel-body">
                <!-- Display status message -->
                <div id="paymentResponse" class="hidden"></div>
                
                <!-- Set up a container element for the button -->
            
                <div id="paypal-button-container"></div>
                
                
                <!-- Add an overlay element -->
                <div class="overlay hidden">
                    <div class="overlay-content">
                        <img src="css/loading.gif" alt="Processing...">
                    </div>
                </div>
                </form>
            </div>
			<button type="submit" class="btn btn-danger">
                <a href="dashboard.php">Skip for now</a>
            </button>

        </div>
    </div>  <!--/.main-->

    <script>
        window.paypal.Buttons({
            createOrder: function(data, actions) {
                console.log('Data :' + data);
                console.log('Actions :' + actions);
                return actions.order.create({
                    purchase_units:[{
                        amount: {
                            value: '20'
                        }
                    }]
                })
            },
            onApprove: function(data, actions) {
                console.log('Data :' + data);
                console.log('Actions :' + actions);
                return actions.order.capture().then(
                    function(details) {
                        sendDataToServer(details.payer.name.given_name, details.payer.name.surname, details.status);
                    }
                )
            },

        }
        ).render('#paypal-button-container');

        function sendDataToServer(givenName, surname, status) {
            // Make an AJAX request to the PHP file to save data to the database
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        console.log('Data saved successfully');
                    } else {
                        console.error('Error saving data: ' + xhr.status);
                    }
                }
            };

            // Replace 'save_data_to_database.php' with the actual path to your PHP file
            xhr.open('POST', 'save_data_to_database.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.send('given_name=' + encodeURIComponent(givenName) + '&surname=' + encodeURIComponent(surname) + '&status=' + encodeURIComponent(status));
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

<?php 
} 
?>
