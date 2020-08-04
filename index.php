<?php 
session_start();
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
    <div class="nav-scroller py-1 mb-2">
        <nav class="nav d-flex justify-content-center">
            <?php $query=mysqli_query($con,"select id,CategoryName from categories");while($row=mysqli_fetch_array($query)) 
            {
            ?>
            <a class="p-2 text-dark" href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a>
            <?php } ?>
        </nav>
    </div>
    <div class="container">
        <div class="row" style="margin-top: 2%">
            <div class="card-deck">
                <?php 
                if (isset($_GET['pageno'])) 
                {
                    $pageno = $_GET['pageno'];
                } 
                else 
                {
                    $pageno = 1;
                }
                $no_of_records_per_page = 6;
                $offset = ($pageno-1) * $no_of_records_per_page;
                $total_pages_sql = "SELECT COUNT(*) FROM posts";
                $result = mysqli_query($con,$total_pages_sql);
                $total_rows = mysqli_fetch_array($result)[0];
                $total_pages = ceil($total_rows / $no_of_records_per_page);
                $query=mysqli_query($con,"select posts.id as pid,posts.PostTitle as posttitle,posts.PostImage,categories.CategoryName as category,categories.id as cid,posts.PostDetails as postdetails,posts.PostingDate as postingdate,posts.PostUrl as url from posts left join categories on categories.id=posts.CategoryId where posts.Is_Active=1 order by posts.id desc  LIMIT $offset, $no_of_records_per_page");
                while ($row=mysqli_fetch_array($query)) 
                {
                    ?>
                <div class="col-sm-4">
                    <div class="card m-3">
                        <img class="card-img-top" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
                        <div class="card-body">
                            <strong class="d-inline-block mb-2 text-dark">
                                <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>">
                                    <?php echo htmlentities($row['category']);?>
                                </a>
                            </strong>
                            <h6 class="card-title"><?php echo htmlentities($row['posttitle']);?></h6>
                            <div class="mb-1 text-muted">
                                Posted on <?php echo htmlentities($row['postingdate']);?>
                            </div>
                            <a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>">Continue reading</a>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <ul class="pagination justify-content-center mb-4" style="margin-top: 3%">
            <li class="page-item"><a href="?pageno=1" class="page-link">First</a></li>
            <li class="<?php if($pageno <= 1){ echo 'disabled'; } ?> page-item">
                <a href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>" class="page-link">Previous</a>
            </li>
            <li class="<?php if($pageno >= $total_pages){ echo 'disabled'; } ?> page-item">
                <a href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?> " class="page-link">Next</a>
            </li>
            <li class="page-item"><a href="?pageno=<?php echo $total_pages; ?>" class="page-link">Last</a></li>
        </ul>
    </div>
    <?php include('includes/footer.php');?>
</body>

</html>
