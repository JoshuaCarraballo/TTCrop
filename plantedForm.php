<?php
session_start();
$currCompany = $_SESSION['currCompany'];
$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
$plotID = $_GET['id'];

//Checking if plot is in use
$queryCheck = "SELECT * FROM plot WHERE plotID='$plotID'";
$resultCheck = mysqli_query($connect, $queryCheck);
$rowCheck = mysqli_fetch_array($resultCheck);
if($rowCheck['plotInUse'] === 'Yes' || $rowCheck['soilPreparation'] === 'No'){
  echo "<script>alert('This Plot Is Currently Unavailable For Planting!');location.href='viewPlots.php'</script>"; 
} 

$query = "SELECT * FROM plot WHERE plotID='$plotID'";
$resultPName = mysqli_query($connect,$query);
$rowPName = mysqli_fetch_array($resultPName);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
    if (isset($_POST['btnSubmit'])) {
    $plotName = $_POST["plotName"];
    $cropName = $_POST["cropName"];
    $numberOfCrops = $_POST["numberOfCrops"];
    $plantedDate = $_POST["plantedDate"];
    $plantedLastFertilized = $_POST["plantedLastFertilized"];
    $lastPesticide = $_POST["lastPesticide"];
    $lastWatered = $_POST["lastWatered"];
    $miscDetals = $_POST["miscDetals"];
    $farmerID = $_SESSION['currFarmerID'];
    $farmerName = $_SESSION['login_user'];


    $queryCropID = "SELECT varientID FROM `cropvarients` WHERE varientName='$cropName'";
    $resultCropID = mysqli_query($connect,$queryCropID);
    $rowCropID = mysqli_fetch_row($resultCropID);
    $cropID = $rowCropID[0];

    $sql = "INSERT INTO plantedplot(plotID, varientID, farmerID, numberOfCrops, plantedDate, plantedLastFertilized, lastPesticide, lastWatered, miscDetals, companyID) 
    VALUES ('$plotID', '$cropID', '$farmerID', '$numberOfCrops', '$plantedDate', '$plantedLastFertilized', '$lastPesticide', '$lastWatered', '$miscDetals','$currCompany')";
    if($connect->query($sql) === TRUE){
      $queryPlot = "UPDATE plot SET plotInUse='Yes' WHERE plotID='$plotID'";
      if($connect->query($queryPlot) === TRUE){
      mysqli_close($connect);
      header("location: viewPlanted.php");
      }
      else{
        echo "<script> location.href='viewPlots.php'; alert('Error Logging The Record')</script>";
      }  
    }
    else{
      die(mysqli_error($connect));
    }  



    } 
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Plant Plot</title>
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
                    <a href="dashboard.php">
                        <span class="ti-home"></span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="viewFields.php">
                        <span class="ti-layout-width-default"></span>
                        <span>Fields</span>
                    </a>
                </li>
                <li>
                    <a href="viewPlots.php">
                        <span class="ti-layout-grid3"></span>
                        <span>Plots</span>
                    </a>
                </li>
                <li>
                    <a href="viewPlanted.php">
                        <span class="ti-paint-bucket"></span>
                        <span>Growing Crops</span>
                    </a>
                </li>
                <li>
                    <a href="viewCropList.php">
                        <span class="ti-view-list-alt"></span>
                        <span>Crop List</span>
                    </a>
                </li>
                <li>
                    <a href="viewHarvested.php">
                        <span class="ti-hand-stop"></span>
                        <span>Past Harvests</span>
                    </a>
                </li>
                <li>
                    <a href="weather.php">
                        <span class="ti-shine"></span>
                        <span>Weather</span>
                    </a>
                </li>
                <li>
                    <a href="alerts.php">
                        <span class="ti-bell"></span>
                        <span>Alerts</span>
                    </a>
                </li>
                <li>
                    <a href="analytics.php">
                        <span class="ti-bar-chart-alt"></span>
                        <span>Farm Analytics</span>
                    </a>
                </li>
                <li>
                    <a href="calculate.php">
                        <span class="ti-stats-up"></span>
                        <span>Profitability Calc</span>
                    </a>
                </li>
                <li>
                    <a href="viewFarmers.php">
                        <span class="ti-user"></span>
                        <span>Farmers</span>
                    </a>
                </li>
                <li>
                    <a href="viewLogins.php">
                        <span class="ti-settings"></span>
                        <span>User Accounts</span>
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
            
            <h2 class="dash-title">Plant Plot Form</h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php" style="color:#FBBC05;">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="viewPlots.php" style="color:#FBBC05;">View Plots</a></li>
    <li class="breadcrumb-item active" aria-current="page">Plant Plot Form</li>
  </ol>
</nav>



<form class="form-control" method="POST" name="plantedForm">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="farmerName">Planted By</label>
      <input type="text" class="form-control" id="farmerName" name="farmerName" readonly value="<?php echo $_SESSION['login_user']; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="plotName">Plot Name</label>
      <input type="text" class="form-control" id="plotName" name="plotName" readonly value="<?php echo $rowPName['plotName']; ?>">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="cropName">Crop Planted *</label>
      <select class="form-control" name="cropName">
        <option>Select A Crop</option>
        <?php
          $queryCrop = "SELECT * FROM cropvarients WHERE companyID='$currCompany'";
          $resultCrop = mysqli_query($connect,$queryCrop);
          while($rowCrop = mysqli_fetch_array($resultCrop)){
          echo '<option>'.$rowCrop['varientName'].'</option>';
          }
        ?>
      </select>
  </div>
  <div class="form-group col-md-6">
      <label for="numberOfCrops">Estimate/Number of Seeds/Buds/Grains/etc. Planted *</label>
      <input type="number" class="form-control" id="numberOfCrops" name="numberOfCrops" placeholder="75" required>
    </div>
  </div>
  <div class="form-row">
    
    <div class="form-group col-md-6">
      <label for="plantedDate">Date Planted *</label>
      <input type="date" class="form-control datepicker" id="plantedDate"  name="plantedDate" required>
    </div>
    <div class="form-group col-md-6">
      <label for="plantedLastFertilized">Date Last Fertilized</label>
      <input type="date" class="form-control" id="plantedLastFertilized"  name="plantedLastFertilized">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="lastPesticide">Date Pesticide Last Applied</label>
      <input type="date" class="form-control" id="lastPesticide"  name="lastPesticide">
    </div>
    <div class="form-group col-md-6">
      <label for="lastWatered">Date Last Watered</label>
      <input type="date" class="form-control" id="lastWatered"  name="lastWatered">
    </div>
  </div>
  <div class="form-group">
      <label for="miscDetals">Miscellaneous Details</label>
      <textarea type="text" class="form-control" id="miscDetals" maxlength="50" name="miscDetals" rows="3"></textarea>
  </div>
  <label style="font-size: 15px; color:#FBBC05;">Fields marked with an * are mandatory</label><br>
  <button type="submit" name="btnSubmit" class="btn btn-warning" onclick="return plantedValidate()">Submit</button>
</form>
            
            
        </main>
        
    </div>

</body>
</html>
<script>
    function plantedValidate() {
      var sn = document.forms["plantedForm"]["cropName"].value;
      if (sn == "Select A Crop") {
      alert("Please Select A Crop");
      return false;
      }
    }
</script>

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