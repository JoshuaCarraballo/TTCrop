<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>TTCrop | About</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/component.css" type="text/css" media="all">
    <link href="css/style.css" rel='stylesheet' type='text/css' />
    <link rel="stylesheet" href="css/owl.theme.css" type="text/css" media="all">
    <link rel="stylesheet" href="css/owl.carousel.css" type="text/css" media="screen" property="" />
    <link href="css/fontawesome-all.css" rel="stylesheet">
</head>

<body>
<?php 
   $connect = mysqli_connect("localhost", "root", "", "ttcrop") or die("Please, check the server connection.");
   session_start();
   
   $errorMsg="";
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
      $companyNAME = mysqli_real_escape_string($connect,$_POST['companyName']);
      $ownerName = mysqli_real_escape_string($connect,$_POST['ownerName']);
      $ownerGovernmentID = mysqli_real_escape_string($connect,$_POST['ownerGovernmentID']);
      $ownerGovernmentIDType = mysqli_real_escape_string($connect,$_POST['ownerGovernmentIDType']);
      $ownerGender = mysqli_real_escape_string($connect,$_POST['ownerGender']);
      $ownerDOB = mysqli_real_escape_string($connect,$_POST['ownerDOB']);
      $ownerAddress = mysqli_real_escape_string($connect,$_POST['ownerAddress']);
      $username = mysqli_real_escape_string($connect,$_POST['loginUsername']);
      $password = mysqli_real_escape_string($connect,$_POST['loginPassword']);  
      
      $queryCompany = "INSERT INTO farmcompany(companyNAME, ownerName, ownerGovernmentID, ownerGovernmentIDType, ownerGender, ownerDOB, ownerAddress)
      VALUES('$companyNAME', '$ownerName', '$ownerGovernmentID', '$ownerGovernmentIDType', '$ownerGender', '$ownerDOB', '$ownerAddress') ";
      
      if($connect->query($queryCompany) === TRUE){
        
        $queryCompID = "SELECT companyID FROM farmcompany ORDER BY companyID DESC LIMIT 1";
        $resultCompID = mysqli_query($connect, $queryCompID);
        $rowCompID = mysqli_fetch_row($resultCompID);
        $currCompID = $rowCompID[0];

        $queryFarmer = "INSERT INTO farmer(farmerName, governmentID, governmentIDType, farmerGender, farmerDOB, farmerAddress, companyID)
        VALUES('$ownerName', '$ownerGovernmentID','$ownerGovernmentIDType', '$ownerGender','$ownerDOB','$ownerAddress', '$currCompID')";
        
        if($connect->query($queryFarmer) === TRUE){
            $queryNewFarmerID = "SELECT farmerID FROM farmer ORDER BY farmerID DESC LIMIT 1";
            $resultNewFarmerID = mysqli_query($connect, $queryNewFarmerID);
            $rowNewFarmerID = mysqli_fetch_row($resultNewFarmerID);
            $currFarmerID = $rowNewFarmerID[0];

            $queryLogin = "INSERT INTO logindetails(farmerID, username, password, role, companyID)
            VALUES('$currFarmerID', '$username','$password', 'Farm Owner','$currCompID')";
            
            if($connect->query($queryLogin) === TRUE){
                $_SESSION['login_user'] = $ownerName;
                $_SESSION['currFarmerID'] = $rowNewFarmerID[0];
                $_SESSION['userRole'] = "Farm Owner";
                $_SESSION['currCompany'] = $currCompID;
                header("location: dashboard.php");
            }
            else{
                echo "<script>alert('Error Registering Login Credentials')</script>";
            }
        }
        else{
            echo "<script>alert('Error Registering Farmer')</script>";
        }

      }
      else{
        echo "<script>alert('Error Registering Company')</script>";
      }
   } 
?>
    <div class="mian-content">
        <div class="header-top-w3layouts-agile">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-3 top-social-icons text-center">
                        <ul class="social-icons">
                            <li class="mr-1"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                            <li class="mx-1"><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li class="mx-1"><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                            <li class="mx-1"><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                        </ul>
                    </div>
                    <div class="col-md-6 logo text-center">
                        <h1>
                            <a class="navbar-brand" href="index.php">
                            <i class="fas fa-leaf"></i>TTCrop</a>
                        </h1>
                    </div>
                    <div class="col-md-3 login-right-img text-center">
                        <a class="request text-uppercase" href="#" data-toggle="modal" data-target="#exampleModalCenter">Sign In</a>
                        <a class="request text-uppercase" href="#" data-toggle="modal" data-target="#exampleModalCenter2">Sign Up</a>
                    </div>
                </div>
            </div>
            <div class="header-bg">
                <div class="container">
                    <header>
                        <nav class="navbar navbar-expand-lg navbar-light">
                            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon">
                            </span>
                        </button>
                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-lg-auto text-center">
                                    <li class="nav-item">
                                        <a class="nav-link" href="index.php">Home
                                        <span class="sr-only">(current)</span>
                                    </a>
                                    </li>
                                    <li class="nav-item active">
                                        <a class="nav-link" href="about.php">About</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="services.php">Services</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="contact.php">Contact</a>
                                    </li>

                                </ul>
                            </div>

                        </nav>
                    </header>
                </div>
            </div>
        </div>
    </div>
    <!-- end of main image slider container -->
    <div class="inner-page">
    </div>
    <!-- /breadcrumb -->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="index.php">Home</a>
        </li>
        <li class="breadcrumb-item active">About</li>
    </ol>

    <!-- //breadcrumb -->


    <!-- ab -->
    <section class="banner-bottom-w3layouts py-lg-5 py-md-5 py-3" id="feature">
        <div class="container">
            <div class="inner-sec-w3ls-agileits py-lg-5 py-3">
                <h4 class="sub-tittle text-uppercase text-center">Some more info</h4>
                <h3 class="tittle text-center">About Us</h3>

                <div class="about-info mt-lg-5 mt-md-4 mt-4 text-center">
                    <img src="images/1.jpg" class="img-fluid" alt="" />
                    <p class="my-lg-5 my-3">TTCrop is a crop farm data collection, analysis and management platform. It enables users to collect and manage data at all levels of operation for more profitable decision making.
                        TTCrop delivers real-time data on present field and crop conditions/health, determines levels of vegetation and pinpoints areas of problems, provides accurate weather updates and an actual overview crop yields and profitability estimation.
                    </p>
                </div>
            </div>
        </div>
    </section>
    
    
    <!--footer -->
    <footer class="footer-emp-wthree bg-dark dotts py-lg-5 py-3">
        <div class="container">
            <div class="row footer-top">
                <div class="col-lg-4 footer-grid-w3ls">
                    <div class="footer-title">
                        <h3>About Us</h3>
                    </div>
                    <div class="footer-text">
                        <p>TTCrop is a crop farm data collection, analysis and management platform. It enables users to collect and manage data at all levels of operation for more profitable decision making.</p>
                        <ul class="social-icons">
                            <li class="mr-1"><a href="#"><span class="fab fa-facebook-f"></span></a></li>
                            <li class="mx-1"><a href="#"><span class="fab fa-twitter"></span></a></li>
                            <li class="mx-1"><a href="#"><span class="fab fa-google-plus-g"></span></a></li>
                            <li class="mx-1"><a href="#"><span class="fab fa-linkedin-in"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 footer-grid-w3ls">
                    <div class="footer-title">
                        <h3>Get in touch</h3>
                    </div>
                    <div class="contact-info">
                        <h4>Location :</h4>
                        <p>Wrightson Road, Port of Spain</p>
                        <div class="phone">
                            <h4>Contact :</h4>
                            <p>Phone : +1 868 634 2324</p>
                            <p>Email :
                                <a href="mailto:TTCrops@gmail.com">TTCrops@gmail.com</a>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 footer-grid-w3ls">
                    <div class="footer-title">
                        <h3>Quick Links</h3>
                    </div>
                    <ul class="links">
                        <li>
                            <a href="index.php">Home</a>
                        </li>
                        <li>
                            <a href="about.php">About</a>
                        </li>
                        <li>
                            <a href="services.php">Services</a>
                        </li>
                        <li>
                            <a href="contact.php">Contact Us</a>
                        </li>
                    </ul>
                    <ul class="links">
                        <li>
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter">Login</a>
                        </li>
                        <li>
                            <a href="#" data-toggle="modal" data-target="#exampleModalCenter2">Signup</a>
                        </li>
                    </ul>

                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </footer>
    <!-- //footer -->

    <!--model-forms-->
    <!--/Login-->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="login px-4 mx-auto mw-100">
                        <h5 class="text-center mb-4">Login Now</h5>
                        
                            <div class="form-group">
                                <label class="mb-2">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="">
                            </div>
                            <button type="button" name="login_button" id="login_button" class="btn btn-primary submit mb-4">Sign In</button>
                        
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--//Login-->
    <!--/Register-->
    <div class="modal fade" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="login px-4 mx-auto mw-100">
                        <h5 class="text-center mb-4">Register Now</h5>
                        <form action="#" method="post" id="tester">
                        <div class="form-group">
                                <label>Company name</label>

                                <input type="text" class="form-control" id="companyName" name="companyName" required>
                            </div>
                            <div class="form-group">
                                <label>Owner Name</label>
                                <input type="text" class="form-control" id="ownerName" name="ownerName" required>
                            </div>

                            <div class="form-group">
                                <label class="mb-2">Owner Government ID</label>
                                <input type="text" class="form-control" id="ownerGovernmentID" name="ownerGovernmentID" required>
                            </div>
                            <div class="form-group">
                                <label>Government ID Type</label>
                                <input type="text" class="form-control" id="ownerGovernmentIDType" name="ownerGovernmentIDType" required=>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Owner Gender</label>
                                <input type="text" class="form-control" id="ownerGender" name="ownerGender" required>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Owner Date of Birth</label>
                                <input type="date" class="form-control" id="ownerDOB" name="ownerDOB" required>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Owner Address</label>
                                <input type="text" class="form-control" id="ownerAddress" name="ownerAddress" required>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Login Username</label>
                                <input type="text" class="form-control" id="loginUsername" name="loginUsername" required>
                            </div>
                            <div class="form-group">
                                <label class="mb-2">Login Password</label>
                                <input type="password" class="form-control" id="loginPassword" name="loginPassword" required>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>
    <!--//Register-->

    <!--//model-form-->
    <!-- js -->
    <script src="js/jquery-2.2.3.min.js"></script>
    <script src="js/toucheffects.js"></script>
    <script src="js/modernizr.custom.js"></script>
    <!-- carousel -->
    <script src="js/owl.carousel.js"></script>
    <script>
        $(document).ready(function() {
            $('.owl-carousel').owlCarousel({
                loop: true,
                margin: 10,
                responsiveClass: true,
                responsive: {
                    0: {
                        items: 1,
                        nav: true
                    },
                    600: {
                        items: 1,
                        nav: false
                    },
                    900: {
                        items: 1,
                        nav: false
                    },
                    1000: {
                        items: 2,
                        nav: true,
                        loop: false,
                        margin: 20
                    }
                }
            })
        })
    </script>
    <!-- //carousel -->
    <script>
        $(document).ready(function() {
            $(".dropdown").hover(
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideDown("fast");
                    $(this).toggleClass('open');
                },
                function() {
                    $('.dropdown-menu', this).stop(true, true).slideUp("fast");
                    $(this).toggleClass('open');
                }
            );
        });
    </script>
    <!-- //dropdown nav -->
    <!-- stats -->
    <script src="js/jquery.waypoints.min.js"></script>
    <script src="js/jquery.countup.js"></script>
    <script>
        $('.counter').countUp();
    </script>
    <!-- //stats -->
    <!-- password-script -->
    <script>
        window.onload = function() {
            document.getElementById("password1").onchange = validatePassword;
            document.getElementById("password2").onchange = validatePassword;
        }

        function validatePassword() {
            var pass2 = document.getElementById("password2").value;
            var pass1 = document.getElementById("password1").value;
            if (pass1 != pass2)
                document.getElementById("password2").setCustomValidity("Passwords Don't Match");
            else
                document.getElementById("password2").setCustomValidity('');
            //empty string means no validation error
        }
    </script>
    <!-- //password-script -->

    <!--/ start-smoth-scrolling -->
    <script src="js/move-top.js"></script>
    <script src="js/easing.js"></script>
    <script>
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event) {
                event.preventDefault();
                $('html,body').animate({
                    scrollTop: $(this.hash).offset().top
                }, 900);
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            /*
            						var defaults = {
            							  containerID: 'toTop', // fading element id
            							containerHoverID: 'toTopHover', // fading element hover id
            							scrollSpeed: 1200,
            							easingType: 'linear' 
            						 };
            						*/

            $().UItoTop({
                easingType: 'easeOutQuart'
            });

        });
    </script>
    <!--// end-smoth-scrolling -->
    <!-- /js -->
    <script src="js/bootstrap.js"></script>
    <!-- //js -->
</body>

</html>

<script>
$(document).ready(function(){
    $('#login_button').click(function(){  
           var username1 = $('#username').val();  
           var password1 = $('#password').val();  
           if(username != '' && password != '')  
           {  
                $.ajax({  
                     url:"action.php",  
                     method:"POST",  
                     data: {username:username1, password:password1},  
                     success:function(data)  
                     {  
                          //alert(data);  
                          if(data == 'No')  
                          {   
                               alert("Incorrect Login Credentials");  
                          }  
                          else if(data == 'Farm Owner')  
                          {  
                            window.location.href = "dashboard.php";
                          }
                          else if(data == 'Manager')  
                          {  
                            window.location.href = "mandashboard.php";
                          }
                          else{
                            window.location.href = "empdashboard.php";
                          }    
                     }  
                });  
           }  
           else  
           {  
                alert("Both Fields are required");  
           }  
      });  
});
</script>