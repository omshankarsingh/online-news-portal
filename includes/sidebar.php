<aside class="col-md-4 blog-sidebar">
    <div class="p-2">
        <h4>Categories</h4>
        <ol class="list-unstyled mb-0">
            <?php $query=mysqli_query($con,"select id,CategoryName from categories");while($row=mysqli_fetch_array($query)) 
            {
            ?>
            <li>
                <h6><a href="category.php?catid=<?php echo htmlentities($row['id'])?>"><?php echo htmlentities($row['CategoryName']);?></a></h6>
            </li>
            <?php } ?>
        </ol>
    </div>
    <div class="p-2">
        <h4>Recent News</h4>
        <ol class="list-unstyled mb-3">
            <?php
            $query=mysqli_query($con,"select posts.id as pid,posts.PostTitle as posttitle from posts left join categories on categories.id=posts.CategoryId limit 8");
            while ($row=mysqli_fetch_array($query)) {
            ?>
            <li>
                <h6><a href="news-details.php?nid=<?php echo htmlentities($row['pid'])?>"><?php echo htmlentities($row['posttitle']);?></a></h6>
            </li>
            <?php } ?>
        </ol>
    </div>
</aside>
