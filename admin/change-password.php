<?php
session_start();
include('includes/config.php');
error_reporting(0);
if(strlen($_SESSION['login'])==0) 
{ 
    header('location:index.php');
} 
else 
{   
    if(isset($_POST['submit'])) 
    {   
        $password=$_POST['password'];
        $options = ['cost' => 12];
        $hashedpass=password_hash($password, PASSWORD_BCRYPT, $options);
        $adminid=$_SESSION['login'];
        $newpassword=$_POST['newpassword'];
        $newhashedpass=password_hash($newpassword, PASSWORD_BCRYPT, $options);
        date_default_timezone_set('Asia/Kolkata');
        $currentTime = date( 'd-m-Y h:i:s A', time () );
        $sql=mysqli_query($con,"SELECT AdminPassword FROM  admin where AdminUserName='$adminid' || AdminEmailId='$adminid'");
        $num=mysqli_fetch_array($sql);
        if($num>0) 
        {   
            $dbpassword=$num['AdminPassword'];
            if (password_verify($password, $dbpassword)) 
            {   
                $con=mysqli_query($con,"update admin set AdminPassword='$newhashedpass', updationDate='$currentTime' where AdminUserName='$adminid'");
                $msg="Password changed successfully";
            }
        } 
        else 
        {   
            $error="Old password not matched";
        }
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <title>Change Password</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/modernizr.min.js"></script>
    <script type="text/javascript">
        function valid() {
            if (document.chngpwd.newpassword.value != document.chngpwd.confirmpassword.value) {
                alert("Password and Confirm Password Field do not match");
                document.chngpwd.confirmpassword.focus();
                return false;
            }
            return true;
        }
    </script>
</head>

<body class="fixed-left">
    <div id="wrapper">
        <?php include('includes/topheader.php');?>
        <?php include('includes/leftsidebar.php');?>
        <div class="content-page">
            <div class="content">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="page-title-box">
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li class="active">
                                        <a href="#">Change Password</a>
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box">
                                <h4 class="m-t-0 header-title"><b>Change Password</b></h4>
                                <hr />
                                <div class="row">
                                    <div class="col-sm-6">
                                        <?php if($msg){ ?>
                                        <div class="alert alert-success" role="alert">
                                            <strong>Well done!&nbsp;</strong><?php echo htmlentities($msg);?>
                                        </div>
                                        <?php } ?>

                                        <?php if($error){ ?>
                                        <div class="alert alert-danger" role="alert">
                                            <strong>Oh snap!&nbsp;</strong><?php echo htmlentities($error);?>
                                        </div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-10">
                                        <form class="form-horizontal" name="chngpwd" method="post" onSubmit="return valid();">

                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Current Password</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="" name="password" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">New Password</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="" name="newpassword" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">Confirm Password</label>
                                                <div class="col-md-8">
                                                    <input type="text" class="form-control" value="" name="confirmpassword" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-4 control-label">&nbsp;</label>
                                                <div class="col-md-8">
                                                    <button type="submit" class="btn btn-custom waves-effect waves-light btn-md" name="submit">Change Password</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php include('includes/footer.php');?>
        </div>
    </div>
    <script>
        var resizefunc = [];
    </script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/detect.js"></script>
    <script src="assets/js/fastclick.js"></script>
    <script src="assets/js/jquery.blockUI.js"></script>
    <script src="assets/js/waves.js"></script>
    <script src="assets/js/jquery.slimscroll.js"></script>
    <script src="assets/js/jquery.scrollTo.min.js"></script>
    <script src="plugins/switchery/switchery.min.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
</body>

</html>
<?php } ?>
