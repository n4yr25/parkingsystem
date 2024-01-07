<?php
// getParkingSlots.php
include('includes/dbconnection.php');

if (isset($_POST['areaCode'])) {
    $areaCode = $_POST['areaCode'];
    $query = mysqli_query($con, "SELECT * FROM slotinfo WHERE areaCode = '$areaCode'");
    while ($row = mysqli_fetch_array($query)) {
        ?>
        <div class="parkmap col-xs-6 col-md-2 col-lg-2 no-padding">
            <hr>
            <div class="panel panel-orange panel-widget border-right border-top border-left">
                <div class="row no-padding">
                    <div class="large">
                        <div class="text-secondary"><h5><?php echo $row['areaName']; ?></h5></div>
                        <?php if ($row['status'] == 'reserved') { ?>
                            <a href="manage-vehicles.php? entryid=<?php echo $row['slotid']; ?>">
                                <img src="assets/icons/car_occ.png" alt="" style="height: 80px; width: auto;">
                            </a>
                        <?php } else { ?>
                            <a href="manage-vehicles.php? entryid=<?php echo $row['slotid']; ?>">
                                <img src="assets/icons/car_ava.png" alt="" style="height: 80px; width: auto;">
                            </a>
                        <?php } ?>
                    </div>
                    <div class="text-light"><h3 class="slottext"><?php echo $row['slotid']; ?></h3></div>
                </div>
            </div>
            <br><br><br>
        </div>
<?php
    }
}
?>
