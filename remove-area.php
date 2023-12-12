<?php


session_start();
error_reporting(0);


if(isset($_GET['editid'])){
$id=$_GET['editid'];

include('includes/dbconn.php');


$qry="DELETE from parkarea where areaid='$id'";
$result=mysqli_query($con,$qry);

if($result){
    header('Location:manage-area.php');
}else{
    echo"ERROR!!";
}
}
?>