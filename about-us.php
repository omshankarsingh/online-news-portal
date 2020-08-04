<?php
include('includes/config.php');
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="images/favicon.png">
    <title>About us</title>
    <link href="styles/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>

<body>
    <?php include('includes/header.php');?>
    <div class="container">
        <?php 
        $pagetype='aboutus';
        $query=mysqli_query($con,"select PageTitle,Description from pages where PageName='$pagetype'");
        while($row=mysqli_fetch_array($query))
        {
        ?>
        <h2 class="mt-4 mb-3"><?php echo htmlentities($row['PageTitle'])?></h2>
        <div class="row">
            <div class="col-lg-12">
                <p><?php echo $row['Description'];?></p>
            </div>
        </div>
        <?php } ?>
    </div>
    <?php include('includes/footer.php');?>
</body>

</html>
