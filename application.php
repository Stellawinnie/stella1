<?php
session_start();
require_once 'class.user.php';
$user_login = new USER();

$conn = mysqli_connect("localhost", "root", "12345678", "attachment");
$msg = "";

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

$apply = $_SESSION['apply'];
$cat = $_SESSION['category'];
/* code for data insert */
if(isset($_POST['save']) && isset($_FILES['uploaded_file']) && $_FILES['uploaded_file']['error'] === UPLOAD_ERR_OK)
{
     // get values
   	$companyName =  $_POST['companyName'];
   	$userName = $_POST['userName'];
   	$userEmail = $_POST['userEmail'];
   	$userPhone =  $_POST['userPhone'];
    $about =  $_POST['about'];
    $postId =  $_POST['postId'];
   	$postTime = $_POST['postTime'];
    $emailresponse = $conn->query("SELECT * FROM tbl_posts WHERE id='$postId'");
    $emailRow=$emailresponse->fetch_array();
    $companyemail = $emailRow['companyEmail'];

    $passed = 'Yes';
    $failed = 'No';
    $respCheck="SELECT * FROM tbl_applicants WHERE userEmail='$userEmail' AND postId='$postId' AND sent='$passed'";
    $RowCheck=mysqli_query($conn, $respCheck);

    $respCheckfail="SELECT * FROM tbl_applicants WHERE userEmail='$userEmail' AND postId='$postId' AND sent='$failed'";
    $RowCheckfail=mysqli_query($conn, $respCheckfail);

    if(mysqli_num_rows($RowCheck) > 0 ){//not functional yet
      $msg = "
        <div class='alert alert-success'>
         <button class='close' data-dismiss='alert'>&times;</button>
         <strong>Sorry!</strong> You applied for this post earlier.<br>
         You can't apply for a post more than once.
          </div>
        ";
    } else if (mysqli_num_rows($RowCheckfail) > 0 ){
      require 'PHPMailer/PHPMailerAutoload.php';
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPSecure = 'tls';
          $mail->SMTPAuth = true;
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = 587;
          $mail->Username = 'beja.emmanuel@gmail.com';
          $mail->Password = '#1Atom .';
          $mail->AddAttachment($_FILES['uploaded_file']['tmp_name'], $_FILES['uploaded_file']['name']);
          $mail->setFrom('DoNotReply@gmail.com', 'Saps');
          $mail->addAddress($companyemail);
          $mail->Subject = 'Saps! Application';
          $mail->Body = " Hello $companyName,
          $userName has just applied for the position you posted.
          Bellow are his/her application credentials and acompanying documents.

          Email: $userEmail
          Phone: $userPhone
          About: $about

          Thank you for using Saps,";
          //send the message, check for errors
          if (!$mail->send()) {
            $msg = "
              <div class='alert alert-danger'>
               <button class='close' data-dismiss='alert'>&times;</button>
               <strong>Sorry!</strong>  Couldnt send email to $companyemail.
                We noticed you are having issues with applying for this post. Please try again later or contact us if you need help.
                </div>
              ";
              $sent="No";

              $SQl = $conn->prepare("INSERT INTO tbl_applicants(companyName, userName, userEmail, userPhone, about, postId, postTime, sent) VALUES(?,?,?,?,?,?,?,?)");
              $SQl->bind_param('ssssssss',$companyName, $userName, $userEmail, $userPhone, $about, $postId, $postTime, $sent);
              $SQl->execute();
              if(!$SQl)
              {
               echo $MySQLiconn->error;
              }

          } else {


            $msg = "
              <div class='alert alert-success'>
               <button class='close' data-dismiss='alert'>&times;</button>
               <strong>Yeey!</strong>  We've sent an email of your application to $companyemail.
               Thank you for trying again. Kindly wait for them to get back to you.
                </div>
              ";
              $sent="Yes";

              $SQL = $conn->prepare("INSERT INTO tbl_applicants(companyName, userName, userEmail, userPhone, about, postId, postTime, sent) VALUES(?,?,?,?,?,?,?,?)");
              $SQL->bind_param('ssssssss',$companyName, $userName, $userEmail, $userPhone, $about, $postId, $postTime, $sent);
              $SQL->execute();
              if(!$SQL)
              {
               echo $MySQLiconn->error;
              }
          }
    } else{

      require 'PHPMailer/PHPMailerAutoload.php';
          $mail = new PHPMailer;
          $mail->isSMTP();
          $mail->SMTPSecure = 'tls';
          $mail->SMTPAuth = true;
          $mail->Host = 'smtp.gmail.com';
          $mail->Port = 587;
          $mail->Username = 'beja.emmanuel@gmail.com';
          $mail->Password = '#1Atom .';
          $mail->AddAttachment($_FILES['uploaded_file']['tmp_name'], $_FILES['uploaded_file']['name']);
          $mail->setFrom('DoNotReply@gmail.com', 'Saps');
          $mail->addAddress($companyemail);
          $mail->Subject = 'Saps! Application';
          $mail->Body = " Hello $companyName,
          $userName has just applied for the position you posted.
          Bellow are his/her application credentials and acompanying documents.

          Email: $userEmail
          Phone: $userPhone
          About: $about

          Thank you for using Saps,";
          //send the message, check for errors
          if (!$mail->send()) {
            $msg = "
              <div class='alert alert-danger'>
               <button class='close' data-dismiss='alert'>&times;</button>
               <strong>Error!</strong>  Couldnt send email to $companyemail.
                             Please try again later.
                </div>
              ";
              $sent="No";

              $SQl = $conn->prepare("INSERT INTO tbl_applicants(companyName, userName, userEmail, userPhone, about, postId, postTime, sent) VALUES(?,?,?,?,?,?,?,?)");
              $SQl->bind_param('ssssssss',$companyName, $userName, $userEmail, $userPhone, $about, $postId, $postTime, $sent);
              $SQl->execute();
              if(!$SQl)
              {
               echo $MySQLiconn->error;
              }

          } else {


            $msg = "
              <div class='alert alert-success'>
               <button class='close' data-dismiss='alert'>&times;</button>
               <strong>Success!</strong>  We've sent an email of your application to $companyemail.
               Kindly wait for them to get back to you.
                </div>
              ";
              $sent="Yes";

              $SQL = $conn->prepare("INSERT INTO tbl_applicants(companyName, userName, userEmail, userPhone, about, postId, postTime, sent) VALUES(?,?,?,?,?,?,?,?)");
              $SQL->bind_param('ssssssss',$companyName, $userName, $userEmail, $userPhone, $about, $postId, $postTime, $sent);
              $SQL->execute();
              if(!$SQL)
              {
               echo $MySQLiconn->error;
              }
          }
    }
     header("refresh:10;field.php");
    }



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

<body id="page-top" onload="startTime()">
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
            <div class="panel panel-default">
              <div class="panel-heading">
                <?php
                echo $msg;
                $res = $conn->query("SELECT * FROM tbl_posts WHERE id='$apply'");
                $Row=$res->fetch_array();
                ?>
                <h4><?php echo $Row['position']; ?></h4>
                <a href="mailto:<?php echo $Row['companyEmail']; ?>"> <i class="fa fa-envelope-o fa-fw"></i><?php echo $Row['companyName']; ?></a>
              </div>
                <div class="panel-body">
                  <div class="list-group">
                    <form method="post" enctype="multipart/form-data">
                      <div class="form-group">
                          <label for="companyName">To</label>
                          <input type="text" name="companyName" placeholder="" class="form-control" value="<?php echo $Row['companyName']?>" autofocus required/>
                      </div>

                      <div class="form-group">
                        <label for="userName">Applicant Name</label>
                          <input type="text" name="userName" placeholder="Your Official Name" class="form-control" required/>
                      </div>

                      <div class="form-group">
                        <label for="userEmail">Email</label>
                          <input type="text" name="userEmail" placeholder="Your email" class="form-control"/>
                      </div>

                        <div class="form-group">
                          <label for="userPhone">Phone Number</label>
                            <input type="text" name="userPhone" placeholder="Your Phone Number" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <label for="about">About</label>
                            <textarea type="text" name="about" placeholder="Short description About you" class="form-control"/></textarea>
                        </div>

                        <div class="form-group">
                            <input type="hidden"  name="postId" placeholder="" value="<?php echo $Row['id']; ?>" class="form-control"/>
                        </div>

                        <div class="form-group">
                            <input type="hidden"  id="postTime" name="postTime" placeholder="" class="form-control"/>
                        </div>

                        <div class="form-group">
                          <label for="uploaded_file">CV</label>
                           <input type="file" name="uploaded_file" id="uploaded_file"/>
                        </div>


                         <button type="submit" class="btn btn-info" name="save">Submit</button>

                      </form>
                  </div>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
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

    <script src="css/morphext/morphext.min.js"></script>

    <script>
   function startTime() {
   var today = new Date();
   document.getElementById("postTime").value = today;
   }
   </script>
</body>
</html>
