<?php
    session_start();
    error_reporting(0);
    include('includes/dbconn.php');
    require_once 'payment/paycon.php';

    if (strlen($_SESSION['vpmsaid']) == 0) {
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
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
    <script src="https://www.paypal.com/sdk/js?client-id=<?php echo PAYPAL_SANDBOX ? PAYPAL_SANDBOX_CLIENT_ID : PAYPAL_PROD_CLIENT_ID; ?>&currency=<?php echo $currency; ?>"></script>
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
                <li class="active">Manage Vehicle/Payment</li>
            </ol>
        </div><!--/.row-->

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
            </div>
        </div>
    </div>  <!--/.main-->
    
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

<?php } ?>
