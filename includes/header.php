<header class="py-3">
    <div class="nav d-flex justify-content-center">
        <div class="col-4 d-flex justify-content-center align-items-end">
            <p id="demo"></p>
        </div>
        <div class="col-4 text-center">
                <a class="navbar-brand" href="index.php"><img src="images/logo.png" style="max-width:100%;height:auto;"></a>
        </div>
        <div class="col-4 d-flex justify-content-start align-items-center">
            <form name="search" action="search.php" method="post">
                <div class="input-group">
                    <input type="text" name="searchtitle" class="form-control" style="border-color:transparent;" required>
                    <span class="input-group-btn">
                        <button class="btn btn btn-light" type="submit">Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
</header>

<script>
    var d = new Date();
    document.getElementById("demo").innerHTML = d.toDateString();
</script>
