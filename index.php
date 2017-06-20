<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

if(isset($_GET['category']))
{
  $_SESSION['category']=$_GET['category'];
  $_SESSION['lev']= "Attachment";
 header("Location: field.php");
}

//if(isset($_GET['field']))
//{
//  $_SESSION['category']=$_GET['field'];
//  $_SESSION['lev']= "Job";
// header("Location: field.php");
//}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SAPS</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>

    <!-- Plugin CSS -->
    <link href="vendor/magnific-popup/magnific-popup.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="css/creative.min.css" rel="stylesheet">
    <link href="css/animate-css/animate.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body id="page-top">
  <div id="preloader"></div>

  <!--==========================
    Hero Section
  ============================-->
    <section id="hero">
      <div class="hero-container">
        <div class="wow fadeIn">
          <!--<div class="hero-logo">
            <img class="" src="img/logo.png" alt="Amatch">
          </div>-->

          <h1>Welcome to SAPS</h1>
          <h2><span class="rotating">We provide attachees with attachment oppotunities, We provide companies with a platform to post attachment or job oppotunities, Register your company with us today!</span></h2>
          <div class="actions">
            <a href="#about" class="btn-get-started">Get Started</a>
            <a href="#services" class="btn-services">Our Services</a>
          </div>
        </div>
      </div>
    </section>

    <!--==========================
  Header Section
============================-->
  <header id="header" class="sticky-wrapper" style="height: 90px;">
    <div class="container">

      <div id="logo" class="pull-left">
        <!--<a href="#hero"><img src="img/logo.png" alt="" title="" /></img></a>-->
        <!-- Uncomment below if you prefer to use a text image -->
        <h1><a href="#hero">SAPS</a></h1>
      </div>

      <nav id="nav-menu-container" class="navbar navbar-fixed">
        <ul class="nav-menu">
          <li class="menu-active"><a href="#hero">Home</a></li>
          <li><a href="#about">About Us</a></li>
          <li><a href="#services">Services</a></li>
          <li class="menu-has-children"><a href="">Attachments</a>
            <ul>
              <li><a href="?category=Bussiness"><i class="fa fa-book fa-fw"></i> Businesss</a>
              </li>
              <li><a href="?category=Arts"><i class="fa fa-book fa-fw"></i> Arts</a>
              </li>
              <li><a href="?category=Education"><i class="fa fa-book fa-fw"></i> Education</a>
              </li>
              <li><a href="?category=Engineering"><i class="fa fa-book fa-fw"></i> Engineering</a>
              </li>
              <li><a href="?category=Computing"><i class="fa fa-book fa-fw"></i> Computing</a>
              </li>
              <li><a href="?category=Media"><i class="fa fa-book fa-fw"></i> Media</a>
              </li>
              <li><a href="?category=Geology"><i class="fa fa-book fa-fw"></i> Geology</a>
              </li>
              <li><a href="?category=Health"><i class="fa fa-book fa-fw"></i> Health</a>
              </li>
              <li><a href="?category=Law"><i class="fa fa-book fa-fw"></i> Law</a>
              </li>
              <li><a href="?category=Agriculture"><i class="fa fa-book fa-fw"></i> Agriculture</a>
              </li>
              <li><a href="?category=Architecture"><i class="fa fa-book fa-fw"></i> Architecture</a>
              </li>
              <li><a href="?category=Appliedsciences"><i class="fa fa-book fa-fw"></i> Applied Sciences</a>
              </li>
              <li><a href="?category=Mathematics"><i class="fa fa-book fa-fw"></i> Mathematics</a>
              </li>
              <li><a href="?category=Other"><i class="fa fa-book fa-fw"></i> Other</a>
              </li>
            </ul>
          </li>
          <li><a href="#contact">Contact Us</a></li>
          <li>
            <?php if($user_login->is_logged_in()!="")
                    {
                      $stmt = $user_login->runQuery("SELECT * FROM users WHERE userID=:uid");
                      $stmt->execute(array(":uid"=>$_SESSION['userSession']));
                      $row = $stmt->fetch(PDO::FETCH_ASSOC);
            ?>
            <a class="page-scroll" href="login.php"><?php echo $row['userName']?></a>
            <?php
                  } else {
             ?>
             <a class="page-scroll" href="login.php">Company Log in</a>
             <?php
                  }
              ?>
          </li>
        </ul>
      </nav><!-- #nav-menu-container -->
    </div>
  </header><!-- #header -->

  <section id="about" style="padding:10px; background-color:#f2eded;"><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">We've got your back!</h2>
                    <hr class="primary">
                    <p class="text-muted">Looking for attachments? Its sorted. We have a list of options for you to check and apply.<br>
                       For companies, get access to the vast talent and skills relliably.</p>
                    <a href="signup.php" class="btn btn-info btn-xl ">Company Get Started!</a>
                </div>
            </div>
        </div><br><br>
    </section>

    <aside class="bg-dark" style="background-image: url(img/section-bg1.jpg)"><br>
            <div class="container text-center">
                <div class="call-to-action">
                 <br><br><br><h2>Lets Get to work.</h2><br><br>
                </div>
            </div>
        </aside>

  <section id="services" style="padding:10px; background-color:#f2eded;"><br><br>
          <div class="container">
              <div class="row">
                  <div class="col-lg-12 text-center">
                      <h2 class="section-heading">Services</h2>
                      <hr class="primary">
                  </div>
              </div>
          </div>
          <div class="container">
              <div class="row">
                  <div class="col-lg-3 col-md-6 text-center">
                      <div class="service-box">
                          <i class="fa fa-4x fa-check sr-icons"></i>
                          <h3>Reliable</h3>
                          <p class="text-muted">We have trusted attachment offers.</p>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 text-center">
                      <div class="service-box">
                          <i class="fa fa-4x fa-usd sr-icons"></i>
                          <h3>Affordable</h3>
                          <p class="text-muted">We let companies post attachments at affordable rates!</p>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 text-center">
                      <div class="service-box">
                          <i class="fa fa-4x fa-life-ring sr-icons"></i>
                          <h3>All-round</h3>
                          <p class="text-muted">We cover all fields in the Industry.</p>
                      </div>
                  </div>
                  <div class="col-lg-3 col-md-6 text-center">
                      <div class="service-box">
                          <i class="fa fa-4x fa-group sr-icons"></i>
                          <h3>Marketing</h3>
                          <p class="text-muted">We provide marketing to companies!</p>
                      </div>
                  </div>
              </div>
          </div><br><br>
      </section>
  <aside class="bg-dark" style="background-image: url(img/section-bg1.jpg)">
          <div class="container text-center">
              <div class="call-to-action">
                  <h2>Register your company with us today and enjoy all our services!</h2>
                  <a href="signup.php" class="btn btn-default btn-xl sr-button">Register Now!</a>
              </div>
          </div>
      </aside>

    <section id="contact" style="padding:10px; background-color:#f2eded;"><br><br>
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-lg-offset-2 text-center">
                    <h2 class="section-heading">Let's Get In Touch!</h2>
                    <hr class="primary">
                    <p>Interested in marketing with us? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-phone fa-3x sr-contact"></i>
                    <p>+254725305304</p>
                </div>
                <div class="col-lg-4 text-center">
                    <i class="fa fa-facebook-square fa-3x sr-contact"></i>
                    <p><a href="#">Saps</a></p>
                </div>

                <div class="col-lg-4 text-center">
                    <i class="fa fa-envelope-o fa-3x sr-contact"></i>
                    <p><a href="mailto:#">Saps</a></p>
                </div>
            </div>
        </div><br><br>
    </section>

    <aside class="bg-dark">
            <div class="container text-center">
                <div class="call-to-action">
                  <div class="copyright" style="text-decoration-color: white;">
                      &copy; Copyright <strong>SAPS</strong>. All Rights Reserved
                  </div>
                </div>
            </div>
        </aside>
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="vendor/scrollreveal/scrollreveal.min.js"></script>
    <script src="vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Theme JavaScript -->
    <script src="js/creative.min.js"></script>

    <script src="js/stickyjs/sticky.js"></script>

    <script src="css/morphext/morphext.min.js"></script>
</body>
</html>
