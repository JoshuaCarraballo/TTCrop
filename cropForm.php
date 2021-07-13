<?php
session_start();
$currCompany = $_SESSION['currCompany'];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Something posted
    if (isset($_POST['btnSubmit'])) {
        $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
        $varientName = $_POST["cropName"];
        $varientQuantity = $_POST["cropQuantity"];
        $maturityTime = $_POST["maturity"];
        $soilPreperation = $_POST["soilPreparation"];
        $wateringDetails = $_POST["wateringDetails"];
        $fertilizerDetails = $_POST["fertDetails"];
        $pesiticideDetails = $_POST["pestDetails"];
        $knownPests = $_POST["knownPests"];
        $knownDiseases = $_POST["knownDiseases"];
    
        $sql = "INSERT INTO cropVarients(varientName, varientQuantity, maturityTime, soilPreperation, wateringDetails, fertilizerDetails, pesiticideDetails, knownPests, knownDiseases, companyID) 
        VALUES ('$varientName', '$varientQuantity', '$maturityTime', '$soilPreperation', '$wateringDetails', '$fertilizerDetails', '$pesiticideDetails', '$knownPests', '$knownDiseases','$currCompany')";
        $result = mysqli_query($connect,$sql);
        mysqli_close($connect);
        header("location: viewCropList.php");
    } 
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>New Crop</title>
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
            
            <h2 class="dash-title">New Crop Form</h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php" style="color:#FBBC05;">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="viewCropList.php" style="color:#FBBC05;">View Crop List</a></li>
    <li class="breadcrumb-item active" aria-current="page">New Crop Form</li>
  </ol>
</nav>



<form class="form-control" method="POST" name="cropForm">
<div class="form-group">
    <label for="cropName">Crop Name *</label>
    <input type="text" class="form-control" maxlength="20" id="cropName" name="cropName" placeholder="Scorpion Pepper" required>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="cropQuantity">Seeds/Grains/Buds/etc. In Stock *</label>
      <input type="number" class="form-control" id="cropQuantity" maxlength="30" name="cropQuantity" placeholder="120" required>
    </div>
    <div class="form-group col-md-6">
      <label for="maturity">Average Maturity Time (Days) *</label>
      <input type="number" class="form-control" id="maturity" maxlength="30" name="maturity" placeholder="50" required>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="soilPreparation">Soil Preparation</label>
    <textarea class="form-control" id="soilPreparation" maxlength="500" name="soilPreparation" rows="4" placeholder="Add organic matter each year during soil preparation to build and maintain the soil."></textarea>
    </div>
    <div class="form-group col-md-6">
      <label for="wateringDetails">Watering Details</label>
      <textarea class="form-control" id="wateringDetails" maxlength="500" name="wateringDetails" rows="4" placeholder="Supply moderate but almost constant water, especially during hot weather. Unless there is regular rainfall."></textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="fertDetails">Fertilizer Details</label>
    <textarea class="form-control" id="fertDetails" maxlength="500" name="fertDetails" rows="4" placeholder="Immediately after planting, apply 5g (1 tsp) of a specified fertilizer to each plant to encourage root growth. Be sure to place this fertilizer at least 5cm (2 in) away from the plant."></textarea>
    </div>
    <div class="form-group col-md-6">
      <label for="pestDetails">Pesticide Details</label>
      <textarea class="form-control" id="pestDetails" maxlength="500" name="pestDetails" rows="4" placeholder="Spray as close to the target as possible, you want to get good coverage, while still preventing drift."></textarea>
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
    <label for="knownPests">Known Pests</label>
    <input type="text" class="form-control" id="knownPests" maxlength="300" name="knownPests" placeholder="Armyworms, Caterpillars, Slugs, etc.">
    </div>
    <div class="form-group col-md-6">
      <label for="knownDiseases">Known Diseases</label>
      <input type="text" class="form-control" id="knownDiseases" maxlength="300" name="knownDiseases" placeholder="Fusarium wilt, Grey mould, Downy mildew, etc.">
    </div>
  </div>
  <br>
  <label style="font-size: 15px; color:#FBBC05;">Fields marked with an * are mandatory</label><br>
  <button type="submit" name="btnSubmit" class="btn btn-warning">Submit</button>
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