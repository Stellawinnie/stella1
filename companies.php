<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
 $user_home->redirect('login.php');
}


if(isset($_GET['applicants'])){
  $_SESSION['companyName'] = $_GET['applicants'];
  header("location:adminApplicants.php");
}

if(isset($_GET['posts'])){
  $_SESSION['companyName'] = $_GET['posts'];
  header("location:adminPosts.php");
}

$stmt = $user_home->runQuery("SELECT * FROM users WHERE userID=:uid");
$stmt->execute(array(":uid"=>$_SESSION['userSession']));
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$conn = mysqli_connect("localhost", "root", "12345678", "attachment");


/* code for data delete */
if(isset($_GET['del']))
{
 $SQL = $conn->prepare("DELETE FROM users WHERE userID=".$_GET['del']);
 $SQL->bind_param("i",$_GET['del']);
 $SQL->execute();
 header("Location: adminhome.php");
}
/* code for data delete */
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
                  <button class="btn btn-info" onclick="printContent('companies')">Print Companies</button>
                </li>
                <li>
                        <li><a href="adminhome.php"><i class="fa fa-home fa-fw"></i>Home</a>
                </li>
                <li>
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i>Hello <?php echo $row['userName']; ?>! Logout</a>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>
            <!-- /.row -->

            <div id="companies" class="row">
                <div class="col-md-8 col-md-offset-2">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                          <i class="fa fa-group fa-fw">Companies</i>
                      </div>
                        <div class="panel-body">
                          <div class="well">
                            <center>Companies Report</center>
                          </div>
                          <table>
                            <tr>
                              <th style="width:40%;">
                                Company Name
                              </th>
                              <th style="width:40%;">
                                Phone Number
                              </th>
                              <th style="width:40%;">
                                Email
                              </th>
                            </tr>
                            <?php
                            $query = "SELECT * from users ";
                            $result = mysqli_query($conn, $query);
                            $row = mysqli_fetch_assoc($result);
                             while($row = mysqli_fetch_assoc($result)){ ?>
                            <tr>
                              <td>
                                <?php echo $row['userName']; ?>
                              </td>
                              <td>
                                <?php echo $row['userPhone']; ?>
                              </td>
                              <td>
                                <?php echo $row['userEmail']; ?>
                              </td>
                            </tr>
                            <?php } ?>
                          </table>

                        </div>
                    </div>
                </div>
                <!-- /.col-lg-8 -->
                <!-- /.col-lg-4 -->
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

</body>

</html>
