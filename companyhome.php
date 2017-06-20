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

/* code for data insert */
if(isset($_POST['save']))
{
     // get values
   	$companyName =  $_POST['companyName'];
   	$companyEmail = $_POST['companyEmail'];
   	$companyPhone = $_POST['companyPhone'];
   	$position =  $_POST['position'];
    $level =  $_POST['level'];
    $category =  $_POST['category'];
   	$detail = $_POST['detail'];
   	$numb  = $_POST['numb'];
   	$postTime = $_POST['postTime'];

  $SQL = $conn->prepare("INSERT INTO tbl_posts(companyName, companyEmail, companyPhone, position, level, category, detail, numb, postTime) VALUES(?,?,?,?,?,?,?,?,?)");
  $SQL->bind_param('sssssssss',$companyName, $companyEmail, $companyPhone, $position, $level, $category,  $detail, $numb, $postTime);
  $SQL->execute();

  if(!$SQL)
  {
   echo $MySQLiconn->error;
  }
}
/* code for data insert */


/* code for data delete */
if(isset($_GET['del']))
{
 $SQL = $conn->prepare("DELETE FROM tbl_posts WHERE id=".$_GET['del']);
 $SQL->bind_param("i",$_GET['del']);
 $SQL->execute();
 header("Location: companyhome.php");
}
/* code for data delete */



/* code for data update */
if(isset($_GET['edit']))
{
 $SQL = $conn->query("SELECT * FROM tbl_posts WHERE id=".$_GET['edit']);
 $Row = $SQL->fetch_array();
}

if(isset($_POST['update']))
{
  // get values
 $companyName =  $_POST['companyName'];
 $companyEmail = $_POST['companyEmail'];
 $companyPhone = $_POST['companyPhone'];
 $position =  $_POST['position'];
 $level =  $_POST['level'];
 $category =  $_POST['category'];
 $detail = $_POST['detail'];
 $numb  = $_POST['numb'];
 $postTime = $_POST['postTime'];

 $SQL = $conn->prepare("UPDATE tbl_posts SET companyName=?, companyEmail=?, companyPhone=?, position=?, level=?, category=?, detail=?, numb=?, postTime=? WHERE id=?");
 $SQL->bind_param("sssssssssi",$companyName, $companyEmail, $companyPhone, $position, $level, $category, $detail, $numb, $postTime, $_GET['edit']);
 $SQL->execute();
 header("Location: companyhome.php");
}
/* code for data update */

if(isset($_GET['applicants']))
{
  $_SESSION['applicants']=$_GET['applicants'];
 header("Location: applicants.php");
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

    <title>Home|Saps</title>

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


<body onload="startTime()">

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

            <ul class="nav navbar-top-links navbar-right">
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

        <div class="row">
        <div class="col-md-10 col-md-offset-1" style="background-color:#f2eded;">
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-8">
                    <div class="panel panel-default">
                      <div class="panel-heading">
                        New Posts
                      </div>
                        <div class="panel-body">
                          <form method="post">
                                                        <div class="form-group">
                                                            <label for="companyName">Name</label>
                                                            <input type="text" name="companyName" placeholder="" class="form-control" value="<?php echo $row['userName']?>" autofocus required/>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="companyEmail">Email</label>
                                                            <input type="text" name="companyEmail" placeholder="Your email" value="<?php echo $row['userEmail']; ?>" class="form-control"/>
                                                        </div>

                                                          <div class="form-group">
                                                              <label for="companyPhone">Phone Number</label>
                                                              <input type="text" name="companyPhone" placeholder="" value="<?php echo $row['userPhone'];  ?>" class="form-control"/>
                                                          </div>

                                                          <div class="form-group">
                                                              <label for="position">Available Position</label>
                                                              <input type="text" name="position" placeholder="Position you are looking for." value="<?php  if(isset($_GET['edit'])){echo $Row['position'];}   ?>" class="form-control"/>
                                                          </div>

                                                              <input type="hidden" name="level" placeholder="" value="Attachment" class="form-control"/>

                                                          <div class="form-group">
                                                            <label for="category">Category</label>
                                                           <select name="category" class="form-control">
                                                             <option value="Bussiness">Business</option>
                                                            <option value="Arts">Arts</option>
                                                            <option value="Education">Education</option>
                                                            <option value="Engineering">Engineering</option>
                                                            <option value="Computing">Computing</option>
                                                            <option value="Media">Media</option>
                                                            <option value="Geology">Geology</option>
                                                            <option value="Health">Health</option>
                                                            <option value="Law">Law</option>
                                                            <option value="Agriculture">Agriculture</option>
                                                            <option value="Architecture">Architecture</option>
                                                            <option value="Appliedsciences">Applied Sciences</option>
                                                            <option value="Mathematics">Mathematics</option>
                                                            <option value="Other">Other</option>
                                                           </select>
                                                           </div>

                                                          <div class="form-group">
                                                              <label for="detail">Detail</label>
                                                              <input type="text" name="detail" placeholder="Explain the position" value="<?php  if(isset($_GET['edit'])){echo $Row['detail'];}   ?>" class="form-control"/>
                                                          </div>

                                                         <div class="form-group">
                                                             <label for="numb">Number</label>
                                                             <input type="text" name="numb" placeholder="Number of people you want for that position" value="<?php  if(isset($_GET['edit'])){echo $Row['numb'];}   ?>" class="form-control"/>
                                                         </div>

                                                          <div class="form-group">
                                                              <label for="postTime"></label>
                                                              <input type="hidden" id="postTime" name="postTime" placeholder="" class="form-control"/>
                                                          </div>
                                                          <?php
                                                          if(isset($_GET['edit']))
                                                          {
                                                           ?>
                                                           <button type="submit" class="btn btn-primary" name="update">Update Record</button>
                                                           <?php
                                                          }
                                                          else
                                                          {
                                                           ?>
                                                           <button type="submit" class="btn btn-primary" name="save">Add Record</button>
                                                           <?php
                                                          }
                                                          ?>
                                                        </form>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>

                <!-- /.col-lg-8 -->
                <div class="col-lg-4">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class="fa fa-upload fa-fw"></i> Posts
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
                                  <i class="pull-right"><a href="?edit=<?php echo $Row['id']; ?>"><span class="fa fa-repeat fa-fw"></span>Edit</a>
                                  <a href="?del=<?php echo $Row['id']; ?>"><span class="fa fa-trash-o fa-fw"></span>Delete</a>
                                  </i>
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
            <!-- /.row -->
        </div>
        </div>
         <!--/#page-wrapper -->

    </div>
    <!-- /#wrapper -->


    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
     <div class="modal-dialog" role="document">
         <div class="modal-content">
             <div class="modal-header">
               <h4></h4>
             </div>
             <div class="modal-body">

             </div>
             <div class="modal-footer">


             </div>
        </div>
    </div>
    </div>
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
