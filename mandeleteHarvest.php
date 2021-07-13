<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM harvested WHERE harvestID=$id ";

    if($connect->query($sql) === TRUE){
        
        echo "<script> location.href='manviewHarvested.php'; </script>";
        
    }
    else{
        echo "<script> location.href='manviewPlanted.php'; alert('Error Deleting Growing Crop')</script>";
    }
}
else{
    die("ID Not provided");
}

?>