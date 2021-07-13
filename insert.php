<?php
session_start();
$farmerID = $_SESSION['currFarmerID'];
$farmerName = $_SESSION['login_user'];
$currCompany = $_SESSION['currCompany'];
//insert.php
date_default_timezone_set("Brazil/West");
if(isset($_POST["subject"]))
{
 $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
 $subject = mysqli_real_escape_string($connect, $_POST["subject"]);
 $description = mysqli_real_escape_string($connect, $_POST["description"]);
 $date = date("d/m/Y");
 $time = date("h:i:s A");
 $query = "
 INSERT INTO alerts(alertDescription, alertDate, alertTime, alertStatus, alertSubject, farmerID, farmerName, companyID)
 VALUES ('$description', '$date', '$time',0, '$subject', '$farmerID', '$farmerName','$currCompany')
 ";
 mysqli_query($connect, $query);
}
?>