<?php include "includes/admin_header.php" ?>

<div id="wrapper">

<!-- Navigation -->
   
    <?php include "includes/admin_navigation.php" ?> 


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to admin

                        <small><?php echo $_SESSION['username']; ?></small>
                    </h1>
                    
                </div>
            </div>
            <!-- /.row -->


            <!-- /.row -->

            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-file-text fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php
                                    $sql = "SELECT * FROM posts";
                                    $query = mysqli_query($conn, $sql);

                                    confirm($query);

                                    $post_count = mysqli_num_rows($query);

                                    echo "<div class='huge'>$post_count</div>";
                                    ?>


                                    <div>Posts</div>
                                </div>
                            </div>
                        </div>
                        <a href="post.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-comments fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">

                                    <?php

                                    $sql = "SELECT * FROM comments";
                                    $query = mysqli_query($conn, $sql);

                                    $comment_count = mysqli_num_rows($query);

                                    echo "<div class='huge'>$comment_count</div>";

                                    ?>

                                    <div>Comments</div>
                                </div>
                            </div>
                        </div>
                        <a href="comments.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-yellow">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-user fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php 
                                    $sql = "SELECT * FROM users";
                                    $query = mysqli_query($conn, $sql);

                                    $users_cout = mysqli_num_rows($query);

                                    echo "<div class='huge'>$users_cout</div>";
                                    ?>

                                    <div> Users</div>
                                </div>
                            </div>
                        </div>
                        <a href="users.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="panel panel-red">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-list fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <?php
                                    $sql = "SELECT * FROM categories";
                                    $query = mysqli_query($conn, $sql);
                                    $categories_count = mysqli_num_rows($query);

                                    echo "<div class='huge'>$categories_count</div>";

                                    ?>


                                    <div>Categories</div>
                                </div>
                            </div>
                        </div>
                        <a href="categories.php">
                            <div class="panel-footer">
                                <span class="pull-left">View Details</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <!-- /.row -->
            <?php 

            $sql = "SELECT * FROM posts WHERE post_status = 'published'";
            $query_published_posts = mysqli_query($conn, $sql);
            $post_published_count = mysqli_num_rows($query_published_posts);

            $sql = "SELECT * FROM posts WHERE post_status = 'draft'";
            $draft_posts = mysqli_query ($conn, $sql);
            $post_draft_count = mysqli_num_rows($draft_posts);

            $sql = "SELECT * FROM comments WHERE comment_status = 'unapproved' ";
            $unapproved_comments = mysqli_query($conn, $sql);
            $unapproved_comments_count = mysqli_num_rows($unapproved_comments);

            $sql = "SELECT * FROM users WHERE user_role = 'subscriber' ";
            $select_subscribers = mysqli_query($conn, $sql);
            $subscriber_count = mysqli_num_rows($select_subscribers);

            ?>



            <div class="row">

                <script type="text/javascript">
                    google.charts.load('current', {'packages':['bar']});
                    google.charts.setOnLoadCallback(drawChart);
                    function drawChart() {
                        var data = google.visualization.arrayToDataTable([
                            ['Data', 'Count'],

                            <?php

                            $element_text = [
                                'All Posts',
                                'Active Post',
                                'Draft Posts',
                                'Comments',
                                'Pending Comments',
                                'Users',
                                'Subscribers',
                                'Categories'];
                            $element_count = [
                                $post_count,
                                $post_published_count,
                                $post_draft_count   ,
                                $comment_count,
                                $unapproved_comments_count,
                                $users_cout,
                                $subscriber_count,
                                $categories_count];

                            for($i = 0; $i < count($element_text); $i++){

                                echo "['{$element_text[$i]}'" . "," . "{$element_count[$i]}],";

                            }                    
                            ?>
                            //Static data from the widget, kept for reference 
                            //['Posts', 2],

                        ]);

                        var options = {
                            chart: {
                                title: 'Blog status',
                                subtitle: '',
                            }
                        };

                        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

                        chart.draw(data, options);
                    }
                </script>

                <div id="columnchart_material" style="width: 'auto'; height: 500px;"></div>


            </div>



        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>


