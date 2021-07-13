<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql5 = "DELETE FROM farmer WHERE farmerID=$id ";
    $query="DELETE FROM logindetails WHERE farmerID=$id";
    $queryAlerts = "DELETE FROM alerts WHERE farmerID=$id";

    $errorCheck = "SELECT * FROM plantedplot WHERE farmerID=$id";
    $resultError = mysqli_query($connect, $errorCheck);
    if(mysqli_num_rows($resultError)>0) {
        echo "<script> location.href='viewFarmers.php'; alert('Cannot Delete A Farmer Who Is Responsible For Growing Crops')</script>";
    }
    else{
        if($connect->query($query) === TRUE){
            if($connect->query($queryAlerts) === TRUE){
                if($connect->query($sql5) === TRUE){
                    echo "<script> location.href='viewFarmers.php'; </script>";
                    echo "Deleted the data";
                }
                else{
                    echo "<script> location.href='viewFarmers.php'; alert('Error Deleting Farmer')</script>";
                }
            }
            else{
                echo "<script> location.href='viewFarmers.php'; alert('Error Deleting Farmer Child Classes (Alerts)')</script>";
            }
        }
        else{
            echo "<script> location.href='viewFarmers.php'; alert('Error Deleting Farmer Child Classes')</script>";
        }
    }
}
else{
    die("ID Not provided");
}

?>

