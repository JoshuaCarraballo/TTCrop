<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM plot WHERE plotID=$id ";
    $queryPlanted = "DELETE FROM plantedplot WHERE plotID=$id";

    if($connect->query($queryPlanted) === TRUE){
        if($connect->query($sql) === TRUE){
            echo "<script> location.href='manviewPlots.php'; </script>";
            echo "Deleted the data";
        }
        else{
            echo "<script> location.href='manviewPlots.php'; alert('Error Deleting Plots')</script>";
        }
    }
    else{
        echo "<script> location.href='manviewPlots.php'; alert('Error Deleting Plot Child Classes')</script>";
    }
}
else{
    die("ID Not provided");
}

?>