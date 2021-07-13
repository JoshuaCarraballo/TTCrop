<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM plantedplot WHERE plantedPlotID=$id ";
    $queryGetPID = "SELECT plotID FROM plantedplot WHERE plantedPlotID=$id";
    $resultGetPID = mysqli_query($connect,$queryGetPID);
    $rowGetPID = mysqli_fetch_row($resultGetPID);

    $querySetPlot = "UPDATE plot SET plotInUse='No' WHERE plotID='$rowGetPID[0]'";

    if($connect->query($sql) === TRUE){
        if($connect->query($querySetPlot) === TRUE){
            echo "<script> location.href='manviewPlanted.php'; </script>";
        } 
        else{
            die(mysqli_error($connect));
        }
    }
    else{
        echo "<script> location.href='manviewPlanted.php'; alert('Error Deleting Growing Crop')</script>";
    }
}
else{
    die("ID Not provided");
}

?>