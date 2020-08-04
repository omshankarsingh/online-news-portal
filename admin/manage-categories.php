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
    if($_GET['action']=='del' && $_GET['rid'])
    {
	   $id=intval($_GET['rid']);
	   $query=mysqli_query($con,"update categories set Is_Active='0' where id='$id'");
	   $msg="Category deleted";
    }
    if($_GET['resid'])
    {
	   $id=intval($_GET['resid']);
	   $query=mysqli_query($con,"update categories set Is_Active='1' where id='$id'");
	   $msg="Category restored successfully";
    }
    if($_GET['action']=='parmdel' && $_GET['rid'])
    {
	   $id=intval($_GET['rid']);
	   $query=mysqli_query($con,"delete from  categories where id='$id'");
	   $delmsg="Category deleted forever";
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <title>Manage Categories</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/core.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/components.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/icons.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/menu.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/responsive.css" rel="stylesheet" type="text/css" />
    <script src="assets/js/modernizr.min.js"></script>
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
                                <h4 class="page-title">Manage Categories</h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li>
                                        <a href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="#">Category</a>
                                    </li>
                                    <li class="active">
                                        Manage Categories
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if($msg){ ?>
                            <div class="alert alert-success" role="alert">
                                <strong>Well done!</strong> <?php echo htmlentities($msg);?>
                            </div>
                            <?php } ?>
                            <?php if($delmsg){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?></div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo-box m-t-20">
                                    <div class="m-b-30">
                                        <a href="add-category.php">
                                            <button id="addToTable" class="btn btn-success waves-effect waves-light">Add <i class="mdi mdi-plus-circle-outline"></i></button>
                                        </a>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-primary">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Category</th>
                                                    <th>Description</th>
                                                    <th>Posting date</th>
                                                    <th>Last updation date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query=mysqli_query($con,"Select id,CategoryName,Description,PostingDate,UpdationDate from categories where Is_Active=1");
                                                $cnt=1;
                                                while($row=mysqli_fetch_array($query))
                                                {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                    <td><?php echo htmlentities($row['CategoryName']);?></td>
                                                    <td><?php echo htmlentities($row['Description']);?></td>
                                                    <td><?php echo htmlentities($row['PostingDate']);?></td>
                                                    <td><?php echo htmlentities($row['UpdationDate']);?></td>
                                                    <td>
                                                        <a href="edit-category.php?cid=<?php echo htmlentities($row['id']);?>">
                                                            <i class="fa fa-pencil" style="color: #29b6f6;"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="manage-categories.php?rid=<?php echo htmlentities($row['id']);?>&&action=del"> 
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                $cnt++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="demo-box m-t-20">
                                    <div class="m-b-30">
                                        <h4><i class="fa fa-trash-o"></i>Deleted Categories</h4>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table m-0 table-colored-bordered table-bordered-danger">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th> Category</th>
                                                    <th>Description</th>
                                                    <th>Posting date</th>
                                                    <th>Last updation date</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php 
                                                $query=mysqli_query($con,"Select id,CategoryName,Description,PostingDate,UpdationDate from  categories where Is_Active=0");
                                                $cnt=1;
                                                while($row=mysqli_fetch_array($query))
                                                {
                                                ?>
                                                <tr>
                                                    <th scope="row"><?php echo htmlentities($cnt);?></th>
                                                    <td><?php echo htmlentities($row['CategoryName']);?></td>
                                                    <td><?php echo htmlentities($row['Description']);?></td>
                                                    <td><?php echo htmlentities($row['PostingDate']);?></td>
                                                    <td><?php echo htmlentities($row['UpdationDate']);?></td>
                                                    <td>
                                                        <a href="manage-categories.php?resid=<?php echo htmlentities($row['id']);?>">
                                                            <i class="ion-arrow-return-right" title="Restore this category"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="manage-categories.php?rid=<?php echo htmlentities($row['id']);?>&&action=parmdel" title="Delete forever">
                                                            <i class="fa fa-trash-o" style="color: #f05050"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                    $cnt++;
                                                } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('includes/footer.php');?>
            </div>
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
