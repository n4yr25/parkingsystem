<?php
	include 'dbconn.php';
	$id = $_SESSION['vpmsaid'];
	$sql = "select * from admin where ID='$id'";
	$result = mysqli_query($con, $sql);
	
?>
<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
		<div class="profile-sidebar">
			<div class="profile-userpic">
				<img src="https://www.w3schools.com/howto/img_avatar.png" width="50" class="img-responsive" alt="Icon">
			</div>
			<div class="profile-usertitle">
				<div class="profile-usertitle-name">
					<?php
					if($result->num_rows == 1) {
						$user = $result->fetch_assoc();
						echo $user['UserName'];
					?>
					
				</div>
				<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
			</div>
			<div class="clear"></div>
		</div>
		<div class="divider"></div>

		<form role="search" action="search-results.php" name="search" method="POST" enctype="multipart/form-data">

			<!--  -->

			<div class="form-group">
				<input type="text" class="form-control" id="searchdata" name="searchdata" placeholder="Search Vehicle-Reg">
			</div>

		</form>
		<ul class="nav menu">

			<?php
				if($user['AdminName'] == "Administrator") {
			?>
			<li class="<?php if($page=="dashboard") {echo "active";}?>"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="<?php if($page=="vehicle-category") {echo "active";}?>"><a href="vehicle-category.php"><em class="fa fa-th-large">&nbsp;</em> Vehicle Category</a></li>
			<li class="<?php if($page=="manage-vehicles") {echo "active";}?>"><a href="manage-vehicles.php"><em class="fa fa-car">&nbsp;</em> Vehicle Entry</a></li>
			<li class="<?php if($page=="in-vehicle") {echo "active";}?>"><a href="in-vehicles.php"><em class="fa fa-toggle-on">&nbsp;</em> IN Vehicles</a></li>
            <li class="<?php if($page=="out-vehicle") {echo "active";}?>"><a href="out-vehicles.php"><em class="fa fa-toggle-off">&nbsp;</em> OUT Vehicles</a></li>
            <li class="<?php if($page=="manage-area") {echo "active";}?>"><a href="manage-area.php"><em class="fa fa-car">&nbsp;</em> Manage Park Area</a></li>
			<li class="<?php if($page=="reports") {echo "active";}?>"><a href="reports.php"><em class="fa fa-file">&nbsp;</em> View Reports</a></li>
			<!-- <li class="<?php if($page=="about") {echo "active";}?>"><a href="about.php"><em class="fa fa-info">&nbsp;</em> About Page</a></li> -->
			<li class="<?php if($page=="income") {echo "active";}?>"><a href="total-income.php"><em class="fa fa-dollar">&nbsp;</em> Total Income</a></li>
			<?php
				}else if($user['AdminName'] == "Staff") {
			?>
				<li class="<?php if($page=="dashboard") {echo "active";}?>"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="<?php if($page=="vehicle-category") {echo "active";}?>"><a href="vehicle-category.php"><em class="fa fa-th-large">&nbsp;</em> Vehicle Category</a></li>
			<li class="<?php if($page=="manage-vehicles") {echo "active";}?>"><a href="manage-vehicles.php"><em class="fa fa-car">&nbsp;</em> Vehicle Entry</a></li>
			<li class="<?php if($page=="in-vehicle") {echo "active";}?>"><a href="in-vehicles.php"><em class="fa fa-toggle-on">&nbsp;</em> IN Vehicles</a></li>
            <li class="<?php if($page=="out-vehicle") {echo "active";}?>"><a href="out-vehicles.php"><em class="fa fa-toggle-off">&nbsp;</em> OUT Vehicles</a></li>
            <li class="<?php if($page=="manage-area") {echo "active";}?>"><a href="manage-area.php"><em class="fa fa-car">&nbsp;</em> Manage Park Area</a></li>
			<li class="<?php if($page=="reports") {echo "active";}?>"><a href="reports.php"><em class="fa fa-file">&nbsp;</em> View Reports</a></li>
			<!-- <li class="<?php if($page=="about") {echo "active";}?>"><a href="about.php"><em class="fa fa-info">&nbsp;</em> About Page</a></li> -->
			<!-- <li class="<?php if($page=="income") {echo "active";}?>"><a href="total-income.php"><em class="fa fa-dollar">&nbsp;</em> Total Income</a></li> -->

			<?php
				} else {
			?>
			<li class="<?php if($page=="dashboard") {echo "active";}?>"><a href="dashboard.php"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a></li>
			<li class="<?php if($page=="manage-vehicles") {echo "active";}?>"><a href="manage-vehicles.php"><em class="fa fa-car">&nbsp;</em> Vehicle Entry</a></li>

			<?php
				}
			?>
		</ul>
		
	</div>/.sidebar
	<?php
		}
	?>