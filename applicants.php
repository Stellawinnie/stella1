<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('login.php');
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$conn = mysqli_connect("localhost", "root", "12345678", "attachment");

if(isset($_GET['applicants']))
{
  $_SESSION['applicants']=$_GET['applicants'];
 header("Location: applicants.php");
}

if(isset($_GET['accept']))
{
  $applicantId = $_GET['accept'];
  $status = "Yes";

  $res = $conn->query("SELECT * FROM tbl_applicants WHERE id='$applicantId'");
  $Row=$res->fetch_array();

  $cnme = $Row['companyName'];
  $nme = $Row['userName'];
  $eml = $Row['userEmail'];

  //We are sorry to Inform you that you did not qualify for this post.
  //Please try again later.
  require 'PHPMailer/PHPMailerAutoload.php';
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->SMTPSecure = 'tls';
      $mail->SMTPAuth = true;
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->Username = 'beja.emmanuel@gmail.com';
      $mail->Password = '#1Atom .';
      $mail->setFrom('DoNotReply@gmail.com', 'Saps');
      $mail->addAddress($eml);
      $mail->Subject = 'Saps! Application';
      $mail->Body = "
      Hello $nme,

      Congratulations. You have secured an attachment at $cnme
      More will be communicated.

      Thank you for using Saps,";
      //send the message, check for errors
      if (!$mail->send()) {
        $msg = "
          <div class='alert alert-danger'>
           <button class='close' data-dismiss='alert'>&times;</button>
           <strong>Sorry!</strong>  Couldnt send email.
            We noticed you are having issues with sending your review to ".$nme.".
             Please try again later or contact us if you need help.
            </div>
          ";


      } else {
        $msg = "
          <div class='alert alert-success'>
           <button class='close' data-dismiss='alert'>&times;</button>
           <strong>Success!</strong>  We've sent an Acceptance email to ".$nme."
            </div>
          ";

          $SQL = $conn->prepare("UPDATE tbl_applicants SET status=? WHERE id=?");
          $SQL->bind_param("si", $status, $_GET['accept']);
          $SQL->execute();

      }

 //header("Location: applicants.php");
}

if(isset($_GET['decline']))
{
  $status = "No";

  $applicantId = $_GET['decline'];

  $res = $conn->query("SELECT * FROM tbl_applicants WHERE id='$applicantId'");
  $Row=$res->fetch_array();

  $cnme = $Row['companyName'];
  $nme = $Row['userName'];
  $eml = $Row['userEmail'];


  require 'PHPMailer/PHPMailerAutoload.php';
      $mail = new PHPMailer;
      $mail->isSMTP();
      $mail->SMTPSecure = 'tls';
      $mail->SMTPAuth = true;
      $mail->Host = 'smtp.gmail.com';
      $mail->Port = 587;
      $mail->Username = 'beja.emmanuel@gmail.com';
      $mail->Password = '#1Atom .';
      $mail->setFrom('DoNotReply@gmail.com', 'Saps');
      $mail->addAddress($eml);
      $mail->Subject = 'Saps! Application';
      $mail->Body = "
      Hello $nme,

      We are sorry to Inform you that you did not qualify for the attachment at $cnme.
      Please try again later.

      Thank you for using Saps,";
      //send the message, check for errors
      if (!$mail->send()) {
        $msg = "
          <div class='alert alert-danger'>
           <button class='close' data-dismiss='alert'>&times;</button>
           <strong>Sorry!</strong>  Couldnt send email.
            We noticed you are having issues with sending your review to ".$nme.".
             Please try again later or contact us if you need help.
            </div>
          ";



      } else {


        $msg = "
          <div class='alert alert-success'>
           <button class='close' data-dismiss='alert'>&times;</button>
           <strong>Success</strong>  We've sent an Email to ".$nme."
           on the review.
            </div>
          ";

          $SQL = $conn->prepare("UPDATE tbl_applicants SET status=? WHERE id=?");
          $SQL->bind_param("si", $status, $_GET['decline']);
          $SQL->execute();

           //header("Location: applicants.php");
      }


;
}


$postId = $_SESSION['applicants'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Applicants|Saps</title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Saps</a>
            </div>
            <!-- /.navbar-header -->
            <?php
            $name = $row['userName'];
            $i = 0;
            $res = $conn->query("SELECT * FROM tbl_applicants WHERE companyName='$name' AND postId='$postId'");
            while($Row=$res->fetch_array())
            {
              $i++;
            }
             ?>
            <ul class="nav navbar-top-links navbar-right">

              <li class="dropdown">
                  <a href="companyhome.php"><i class="fa fa-home fa-fw"></i> Home</a>
              </li>
              <li class="dropdown">
                  <a href="applicantsReport.php"><i class="fa fa-home fa-fw"></i> Generate Report</a>
              </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <?php echo $row['userName']?><i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

        </nav>
            <!-- /.row -->
            <div class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="row">
                    <div class="col-md-8">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <?php
                          if(isset($msg)){
                            echo $msg;
                          }?>
                          <?php
                          $response = $conn->query("SELECT * FROM tbl_posts WHERE id='$postId'");
                          $Ro=$response->fetch_array();
                           ?>
                          <h4><?php echo $Ro['position']; ?></h4>
                        </div>
                          <div class="panel-body">
                            <button class="btn btn-lg btn-block btn-info"><i class="fa fa-spinner fa-spin"></i> <?php echo $i; ?> Applicants.</button>
                            <br>
                            <?php
                            $name = $row['userName'];
                            $res = $conn->query("SELECT * FROM tbl_applicants WHERE companyName='$name' AND postId='$postId'");
                            while($Row=$res->fetch_array())
                            {
                              ?>

                              <div class="well">
                              <span class="fa fa-user"><a href="mailto:<?php echo $Row['userEmail']; ?>"><?php echo $Row['userName']; ?></a></span>
                              <span class="pull-right">0<?php echo $Row['userPhone']; ?></span>
                              <hr>
                              <span><?php echo $Row['about']; ?></span>
                              <hr>
                              <?php
                              $acc = "Yes";
                              $den = "No";
                               if($Row['status']==$acc){
                               ?>
                               <a href="?accept=<?php echo $Row['id']; ?>"><span class="fa fa-check" style="color:green">Accept</span></a>
                               <a href="?decline=<?php echo $Row['id']; ?>"><span class="fa fa-times">Decline</span></a>
                               <?php
                              }else if($Row['status']==$den){
                                ?>
                                <a href="?accept=<?php echo $Row['id']; ?>"><span class="fa fa-check">Accept</span></a>
                                <a href="?decline=<?php echo $Row['id']; ?>"><span class="fa fa-times" style="color:green">Decline</span></a>
                               <?php
                              }else{
                                ?>
                                <a href="?accept=<?php echo $Row['id']; ?>"><span class="fa fa-check">Accept</span></a>
                                <a href="?decline=<?php echo $Row['id']; ?>"><span class="fa fa-times">Decline</span></a>
                                <?php
                              }?>

                              <span class="pull-right text-muted"><?php echo $Row['postTime']; ?></span>
                            </div>
                              <br>
                              <?php
                            }
                             ?>
                          </div>
                          <!-- /.panel-body -->
                      </div>
                      <!-- /.panel -->



                    </div>

                    <!-- /.col-lg-8 -->
                    <div class="col-lg-4">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i> Posts
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="list-group">
                                  <?php
                                  $name = $row['userName'];
                                  $res = $conn->query("SELECT * FROM tbl_posts WHERE companyName='$name'");
                                  while($Row=$res->fetch_array())
                                  {
                                   ?>
                                  <span class="list-group-item">
                                      <a href="?applicants=<?php echo $Row['id']; ?>"><span class="fa fa-folder-open-o fa-fw"></span>View</a>
                                      <span><h3><?php echo $Row['position']; ?></h3></span>
                                      <span><?php echo $Row['detail']; ?></span><br>
                                      <span class="text-muted fa fa-user fa-fw"><?php echo $Row['numb']; ?></span>

                                      <span class="text-muted pull-right"><?php echo $Row['postTime']; ?></span>

                                  </span>
                                  <?php
                                  }
                                  ?>
                                </div>
                                <!-- /.list-group -->
                            </div>
                            <!-- /.panel-body -->
                        </div>
                        <!-- /.panel -->
                    </div>
                    <!-- /.col-lg-6 -->

                  </div>

                </div>


            </div>
            <!-- /.row -->

    </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>


    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>

    <script>
function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById("postTime").value = h + ":" + m + ":" + s;
    var t = setTimeout(function(){ startTime() }, 10);
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}
</script>
</body>

</html>
