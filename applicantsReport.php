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

    <script>
    function printContent(el){
    	var restorepage = document.body.innerHTML;
    	var printcontent = document.getElementById(el).innerHTML;
    	document.body.innerHTML = printcontent;
    	window.print();
    	document.body.innerHTML = restorepage;
    }
    </script>
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
                  <button class="btn btn-info" onclick="printContent('applicants')">Print Applicants</button>
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
            <div  class="row">
                <div class="col-md-10 col-md-offset-1">
                  <div class="row">

                    <div id="applicants" class="col-md-12">
                      <div class="panel panel-default">
                        <div class="panel-heading">
                          <?php
                          $response = $conn->query("SELECT * FROM tbl_posts WHERE id='$postId'");
                          $Ro=$response->fetch_array();
                           ?>
                          <h4><?php echo $Ro['position']; ?> <span class="pull-right"><?php echo $i; ?> applicants</span></h4>

                        </div>
                          <div class="panel-body">
                            <br>

                            <?php
                            $name = $row['userName'];
                            $res = $conn->query("SELECT * FROM tbl_applicants WHERE companyName='$name' AND postId='$postId'");
                            while($Row=$res->fetch_array())
                            {
                              ?>

                              <span class=""><h4>Name:<?php echo $Row['userName']; ?></h4></span>
                              <span class="pull-right">0<?php echo $Row['userPhone']; ?></span>
                              <hr>
                              <h4>About</h4>
                              <span><?php echo $Row['about']; ?></span>
                              <hr>
                              <span class="text-muted"><?php echo $Row['postTime']; ?></span>
                              <br>
                              <hr>
                              <hr>
                              <?php
                            }
                             ?>
                          </div>
                          <!-- /.panel-body -->
                      </div>
                      <!-- /.panel -->



                    </div>



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
