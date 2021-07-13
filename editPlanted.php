<?php
    session_start();
    $currCompany = $_SESSION['currCompany'];
    if(!isset($_GET['id'])){
        die('ID not provided');
    }

    $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
    $id = $_GET['id'];
    $sql = "SELECT * FROM plantedplot where plantedplotID=$id";
    $result = $connect->query($sql);
    if($result->num_rows != 1){
        die('ID is invalid');
    }

    $row = $result->fetch_array();
    $plotID = $row['plotID'];
    $varientID = $row['varientID'];
    $farmerID = $row['farmerID'];
    $numberOfCrops = $row['numberOfCrops'];
    $plantedDate = $row['plantedDate'];
    $plantedLastFertilized = $row['plantedLastFertilized'];
    $lastPesticide = $row['lastPesticide'];
    $lastWatered = $row['lastWatered'];
    $miscDetals = $row['miscDetals'];

    $queryFarmerName = "SELECT farmerName FROM FARMER WHERE farmerID= $farmerID";
    $resultFarmerName = mysqli_query($connect, $queryFarmerName);
    $rowFarmerName = mysqli_fetch_row($resultFarmerName);

    $queryPlotName = "SELECT plotName FROM plot WHERE plotID=$plotID";
    $resultPlotName = mysqli_query($connect, $queryPlotName);
    $rowPlotName = mysqli_fetch_row($resultPlotName);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Something posted
    
        if (isset($_POST['btnUpdate'])) {
          $cropName = $_POST['cropName'];
          $numberOfCrops = $_POST['numberOfCrops'];
          $plantedDate = $_POST['plantedDate'];
          $plantedLastFertilized = $_POST['plantedLastFertilized'];
          $lastPesticide = $_POST['lastPesticide'];
          $lastWatered = $_POST['lastWatered'];
          $miscDetals = $_POST['miscDetals'];

          $queryGetPlant = "SELECT * FROM cropvarients WHERE varientName='$_POST[cropName]'";
          $resultGetPlant = mysqli_query($connect, $queryGetPlant) or die( mysqli_error($connect));;
          $rowGetPlant = mysqli_fetch_array($resultGetPlant, MYSQLI_ASSOC);
          $varientID = $rowGetPlant['varientID'];
            $sql1= "UPDATE plantedplot SET varientID='$varientID', numberOfCrops='$numberOfCrops', plantedDate='$plantedDate', plantedLastFertilized='$plantedLastFertilized', lastPesticide='$lastPesticide', lastWatered='$lastWatered', miscDetals='$miscDetals'
            WHERE plantedPlotID = '$id' ";
            $result1 = mysqli_query($connect,$sql1);
            header("location: viewPlanted.php");
        } 
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Edit Growing Crop</title>
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
            
            <h2 class="dash-title">Edit Growing Crop</h2>

<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="dashboard.php" style="color:#FBBC05;">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="viewPlanted.php" style="color:#FBBC05;">View Growing Crops</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Growing Crops</li>
  </ol>
</nav>



<form class="form-control" method="POST" name="editPlantedForm">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="farmerName">Planted By Farmer</label>
      <input type="text" class="form-control" id="farmerName" name="farmerName" readonly value="<?php echo $rowFarmerName[0]; ?>">
    </div>
    <div class="form-group col-md-6">
      <label for="plotName">Plot Name</label>
      <input type="text" class="form-control" id="plotName" name="plotName" readonly value="<?php echo $rowPlotName[0]; ?>">
    </div>
  </div>
  <div class="form-row">
  <div class="form-group col-md-6">
      <label for="cropName">Crop Planted *</label>
      <select class="form-control" name="cropName">
        <?php
        $queryCropName = "SELECT varientName FROM cropvarients WHERE varientID=$varientID";
        $resultCropName = mysqli_query($connect, $queryCropName);
        $rowCropName = mysqli_fetch_row($resultCropName);
        echo '<option>'.$rowCropName[0].'</option>';
          $queryCrop = "SELECT * FROM cropvarients WHERE companyID='$currCompany'";
          $resultCrop = mysqli_query($connect,$queryCrop);
          while($rowCrop = mysqli_fetch_array($resultCrop)){
            if($rowCrop['varientName']!= $rowCropName[0]){
              echo '<option>'.$rowCrop['varientName'].'</option>';
            }    
          }
        ?>
      </select>
  </div>
  <div class="form-group col-md-6">
      <label for="numberOfCrops">Estimate/Number of Seeds/Buds/Grains/etc. Planted *</label>
      <input type="number" class="form-control" id="numberOfCrops" name="numberOfCrops" value="<?php echo $numberOfCrops; ?>" required>
    </div>
  </div>
  <div class="form-row">
    
    <div class="form-group col-md-6">
      <label for="plantedDate">Date Planted *</label>
      <input type="date" class="form-control datepicker" id="plantedDate"  name="plantedDate" required value="<?php echo $plantedDate; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="plantedLastFertilized">Date Last Fertilized</label>
      <input type="date" class="form-control" id="plantedLastFertilized"  name="plantedLastFertilized" value="<?php echo $plantedLastFertilized; ?>">
    </div>
  </div>
  <div class="form-row">
    
    
  </div>
  <div class="form-row">
    
    <div class="form-group col-md-6">
      <label for="lastPesticide">Date Pesticide Last Used</label>
      <input type="date" class="form-control" id="lastPesticide"  name="lastPesticide" value="<?php echo $lastPesticide; ?>">
    </div>

    <div class="form-group col-md-6">
      <label for="lastWatered">Date Last Watered</label>
      <input type="date" class="form-control" id="lastWatered"  name="lastWatered" value="<?php echo $lastWatered; ?>">
    </div>
  </div>
  <div class="form-row">
    
    
  </div>
  <div class="form-group">
      <label for="miscDetals">Miscellaneous Details</label>
      <textarea type="text" class="form-control" id="miscDetals" name="miscDetals" rows="3"><?php echo $miscDetals; ?></textarea>
  </div>
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