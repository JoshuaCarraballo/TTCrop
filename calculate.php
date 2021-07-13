<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>Profitability Analysis</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <script type="text/javascript" src="js/myScript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bulma/0.7.2/css/bulma.min.css"/>
    <script
      defer
      src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"
    ></script>
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
                    <a href="#">
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
            
            <h2 class="dash-title" style="font-size: 32px;">Profitability Calculator</h2>

            <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php" style="color:#FBBC05;">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profitability Calculator</li>
            </ol>
            </nav>

            
      
        <div class="content">
          <p>
            The Profitability Calculator will determine your estimated profits, profit margin and markup
            from your harvest.
          </p>
        </div>

        <div class="columns" style="width: 100%;">
          <div class="column is-three-quarters"style="width: 100%;">
            <div class="card" style="width: 100%;">
              <div class="card-content"style="width: 100%;">
                <form id="loan-form" style="width: 100%;">
                  <div class="level">
                    <!-- Left side -->
                    <div class="level-left is-marginless">
                      <div class="level-item">
                        <p class="number">1</p>
                        Crop Amount (In pounds)
                      </div>
                    </div>

                    <!-- Right side -->
                    <div class="level-right">
                      <div class="level-item">
                        <div class="field">
                          <div class="control has-icons-left ">
                            <input class="input" id="amount" type="number" />
                            <span class="icon is-small is-left">
                              <i class="fa fa-tree"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="level">
                    <!-- Left side -->
                    <div class="level-left is-marginless">
                      <div class="level-item">
                        <p class="number">2</p>
                        Selling Price Per Pound
                      </div>
                    </div>

                    <!-- Right side -->
                    <div class="level-right">
                      <div class="level-item">
                        <div class="field">
                          <div class="control has-icons-left">
                            <input class="input" id="selling" type="number" />
                            <span class="icon is-small is-left">
                              <i class="fa fa-dollar-sign"></i>
                              
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="level">
                    <!-- Left side -->
                    <div class="level-left is-marginless">
                      <div class="level-item">
                        <p class="number">3</p>
                        Estimated Resource Cost (Water, Fertilizers, Pesticides etc.)
                      </div>
                    </div>

                    <!-- Right side -->
                    <div class="level-right">
                      <div class="level-item">
                        <div class="field">
                          <div class="control has-icons-left">
                            <input class="input" id="resource" type="number" />
                            <span class="icon is-small is-left">
                              <i class="fa fa-calendar"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="level">
                    <!-- Left side -->
                    <div class="level-left is-marginless">
                      <div class="level-item">
                        <p class="number">4</p>
                        Estimated Labour Cost
                      </div>
                    </div>

                    <!-- Right side -->
                    <div class="level-right">
                      <div class="level-item">
                        <div class="field">
                          <div class="control has-icons-left">
                            <input class="input" id="labour" type="number" />
                            <span class="icon is-small is-left">
                              <i class="fa fa-male"></i>
                            </span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="control">
                    <button
                      class="button is-large is-fullwidth is-success is-outlined"
                    >
                      Calculate
                    </button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        
    

    <!-- RESULTS -->
      <h1 class="title" style=" margin-top:0px;">Calculated Results</h1>
<div class="columns is-multiline" style="padding-right: 0%;">
  
  <div class="column is-12-tablet is-6-desktop is-3-widescreen">
    <div class="notification is-primary has-text" style="background-color: #77C58C;padding-bottom:60px;">
      <p id="sales" class="title is-1" style="font-size: 33px;">$</p>
      <p class="subtitle is-4" style="font-size: 34px;">Gross Sales</p>
    </div>
  </div>

  <div class="column is-12-tablet is-6-desktop is-3-widescreen" >
    <div class="notification is-primary has-text" style="background-color: #34A853;padding-bottom:60px">
      <p id="profit" class="title is-1" style="font-size: 33px;">$</p>
      <p class="subtitle is-4" style="font-size: 34px;">Profits</p>
    </div>
  </div>

      <div class="column is-12-tablet is-6-desktop is-3-widescreen">
        <div class="notification is-info has-text" style="background-color: #FFD559;padding-bottom:60px">
          <p id="profitMargin" class="title is-1" style="font-size: 33px;">%</p>
          <p class="subtitle is-4" style="font-size: 34px;">Profit Margin</p>
        </div>
      </div>

      <div class="column is-12-tablet is-6-desktop is-3-widescreen">
        <div class="notification is-link has-text" style="background-color: #FFC107;padding-bottom:60px">
          <p id="markup" class="title is-1" style="font-size: 33px;">%</p>
          <p class="subtitle is-4" style="font-size: 34px;">Markup</p>
        </div>
      </div>
      

</div>
            
        </main>
        
    </div>

</body>
<script src="js/app.js"></script>
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