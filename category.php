<?php 
session_start();
error_reporting(0);
include('includes/config.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <title>The Gazette of India</title>
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="container">
        <div class="row" style="margin-top: 4%">
            <div class="col-md-8">
                <?php 
                if($_GET['catid']!='')
                {
                    $_SESSION['catid']=intval($_GET['catid']);
                }
                if (isset($_GET['pageno'])) 
                {
                    $pageno = $_GET['pageno'];
                } 
                else 
                {
                    $pageno = 1;
                }
                $no_of_records_per_page = 8;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM posts";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query=mysqli_query($con,"select posts.id as pid,posts.PostTitle as posttitle,posts.PostImage,categories.CategoryName as category,posts.PostDetails as postdetails,posts.PostingDate as postingdate,posts.PostUrl as url from posts left join categories on categories.id=posts.CategoryId where posts.CategoryId='".$_SESSION['catid']."' and posts.Is_Active=1 order by posts.id desc LIMIT $offset, $no_of_records_per_page");
                $rowcount=mysqli_num_rows($query);
                if($rowcount==0)
                {
                    echo "No record found";
                }
                else 
                {
                    while ($row=mysqli_fetch_array($query)) 
                {
                ?>
                <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>">
                    <div class="card mb-4" style="border-color:transparent;">
                        <div class="card-body d-flex flex-column align-items-start">
                            <strong class="d-inline-block mb-2 text-primary"><?php echo htmlentities($row['category']);?></strong>
                            <h5 class="card-title"><?php echo htmlentities($row['posttitle']);?></h5>
                            <div class="mb-1 text-muted">
                                Posted on <?php echo htmlentities($row['postingdate']);?>
                            </div>
                        </div>
                    </div>
                </a>
                <?php } ?>
                <ul class="pagination justify-content-center mb-4">
                    <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
                    <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                        <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Previous</a>
                    </li>
                    <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                        <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
                    </li>
                    <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
                </ul>
                <?php } ?>
            </div>
            <?php include('includes/sidebar.php');?>
        </div>
    </div>
    <?php include('includes/footer.php');?>
</body>

</html>
