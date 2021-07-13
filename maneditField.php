<?php
session_start();
$currCompany = $_SESSION['currCompany'];
    if(!isset($_GET['id'])){
        die('ID not provided');
    }

    $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
    $id = $_GET['id'];
    $sql = "SELECT * FROM field where fieldId=$id";
    $result = $connect->query($sql);
    if($result->num_rows != 1){
        die('ID is invalid');
    }

    $row = $result->fetch_array();
    $fieldName = $row['fieldName'];
    $tempField =  $row['fieldName'];
    $fieldAdd = $row['fieldAddress'];
    $fieldCap = $row['fieldMaxCapacity'];
    $fieldSize = $row['fieldSize'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Something posted

        if (isset($_POST['btnUpdate'])) {
            $fieldName = $_POST["fieldName"];
            $updateName = $_POST["fieldName"];
            $fieldSize = $_POST["fieldSize"];
            $fieldAdd = $_POST["fieldAddress"];
            $maxCap = $_POST["maxCapacity"];
            $sql1= "UPDATE field SET fieldName='$fieldName', fieldAddress='$fieldAdd', fieldMaxCapacity='$maxCap', fieldSize='$fieldSize'
            WHERE fieldID = '$id' ";
            $result1 = mysqli_query($connect,$sql1);

            $updatePlot = "UPDATE plot SET fieldName='$updateName' WHERE fieldName='$tempField' AND companyID='$currCompany'";
            $resultPlot = mysqli_query($connect,$updatePlot);

            $updateHarvest = "UPDATE harvested SET fieldName='$updateName' WHERE fieldName='$tempField' AND companyID='$currCompany'";
            $resultHarvest = mysqli_query($connect,$updateHarvest);
            header("location: manviewFields.php");

            
            
        } 
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Edit Field</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <script type="text/javascript" src="js/myScript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link type='text/css' rel='stylesheet' href="css/appStyle.css">/>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
</head>
<body>
    <input type="checkbox" id="sidebar-toggle">
    <div class="sidebar">
        <div class="sidebar-header">
            <h3 class="brand">
                <span class="fas fa-leaf"></span> 
                <span>TTCrop</span>
            </h3> 
            <label for="sidebar-toggle" class="ti-menu-alt"></label>
        </div>
        
        <div class="sidebar-menu">
            <ul>
            <li>
                    <a href="mandashboard.php">
                        <span class="ti-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="manviewFields.php">
                        <span class="ti-layout-width-default"></span>
                        <span>Fields</span>
                    </a>
                </li>
                <li>
                    <a href="manviewPlots.php">
                        <span class="ti-layout-grid3"></span>
                        <span>Plots</span>
                    </a>
                </li>
                <li>
                    <a href="manviewPlanted.php">
                        <span class="ti-paint-bucket"></span>
                        <span>Growing Crops</span>
                    </a>
                </li>
                <li>
                    <a href="manviewCropList.php">
                        <span class="ti-view-list-alt"></span>
                        <span>Crop List</span>
                    </a>
                </li>
                <li>
                    <a href="manviewHarvested.php">
                        <span class="ti-hand-stop"></span>
                        <span>Past Harvests</span>
                    </a>
                </li>
                <li>
                    <a href="manweather.php">
                        <span class="ti-shine"></span>
                        <span>Weather</span>
                    </a>
                </li>
                <li>
                    <a href="manalerts.php">
                        <span class="ti-bell"></span>
                        <span>Alerts</span>
                    </a>
                </li>
                <li>
                    <a href="mananalytics.php">
                        <span class="ti-bar-chart-alt"></span>
                        <span>Farm Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="mancalculate.php">
                        <span class="ti-stats-up"></span>
                        <span>Profitability Calc</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    
    
    <div class="main-content">
        
    <header>
            <div class="search-wrapper">
            </div>
            
            <div class="social-icons">
            
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                <a href="" class="dropdown-toggle" style="text-decoration:none; color:black;" data-toggle="dropdown"><span class="ti-bell" style="font-size: 20px; color:black;"></span><span class="label label-pill label-danger count" style="border-radius:10px;"></span> <span class="glyphicon glyphicon-envelope" style="font-size:18px; color:black;"></span></a>
                <ul class="dropdown-menu" style=" width: 350px; padding-left:10px; margin-top:19px;"></ul>
                </li>
            </ul>
            <a href="#" onclick="logoutVerify()" style="text-decoration: none; color:black;"><span class="ti-shift-left" style="font-size: 30px;"></span></a>
            </div>
            
        </header>
        
        <main>
            
            <h2 class="dash-title">Edit Field</h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="mandashboard.php" style="color:#FBBC05;">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="manviewFields.php" style="color:#FBBC05;">View Fields</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Field</li>
  </ol>
</nav>



<form class="form-control" method="POST" name="fieldForm">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="fieldName">Field Name *</label>
      <input type="text" class="form-control" id="fieldName" name="fieldName" required value="<?php echo $fieldName; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="fieldSize">Field Size (Acreage) *</label>
      <input type="text" class="form-control" id="fieldSize" name="fieldSize" required value="<?php echo $fieldSize; ?>">
    </div>
  </div>
  <div class="form-group">
    <label for="fieldAddress">Field Address *</label>
    <input type="text" class="form-control" id="fieldAddress" name="fieldAddress" required value="<?php echo $fieldAdd; ?>">
  </div>
  <div class="form-group">
    <label for="maxCapacity">Max Number of Plots Field Can Hold</label>
    <input type="text" class="form-control" id="maxCapacity" name="maxCapacity" value="<?php echo $fieldCap; ?>">
  </div><br>
  <label style="font-size: 15px; color:#FBBC05;">Fields marked with an * are mandatory</label><br>
  <button type="submit" name="btnUpdate" class="btn btn-warning">Update</button>
</form>
            
            
        </main>
        
    </div>

</body>
</html>

<script>

$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.dropdown-menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification();
 
 $('#alertForm').on('submit', function(event){
  event.preventDefault();
  if($('#subject').val() != '' && $('#description').val() != '')
  {
   var form_data = $(this).serialize();
   $.ajax({
    url:"insert.php",
    method:"POST",
    data:form_data,
    success:function(data)
    {
     $('#(')[0].reset();
     load_unseen_notification();
    }
   });
  }
  else
  {
   alert("Both Fields are Mandatory");
  }
 });
 
 $(document).on('click', '.dropdown-toggle', function(){
  $('.count').html('');
  load_unseen_notification('yes');
 });
 
 setInterval(function(){ 
  load_unseen_notification();; 
 }, 5000);
 
});
</script>
