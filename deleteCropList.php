<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM cropVarients WHERE varientID=$id ";

    $query="DELETE FROM plantedplot WHERE varientID=$id";

    $errorCheck = "SELECT * FROM plantedplot WHERE varientID=$id";
    $resultError = mysqli_query($connect, $errorCheck);
    if(mysqli_num_rows($resultError)>0) {
        echo "<script> location.href='viewCropList.php'; alert('Cannot Delete A Crop That Is Currently Planted. Please Delete Planted Record First')</script>";
    }
    else{
        if($connect->query($query) === TRUE){
            if($connect->query($sql) === TRUE){
                echo "<script> location.href='viewCropList.php'; </script>";
                echo "Deleted the data";
            }
            else{
                echo "<script> location.href='viewCropList.php'; alert('Error Deleting Crop')</script>";
            }
        }
        else{
            echo "<script> location.href='viewCropList.php'; alert('Error Deleting Records of This Crop In Plots')</script>";
        }
    }
    
}
else{
    die("ID Not provided");
}

?>