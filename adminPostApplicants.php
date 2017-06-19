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

$postId = $_SESSION['applicants'];
$i = 0;
$res = $conn->query("SELECT * FROM tbl_applicants WHERE postId='$postId'");
while($Row=$res->fetch_array())
{
  $i++;
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

    <title>Admin|Saps</title>
    <!--ajax crud-->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">

<link rel="stylesheet" type="text/css" href="css/bootstrap-theme.min.css">

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
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">Saps|Admin</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li>
                  <li><a href="adminhome.php"><i class="fa fa-home fa-fw"></i> Home</a>
                </li>

                <li >
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Hello <?php echo $row['userName']; ?>! Logout</a>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

            <!-- /.row -->
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                  <div class="panel panel-default">
                    <div class="panel-heading">
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
                        $response = $conn->query("SELECT * FROM tbl_posts WHERE id='$postId'");
                        $Ro=$response->fetch_array();
                         ?>
                        <h4><?php echo $Ro['position']; ?></h4>
                      </div>
                        <div class="panel-body">
                          <?php
                          $res = $conn->query("SELECT * FROM tbl_applicants WHERE postId='$postId'");
                          while($Row=$res->fetch_array())
                          {
                            ?>

                            <div class="well">
                            <span class="fa fa-user"><a href="mailto:<?php echo $Row['userEmail']; ?>"><?php echo $Row['userName']; ?></a></span>
                            <span class="pull-right">0<?php echo $Row['userPhone']; ?></span>
                            <hr>
                            <span><?php echo $Row['about']; ?></span>
                            <hr>
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
            </div>
            <!-- /.row -->

    </div>
    <!-- /#wrapper -->



   <!-- ajax CRUD-->
   <script src="js/jquery-2.2.0.min.js"></script>

   <script src="js/bootstrap.min.js"></script>

   <script type="text/javascript" src="app.js"></script>

    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="dist/js/sb-admin-2.js"></script>
    <!-- validity timer -->
    <script type="text/javascript">
      function countdown(){
        var now = new Date();
        var currentTime = now.getTime();
        var eventDate = new Date(2017,6,27);
        //eventDate.setDate(27);//doesnt seem to work
        eventDate.setHours(21);
        eventDate.setMinutes(00);
        var eventTime = eventDate.getTime();

        var remTime = eventTime - currentTime;

        var s = Math.floor(remTime / 1000);
        var m = Math.floor(s / 60);
        var h = Math.floor(m / 60);
        //var d = Math.floor(h / 24);

        h %=24;
        m %=60;
        s %=60;

        h = (h < 10) ? "0" + h :h;
        m = (m < 10) ? "0" + m :m;
        s = (s < 10) ? "0" + s :s;

        //document.getElementById("days").textContent = d;//not supported in ie8 and earlier versions
        //document.getElementById("days").innerText = d;//to suport ie8 and earlier versions

        document.getElementById("hours").textContent = h;
        document.getElementById("minutes").textContent = m;
        document.getElementById("seconds").textContent = s;

        setTimeout(countdown, 1000);
        }
      countdown();
    </script>
</body>

</html>
