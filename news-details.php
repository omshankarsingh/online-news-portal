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
    <title>News Details</title>
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="container">
        <div class="row" style="margin-top: 3%">
            <?php
            $pid=intval($_GET['nid']);
            $query=mysqli_query($con,"select posts.PostTitle as posttitle,posts.PostImage,categories.CategoryName as category,categories.id as cid,posts.PostDetails as postdetails,posts.PostingDate as postingdate,posts.PostUrl as url from posts left join categories on categories.id=posts.CategoryId where posts.id='$pid'");
            while ($row=mysqli_fetch_array($query)) 
            {
            ?>
            <div class="col-lg-8 col-md-10 mx-auto">
                <h1><?php echo htmlentities($row['posttitle']);?></h1>
                <div class="row">
                    <div class="col d-flex justify-content-start">
                        <a href="category.php?catid=<?php echo htmlentities($row['cid'])?>">
                            <?php echo htmlentities($row['category']);?>
                        </a>
                    </div>
                    <div class="col d-flex justify-content-end">
                        Posted on <?php echo htmlentities($row['postingdate']);?>
                    </div>
                </div>
                <hr />
                <img class="img-fluid rounded" src="admin/postimages/<?php echo htmlentities($row['PostImage']);?>" alt="<?php echo htmlentities($row['posttitle']);?>">
                <hr />
                <p class="card-text"><?php 
                $pt=$row['postdetails'];
                echo(substr($pt,0));?></p>
            </div>
            <?php } ?>
        </div>
    </div>
    <?php include('includes/footer.php');?>
</body>

</html>
