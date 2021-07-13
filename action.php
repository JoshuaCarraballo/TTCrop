<?php

    session_start();
    $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
    if(isset($_POST["username"])){
        $sql = "SELECT loginID,farmerID,username,password,role,companyID FROM logindetails WHERE username = '".$_POST["username"]."' AND password = '".$_POST["password"]."'";
        $result = mysqli_query($connect,$sql);
        $row = mysqli_fetch_array($result);
        //$count = mysqli_num_rows($result);

        if(mysqli_num_rows($result)>0) {
            $farmerID = $row['farmerID'];
            $query="SELECT farmerID, farmerName, governmentID, governmentIDType, farmerGender, farmerDOB, farmerAddress,companyID FROM farmer WHERE farmerID = '$farmerID'";
            $resultFarmer = mysqli_query($connect, $query);
            $rowFarmer = mysqli_fetch_array($resultFarmer, MYSQLI_ASSOC); 
           
            $_SESSION['login_user'] = $rowFarmer['farmerName'];
            $_SESSION['currFarmerID'] = $farmerID;
            $_SESSION['userRole'] = $row['role'];
            $_SESSION['currCompany'] = $rowFarmer['companyID']; 
   
            if($row['role'] == "Farm Owner"){
               echo 'Farm Owner';
            }
            else if($row['role'] == "Manager"){
                echo 'Manager';
            }
            else{
                echo 'Regular Employee';
            } 
            
         }
         else {
           echo 'No';
         }
    }

?>