<?php

$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE FROM logindetails WHERE loginID=$id ";

    if($connect->query($sql) === TRUE){
        echo "<script> location.href='viewLogins.php'; </script>";
        echo "Deleted the data";
    }
    else{
        echo "<script> location.href='viewPlots.php'; alert('Error Deleting Login')</script>";
    }
}
else{
    die("ID Not provided");
}

?>