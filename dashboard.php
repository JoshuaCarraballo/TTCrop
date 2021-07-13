<?php
    session_start();
    $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
    $currCompany =$_SESSION['currCompany'];

    //Total fields
    $queryField = "SELECT COUNT(*) FROM field WHERE companyid='$currCompany'";
    $resultField = mysqli_query($connect,$queryField);
    $rowField = mysqli_fetch_row($resultField);
    
    //Total Plots
    $queryPlot = "SELECT COUNT(*) FROM plot  WHERE companyid='$currCompany'";
    $resultPlot = mysqli_query($connect,$queryPlot);
    $rowPlot = mysqli_fetch_row($resultPlot);

    //Total planted plots
    $queryPlanted = "SELECT COUNT(*) FROM plantedplot  WHERE companyid='$currCompany'";
    $resultPlanted = mysqli_query($connect,$queryPlanted);
    $rowPlanted = mysqli_fetch_row($resultPlanted);

    //Total crops
    $queryCrop = "SELECT COUNT(*) FROM cropvarients  WHERE companyid='$currCompany'";
    $resultCrop = mysqli_query($connect,$queryCrop);
    $rowCrop = mysqli_fetch_row($resultCrop);

    //Total harvests
    $queryHarvest= "SELECT COUNT(*) FROM harvested  WHERE companyid='$currCompany'";
    $resultHarvest = mysqli_query($connect,$queryHarvest);
    $rowHarvest = mysqli_fetch_row($resultHarvest);

    //Total farmers
    $queryFarmer= "SELECT COUNT(*) FROM farmer WHERE companyID='$currCompany'";
    $resultFarmer = mysqli_query($connect,$queryFarmer);
    $rowFarmer = mysqli_fetch_row($resultFarmer);

    //Total accounts
    $queryAccount = "SELECT COUNT(*) FROM logindetails  WHERE companyid='$currCompany'";
    $resultAccount = mysqli_query($connect,$queryAccount);
    $rowAccount = mysqli_fetch_row($resultAccount);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Dashboard</title>
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
                    <a href="#">
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
            
            <h2 class="dash-title">Welcome <?php echo $_SESSION['userRole']; echo " "; echo $_SESSION['login_user'];?></h2>
            
            <div class="dash-cards">
                <div class="card-single">
                <a href="viewFields.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-layout-grid3" style="color: #ffc107;"></span>
                        <div>
                            <h5>Fields</h5>
                            <h4><?php echo $rowField[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewFields.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <a href="viewPlots.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-layout-width-default" style="color: #ffc107;"></span>
                        <div>
                            <h5>Plots</h5>
                            <h4><?php echo $rowPlot[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewPlots.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <a href="viewPlanted.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-paint-bucket" style="color: #ffc107;"></span>
                        <div>
                            <h5>Growing Crops</h5>
                            <h4><?php echo $rowPlanted[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewPlanted.php">View all</a>
                    </div>
                </div>
            </div>

            <br>

            <div class="dash-cards">
                <div class="card-single">
                <a href="viewCropList.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-view-list-alt" style="color: #ffc107;"></span>
                        <div>
                            <h5>Crop List</h5>
                            <h4><?php echo $rowCrop[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewCropList.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <a href="viewHarvested.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-hand-stop" style="color: #ffc107;"></span>
                        <div>
                            <h5>Past Harvests</h5>
                            <h4><?php echo $rowHarvest[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewHarvested.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                <a href="weather.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-shine" style="color: #ffc107;"></span>
                        <div>
                            <h5>Weather Forecast</h5>
                            <h4 style="color:white;">,</h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="weather.php" style="color: black;">View weather</a>
                    </div>
                </div>
            </div>

            <br>

            <div class="dash-cards">
            <div class="card-single">
                    <a href="alerts.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-bell" style="color: #ffc107;"></span>
                        <div>
                            <h5>Alerts</h5>
                            <h4 style="color:white;">,</h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="alerts.php">Send out alerts</a>
                    </div>
                </div>
                
                <div class="card-single">
                    <a href="analytics.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-bar-chart-alt" style="color: #ffc107;"></span>
                        <div>
                            <h5>Farm Analytics</h5>
                            <h4 style="color:white;">,</h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="analytics.php">View data</a>
                    </div>
                </div>
                
                <div class="card-single">
                    <a href="calculate.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-stats-up" style="color: #ffc107;"></span>
                        <div>
                            <h5>Profitability Calculator</h5>
                            <h4 style="color:white;">,</h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="calculate.php">Access here</a>
                    </div>  
                </div>

            </div><br >

            <div class="dash-cards">
                
                <div class="card-single">
                    <a href="viewFarmers.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-user" style="color: #ffc107;"></span>
                        <div>
                            <h5>Farmers</h5>
                            <h4><?php echo $rowFarmer[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewFarmers.php">View all</a>
                    </div>
                </div>
                
                <div class="card-single">
                    <a href="viewLogins.php" style="text-decoration: none;">
                    <div class="card-body">
                        <span class="ti-settings" style="color: #ffc107;"></span>
                        <div>
                            <h5>User Accounts</h5>
                            <h4><?php echo $rowAccount[0]; ?></h4>
                        </div>
                    </div></a>
                    <div class="card-footer">
                        <a href="viewLogins.php">View all</a>
                    </div>  
                </div>

            </div>
            
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
