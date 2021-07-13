<?php
session_start();
$currCompany = $_SESSION['currCompany'];
$connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
$query="SELECT fieldID, fieldName, fieldAddress, fieldMaxCapacity, fieldSize, companyID FROM field WHERE companyID='$currCompany'";
$searchKey = "";
$result2 = mysqli_query($connect,$query);
$dataRow = "";
while($row2 = mysqli_fetch_array($result2)){
    $dataRow = $dataRow."<tr> <td>$row2[0]</td> <td>$row2[1]</td> <td>$row2[2]</td> <td>$row2[3]</td> <td>$row2[4]</td> <td>$row2[5]</td> </tr>";
}

if(isset($_POST['search'])){
    $searchKey = $_POST['search'];
    $searchQuery = "SELECT * FROM field WHERE companyID='$currCompany' AND fieldID LIKE '%$searchKey%' OR companyID='$currCompany' AND fieldName LIKE '%$searchKey%' OR companyID='$currCompany' AND fieldAddress LIKE '%$searchKey%' OR companyID='$currCompany' AND fieldMaxCapacity LIKE '%$searchKey%' OR companyID='$currCompany' AND fieldSize LIKE '%$searchKey%'";
    $result1 = mysqli_query($connect,$searchQuery);
}
else if(isset($_POST['asc'])){
    $sortQuery = "SELECT * FROM field WHERE companyID='$currCompany' ORDER BY fieldID ASC;";
    $result1 = mysqli_query($connect,$sortQuery);
}
else if(isset($_POST['desc'])){
    $sortQuery = "SELECT * FROM field WHERE companyID='$currCompany' ORDER BY fieldID DESC;";
    $result1 = mysqli_query($connect,$sortQuery);
}
else{
    $result1 = mysqli_query($connect,$query);
    $searchKey = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <title>View Fields</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/lykmapipo/themify-icons@0.1.2/css/themify-icons.css">
    <link href="css/fontawesome-all.css" rel="stylesheet">
    <script type="text/javascript" src="js/myScript.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> 
    <link type='text/css' rel='stylesheet' href="css/appStyle.css">/>
    <link type='text/css' rel='stylesheet' href="https://cdn.datatables.net/1.10.25/css/dataTables.bootstrap4.min.css">
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
                    <a href="#">
                        <span class="ti-layout-width-default"></span>
                        <span>Fields</span>
                    </a>
                </li>
                <li>
                    <a href="empviewPlots.php">
                        <span class="ti-layout-grid3"></span>
                        <span>Plots</span>
                    </a>
                </li>
                <li>
                    <a href="empviewPlanted.php">
                        <span class="ti-paint-bucket"></span>
                        <span>Growing Crops</span>
                    </a>
                </li>
                <li>
                    <a href="empviewCropList.php">
                        <span class="ti-view-list-alt"></span>
                        <span>Crop List</span>
                    </a>
                </li>
                <li>
                    <a href="empweather.php">
                        <span class="ti-shine"></span>
                        <span>Weather</span>
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
                <ul class="dropdown-menu" id="alert" style=" width: 350px; padding-left:10px; margin-top:19px;"></ul>
                </li>
            </ul>
            <a href="#" onclick="logoutVerify()" style="text-decoration: none; color:black;"><span class="ti-shift-left" style="font-size: 30px;"></span></a>
            </div>
        </header>
        
        <main>
            
            <h2 class="dash-title">View Fields</h2>
            <nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="empdashboard.php" style="color:#FBBC05;">Dashboard</a></li>
    <li class="breadcrumb-item active" aria-current="page">View Fields</li>
  </ol>
</nav>

<form action="" method="POST">
<div class="container" style="margin-left: -14px;">
  <div class="row">

    <div class="col col-lg-2">
    <input type="submit" name="desc" class="btn btn-warning" value="Sort By Recent" style="width: 180px;"><br > <br >
    </div>
    
    <div class="col col-lg-2">
    <input type="submit" name="asc" class="btn btn-warning" value="Sort By Oldest" style="width: 180px;"><br > <br >
   
    </div>
    
  </div>
</div>
</form>

<!-- Field Table -->   
            <table class="table table-hover table-bordered box-shadow--3dp" id="fieldTable">
            
  <thead>
    <tr class="bg-warning">
      <th scope="col" style="border-right: none; border-color:#FBBC05;">Field ID</th>
      <th scope="col" style="border-left: none; border-right:none; border-color:#FBBC05;">Field Name</th>
      <th scope="col" style="border-left: none; border-right:none; border-color:#FBBC05;">Address</th>
      <th scope="col" style="border-left: none; border-right:none; border-color:#FBBC05;">Max Capacity</th>
      <th scope="col" style="border-left: none; width:130px; border-color:#FBBC05;">Size</th>
    </tr>
  </thead>
  <tbody>



  <?php while($row1= mysqli_fetch_array($result1)):; ?>
    <tr>
      <td title="<?php echo $row1[0]; ?>" style="padding-top: 20px;"><?php echo $row1[0]; ?></td>
      <td title="<?php echo $row1[1]; ?>" style="padding-top: 20px;"><?php echo $row1[1]; ?></td>
      <td title="<?php echo $row1[2]; ?>" style="padding-top: 20px;"><?php echo $row1[2]; ?></td>
      <td title="<?php echo $row1[3]; ?>" style="padding-top: 20px;"><?php echo $row1[3]; ?></td>
      <td title="<?php echo $row1[4]; ?>" style="padding-top: 20px;"><?php echo $row1[4]; ?></td>
    </tr>
    <?php endwhile; ?>
  </tbody>
</table>

            
        </main>
        
    </div>
    <script src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.25/js/dataTables.bootstrap4.min.js"></script>
</body>
</html>
<script>
$(document).ready(function() {
    $('#fieldTable').DataTable({
        "order": []
    });
} );
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
    $('#alert').html(data.notification);
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