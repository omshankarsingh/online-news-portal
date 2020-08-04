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
    if($_GET['action']='restore')
    {
        $postid=intval($_GET['pid']);
        $query=mysqli_query($con,"update posts set Is_Active=1 where id='$postid'");
        if($query)
        {
            $msg="Post restored successfully";
        }
        else
        {
            $error="Something went wrong. Please try again.";    
        } 
    }
    if($_GET['presid'])
    {
        $id=intval($_GET['presid']);
        $query=mysqli_query($con,"delete from  posts  where id='$id'");
        $delmsg="Post deleted forever";
    }
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="assets/images/favicon.png">
    <title>Deleted Posts</title>
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
                                <h4 class="page-title">Deleted Posts </h4>
                                <ol class="breadcrumb p-0 m-0">
                                    <li>
                                        <a href="#">Admin</a>
                                    </li>
                                    <li>
                                        <a href="dashboard.php">Dashboard</a>
                                    </li>
                                    <li>
                                        <a href="#">Posts</a>
                                    </li>
                                    <li class="active">
                                        Deleted Posts
                                    </li>
                                </ol>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <?php if($delmsg){ ?>
                            <div class="alert alert-danger" role="alert">
                                <strong>Oh snap!</strong> <?php echo htmlentities($delmsg);?></div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card-box">
                                    <div class="table-responsive">
                                        <table class="table table-colored table-centered table-inverse m-0">
                                            <thead>
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Category</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query=mysqli_query($con,"select posts.id as postid,posts.PostTitle as title,categories.CategoryName as category from posts left join categories on categories.id=posts.CategoryId where posts.Is_Active=0");
                                                $rowcount=mysqli_num_rows($query);
                                                if($rowcount==0)
                                                {
                                                ?>
                                                <tr>
                                                    <td colspan="4" align="center">
                                                        <h3 style="color:red">No record found</h3>
                                                    </td>
                                                <tr>
                                                    <?php 
                                                } 
                                                else 
                                                {
                                                    while($row=mysqli_fetch_array($query))
                                                    {
                                                    ?>
                                                <tr>
                                                    <td><b><?php echo htmlentities($row['title']);?></b></td>
                                                    <td><?php echo htmlentities($row['category'])?></td>
                                                    <td>
                                                        <a href="trash-posts.php?pid=<?php echo htmlentities($row['postid']);?>&&action=restore" onclick="return confirm('Do you really want to restore?')"> <i class="ion-arrow-return-right" title="Restore this Post"></i>
                                                        </a>
                                                        &nbsp;
                                                        <a href="trash-posts.php?presid=<?php echo htmlentities($row['postid']);?>&&action=perdel" onclick="return confirm('Do you really want to delete?')">
                                                            <i class="fa fa-trash-o" style="color: #f05050" title="Permanently delete this post"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php } }?>
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
    <script src="plugins/waypoints/jquery.waypoints.min.js"></script>
    <script src="plugins/counterup/jquery.counterup.min.js"></script>
    <script src="plugins/morris/morris.min.js"></script>
    <script src="plugins/raphael/raphael-min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="plugins/jvectormap/gdp-data.js"></script>
    <script src="plugins/jvectormap/jquery-jvectormap-us-aea-en.js"></script>
    <script src="assets/js/jquery.core.js"></script>
    <script src="assets/js/jquery.app.js"></script>
</body>

</html>
<?php } ?>
