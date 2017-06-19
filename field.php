<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();


$conn = mysqli_connect("localhost", "root", "", "attachment");

if(isset($_GET['category']))
{
  $_SESSION['category']=$_GET['category'];
  $_SESSION['lev']= "Attachment";
 header("Location: field.php");
}

if(isset($_GET['field']))
{
  $_SESSION['category']=$_GET['field'];
  $_SESSION['lev']= "Job";
 header("Location: field.php");
}

$cat = $_SESSION['category'];
$lev = $_SESSION['lev'];


if(isset($_GET['apply']))
{
  $_SESSION['apply']=$_GET['apply'];
 header("Location: application.php");
}
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
  Header Section
============================-->
  <header id="header" class="sticky-wrapper" style="height: 90px;">
    <div class="container">

      <div id="logo" class="pull-left">
        <a href="home.php#hero"><img src="img/logo.png" alt="" title="" /></img></a>
        <!-- Uncomment below if you prefer to use a text image -->
        <!--<h1><a href="#hero">Header 1</a></h1>-->
      </div>

      <nav id="nav-menu-container" class="navbar navbar-fixed">
        <ul class="nav-menu">
          <li class="menu-active"><a href="index.php#hero">Home</a></li>
          <li><a href="index.php#about">About Us</a></li>
          <li><a href="index.php#services">Services</a></li>

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
  <aside class="bg-dark" style="background-image: url(img/section-bg1.jpg)">
   <h4 class="text-center"><?php echo $cat; ?></h4>
  </aside>

    <section id="contact" style="padding:10px; background-color:#f2eded;">
     <div class="row">
      <div class="col-md-8 col-md-offset-2"><br><br><br><br>
          <div class="panel panel-info">
            <div class="panel-heading">
            </div>
              <div class="panel-body">
                <div class="list-group">

                    <?php
                    $res = $conn->query("SELECT * FROM tbl_posts WHERE category='$cat' AND level='$lev'");
                    while($Row=$res->fetch_array())
                    {
                     ?>
                    <span class="list-group-item">
                        <span><h3><?php echo $Row['position']; ?></h3>
                          <hr style="border-width:2px; max-width:800px;">
                          <a href="mailto:<?php echo $Row['companyEmail']; ?>"> <i class="fa fa-envelope-o fa-fw"><?php echo $Row['companyName']; ?></i></a>
                        </span>
                        <span class="text-muted pull-right"><?php echo $Row['level']; ?></span><br>
                        <p><?php echo $Row['detail']; ?></p>
                        <span class="text-muted fa fa-group"><?php echo $Row['numb']; ?></span>
                        <span class="text-muted pull-right"><?php echo $Row['postTime']; ?></span>
                         <hr style="border-width:2px; max-width:800px;">
                        <span class="fa fa-phone fa-fw">0<?php echo $Row['companyPhone']; ?></span><br>
                          <a href="?apply=<?php echo $Row['id']; ?>"><button class="btn btn-info btn-outline "><i class="fa fa-pencil fa-fw"></i>Apply</button></a>

                    </span><br>
                    <?php
                    }
                    ?>
                </div>
              </div>
              <!-- /.panel-body -->
          </div>
          <!-- /.panel -->
      </div>
    </div>
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

    <script src="applyscript.js"></script>

    <script src="css/morphext/morphext.min.js"></script>
</body>
</html>
