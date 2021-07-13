<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM field WHERE fieldID=$id";
    $query = "DELETE FROM plot WHERE fieldID=$id";

    $queryAllPlots= "SELECT * FROM plot WHERE fieldID=$id";
    $resultAllPlots = mysqli_query($connect, $queryAllPlots);

        while($row1= mysqli_fetch_array($resultAllPlots)){
            $queryPlanted = "DELETE FROM plantedPlot WHERE plotID = $row1[0]";
            $connect->query($queryPlanted);
        }
        
        if($connect->query($query) === TRUE){
            if($connect->query($sql) === TRUE){
                echo "<script> location.href='viewFields.php'; </script>";
                echo "Deleted the data";
            }
            else{
                echo "<script> location.href='viewFields.php'; alert('Error Deleting Field Table')</script>";
            }
        }
        else{
            echo "<script> location.href='viewFields.php'; alert('Error Deleting Field Child Classes')</script>";
        } 
    
}
else{
    die("ID Not provided");
}

?>