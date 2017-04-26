<div class="col-md-4">


    <!-- Blog Search Well -->
    <div class="well">
        <h4>Blog Search</h4>

        <form action="search.php" method="post">
            <div class="input-group">
                <input name="search" type="text" class="form-control">
                <span class="input-group-btn">
                    <button name="submit" class="btn btn-default" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </span>
            </div>
        </form><!--search form-->
        <!-- /.input-group -->
    </div>

    <!-- Login -->
    <div class="well">
        <h4>Login</h4>

        <form action="includes/login.php" method="POST">
           
            <div class="form-group">
                <input class="form-control" name="username" type="text" placeholder="Enter Username">

            </div>

            <div class="input-group">
                <input class="form-control" name="password" type="password" placeholder="Enter Password">
                <span class="input-group-btn">
                    <button class="btn btn-primary" name="login" type="submit">Submit</button>
                </span>

            </div>
        </form>
    </div>




    <!-- Blog Categories Well -->
    <div class="well">
        <?php

        $sql = "SELECT * FROM categories";

        $query = mysqli_query($conn, $sql);

        ?>
        <h4>Blog Categories</h4>
        <div class="row">
            <div class="col-lg-12">
                <ul class="list-unstyled">
                    <?php          
                    while($row = mysqli_fetch_assoc($query)){
                        $cat_title = $row['cat_title']; 
                        $cat_id = $row['cat_id']; 

                        echo "<li><a href='category.php?category=$cat_id'>{$cat_title}  </a></li>";
                    }
                    ?>
                </ul>
            </div>

            <!-- /.col-lg-12 -->


        </div>
        <!-- /.row -->
    </div>

    <!-- Side Widget Well -->
    <?php include "widget.php";  ?>

</div>