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


if(isset($_POST['btn-edit-profile']))
{
 $uname = $_POST['name'];
 $uphone = $_POST['phone'];
 $umail = $_POST['email'];

 $stmt = $user_home->runQuery("UPDATE users SET userName=:nam, userPhone=:phon, userEmail=:mail WHERE userID=:uid");
 $stmt->execute(array(":nam"=>$uname,":phon"=>$uphone, ":mail"=>$umail,":uid"=>$row['userID']));
header("refresh:0;userProfile.php");
 $msg = "<div class='alert alert-success'>
 <button class='close' data-dismiss='alert'>&times;</button>
  Profile updated.
 </div>";
}

$conn = mysqli_connect("localhost", "root", "12345678", "attachment");

if(isset($_POST['editpic'])){
  header("Location: userProfile.php");
}

if(isset($_GET['category']))
{
  $_SESSION['category']=$_GET['category'];
 header("Location: category.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Profile | Saps</title>

    <!-- Bootstrap CSS File  -->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap-3.3.5-dist/css/bootstrap.css"/>

    <!-- Custom CSS -->
    <link href="dist/css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- jQuery -->
    <script src="vendor/jquery/jquery.min.js"></script>
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
              <a class="navbar-brand" href="index.php">Veve</a>
          </div>
          <!-- /.navbar-header -->

          <ul class="nav navbar-top-links navbar-right">
            <li>
                <a href="home.php"><i class="fa fa-home fa-fw"></i>Home</a>
            </li>
            <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-th-list fa-fw"></i>
                Categories <i class="fa fa-caret-down"></i>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li><a href="?category=Business"><i class="fa fa-book fa-fw"></i> Businesss</a>
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
            <!-- /.dropdown-user -->
        </li>
            <li><span>
            <button class="btn btn-outline btn-primary" data-toggle="modal" data-target="#companies">Companies</button>
            </span></li>
                <!-- /.dropdown -->
                    <li class="dropdown get_tooltip" data-toggle="tooltip" data-placement="bottom" title="Click to view your profile or logout">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                            Hello <?php echo $row['userName']?>!
                            <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-user">
                            <li><a href="userProfie.php"><i class="fa fa-user fa-fw"></i> Profile</a>
                            </li>
                            <li class="divider"></li>
                            <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                            </li>
                        </ul>
                        <!-- /.dropdown-user -->
                    </li>
          </ul>

          <!-- /.navbar-top-links -->
          <div class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">
          <div class="panel panel-default">
                <div class="panel-heading">
                  <?php
                  $name = $row['userName'];
                  $response = $conn->query("SELECT * FROM tbl_prof WHERE userName='$name'");
                  $prow = $response->fetch_array();
                  $_SESSION['picName'] = $prow['userName'];
                  if (!$prow['image']){
                    ?>
                    <img src="upload/noimage-team.png" class="img-responsive img-circle" alt="">
                    <?php
                  } else{
                    ?>
                    <img src="upload/<?php echo $prow['image']; ?>" class="img-responsive img-circle" alt=""></br>
                    <?php
                  }
                   ?>
                  <form role="form" method="post">
                  <button class="btn btn-outline btn-primary btn-block" name="editpic">Edit Profile</button>
                  </form>
                </div>
                <div class="panel-body">
                </div>
                <!-- /.panel-body -->
            </div>
        </div>
    </div>
      </nav>

      <div id="page-wrapper">
          <!-- /.row -->
          <div class="row">
              <div class="col-lg-8">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <i class="fa fa-image"></i>
                      </div>
                      <div class="panel-body">
                        <span id="message"></span>
                        <?php
                        $name = $_SESSION['picName'];
                        $re = $conn->query("SELECT * FROM tbl_prof WHERE userName='$name'");
                        $rows = $re->fetch_array();
                        if (!$rows){
                          ?>
                          <form id="uploadimage" action="" method="post">
                          <div id="image_preview" ><center><img id="previewing" src="//placehold.it/600x350/99223" class="img-responsive img-circle"/></center></div>
                          <hr id="line">
                          <label>Add Profile Picture</label><br/>
                          <div class="form-group">
                          <input type="hidden" name="userName" id="userName" placeholder="" value="<?php echo $row['userName']?>"  required />
                          </div>
                          <div class="form-group">
                          <input type="file" name="file" id="file" required />
                          </div>
                          <div class="form-group" >
                          <input type="submit" value="Upload" class="btn  btn-info btn-block" />
                          </div>
                          </form>
                          <?php
                        }else{
                          ?>
                          <form id="editimage" action="" method="post">
                          <div id="image_preview" ><center><img id="previewing" src="//placehold.it/600x350/99223" class="img-responsive"/></center></div>
                          <hr id="line">
                          <label>Edit Profile Picture</label><br/>
                          <div class="form-group">
                          <input type="hidden" name="userName" id="userName" placeholder="User Name" value="<?php echo $row['userName']?>"  required />
                          </div>
                          <div class="form-group">
                          <input type="file" name="file" id="file" required />
                          </div>
                          <div class="form-group">
                          <input type="hidden" name="id" value="<?php echo $rows['id']; ?>" required />
                          </div>
                          <div class="form-group" >
                          <input type="submit"  value="Edit" class="btn btn-info btn-block" />
                          </div>
                          </form>
                          <?php
                        }
                          ?>

                      </div>
                      <!-- /.panel-body -->
                  </div>

              </div>

              <!-- /.col-lg-8 -->
              <div class="col-lg-4">
                  <div class="panel panel-default">
                      <div class="panel-heading">
                          <i class="fa fa-user fa-fw"></i>Details
                      </div>
                      <!-- /.panel-heading -->
                      <div class="panel-body">
                          <div class="list-group">
                               <div id="" style="width:100%;height:100%;">
                                     <form class="form-signin" method="post">
                                     <?php
                                     if(isset($msg))
                                      {
                                       echo $msg;
                                      }
                                      ?>
                                       <div class="form-group">
                                         <label for="name">User Name</label>
                                         <input  class="form-control input-block" placeholder="" name="name" value="<?php echo $row['userName']?>" autofocus required />
                                       </div>
                                       <div class="form-group">
                                         <label for="email">Email</label>
                                     <input  class="form-control input-block" placeholder="" name="email" value="<?php echo $row['userEmail']?>" type="email" required />
                                     </div>
                                     <div class="form-group">
                                       <label for="phone">Phone Number</label>
                                     <input  class="form-control input-block" placeholder="" name="phone" value="<?php echo $row['userPhone']?>" required />
                                     </div>
                                     <hr/>
                                     <button class="btn btn-large btn-primary btn-block" type="submit" name="btn-edit-profile">Edit Profile</button>

                                   </form>
                               </div>

                          </div>
                          <!-- /.list-group -->
                      </div>
                      <!-- /.panel-body -->
                  </div>
                  <!-- /.panel -->
              </div>
              <!-- /.col-lg-6 -->
          </div>
          <!-- /.row -->
      </div>
      <!-- /#page-wrapper -->

  </div>


<!-- image JS file-->
<script src="script.js"></script>
<!-- image JS file edit-->
<script src="piceditscript.js"></script>


<!-- Bootstrap Core JavaScript -->
<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="vendor/metisMenu/metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="dist/js/sb-admin-2.js"></script>

</body>
</html>
