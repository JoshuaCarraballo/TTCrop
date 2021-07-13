<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
    $companyID =$_SESSION['currCompany'];
    $datasetVarientName = "";
    $dataSetTotal = "";
    $queryAllVarients="SELECT varientName FROM cropvarients WHERE companyID='$companyID'";
    $resultAllVarients = mysqli_query($connect, $queryAllVarients);

    while($rowAllVarients = mysqli_fetch_array($resultAllVarients)){
        $datasetVarientName = $datasetVarientName.'"'.$rowAllVarients['varientName'].'",';
        $tempVName = $rowAllVarients['varientName'];

        $queryGetID = "SELECT varientID FROM cropvarients WHERE companyID='$companyID' AND varientName = '$tempVName'";
        $resultGetID = mysqli_query($connect,$queryGetID);
        $rowGetID = mysqli_fetch_array($resultGetID);
        $tempID = $rowGetID['varientID'];

        $queryTotal = "SELECT SUM(numberOfCrops) FROM plantedplot WHERE companyID='$companyID' AND varientID='$tempID'";
        $resultTotal = mysqli_query($connect, $queryTotal);
        $rowTotal = mysqli_fetch_row($resultTotal);
        $dataSetTotal = $dataSetTotal.'"'.$rowTotal[0].'",';
    }
    $datasetVarientName = trim($datasetVarientName,",");
    $dataSetTotal = trim($dataSetTotal,",");
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Analytics</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <script type="text/javascript" src="js/myScript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                    <a href="#">
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
            
            <h2 class="dash-title">Farm Analytics</h2>

            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="mandashboard.php" style="color:#FBBC05;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Farm Analytics</li>
            </ol>
            </nav>
            <div class="card bg-light mb-3 shadow-sm p-3 mb-5" style="max-width: 100%;">
                <div class="card-header text-center">
                <canvas id="mycanvas"></canvas>
                </div>
            
            </div>   

            <div class="card bg-light mb-3 shadow-sm p-3 mb-5" style="max-width: 100%;">
                <div class="card-header text-center">
                <canvas id="mycanvas1"></canvas>
                </div>
            
            </div>   
            
        </main>
        
    </div>

</body>
</html>
<!-- Script for all currently planted crops-->
<script>

$(document).ready(function() {
   var ctx = document.getElementById('mycanvas').getContext('2d');
   var chart = new Chart(ctx, {
      type: 'bar',
      data: {
         labels: [<?php echo $datasetVarientName; ?>],
         datasets: [{
            label: "My First dataset",
            backgroundColor: ["#FBBC05", "#23D160", "#4F4537", "#00AF7C", "#B5AA99", "#C3FCF2", "#FFD559"],
            data: [<?php echo $dataSetTotal; ?>],
         }]
      },
      options: {
        plugins: {
            title: {
                display: true,
                text: 'Bar Chart Displaying All Currently Planted Crops',
                font:{
                    size:25,
                }
            },
            legend:{
                display: false,
            }
        }
      }
   });
})

</script>
<!-- Alerts Script-->
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

<script>

$(document).ready(function() {
    <?php
        //Getting the yearly harvests for that farm
        $name = "Testssss";
        $pastYears = "";
        $yearlyHarvest = "";
        $queryGetHarvested = "SELECT DISTINCT LEFT(harvestDate, 4) FROM harvested WHERE companyID ='$companyID' ORDER BY harvestDate ASC";
        $resultGetHarvested = mysqli_query($connect, $queryGetHarvested);
        while($rowGetHarvested = mysqli_fetch_array($resultGetHarvested)){
            $pastYears = $pastYears.'"'.$rowGetHarvested['LEFT(harvestDate, 4)'].'",';
            
            //Getting total crops harvested for that year
            
            $tempDate = $rowGetHarvested['LEFT(harvestDate, 4)'];
            $queryYearAmt = "SELECT SUM(harvestAmt) FROM harvested WHERE companyID='$companyID' AND harvestDate LIKE '$tempDate%'";
            $resultYearAmt = mysqli_query($connect,$queryYearAmt);
            $rowYearAmt = mysqli_fetch_row($resultYearAmt);
            $yearlyHarvest = $yearlyHarvest.'"'.$rowYearAmt[0].'",'; 
        } 
        $pastYears = trim($pastYears,",");
        $yearlyHarvest = trim($yearlyHarvest,",");
    ?>
   var ctx1 = document.getElementById('mycanvas1').getContext('2d');


   var data = {
         labels: [<?php echo $pastYears; ?>],
         datasets: [{
            label: "For All Crops",
            backgroundColor: ["#FBBC05", "#23D160", "#4F4537", "#00AF7C", "#B5AA99", "#C3FCF2", "#FFD559"],
            borderColor: "grey",
            borderWidth: 2,
            pointRadius: 7,
            data:[<?php echo $yearlyHarvest; ?>],
         },  
        //{
            //label:scriptTest,
            //backgroundColor: ["#FBBC05", "#23D160", "#4F4537", "#00AF7C", "#B5AA99", "#C3FCF2", "#FFD559"],
           // data: [<?php echo $dataSetTotal; ?>],
        //}
        ]
      }
   var chart1 = new Chart(ctx1, {
      type: 'line',
      data: data,
      options: {
        plugins: {
            title: {
                display: true,
                text: 'Line Chart Displaying Yearly Past Harvests',
                font:{
                    size:25,
                }
            },
            legend:{
                display: false,
            },
        }
      }
   });
    
})
</script>