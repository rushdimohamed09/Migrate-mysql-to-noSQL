<?php
session_start();
include ("functions.php");

echo"<br>";
$lim_start=0;
$lim_end=100;
if(isset($_SESSION['lim_start']) && is_numeric($_SESSION['lim_start'])){
	$lim_start=$_SESSION['lim_start'];
}
if(select("rentals",$lim_start,$lim_end)!="no"){
	$_SESSION['lim_start']=$lim_start+$lim_end;
	echo "<script>setTimeout(function(){ window.location.reload(1);}, 1000);</script>";//refresh the page
	exit();
}else{
	echo "Successfully all the table data has been updated to json object !";
}
unset($_SESSION['lim_start']);
session_destroy();
?>