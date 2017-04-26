<?php
include "includes/header.php";
include "includes/db.php";
?>

<body>

    <?php include "includes/navigation.php"?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->

            <div class="col-md-8">

                <?php

    if(isset($_GET['p_id'])){
        $get_post_id = $_GET['p_id'];
        
        
        
        $sql_view = "UPDATE posts SET post_views_count = post_views_count + 1 WHERE post_id = $get_post_id";
        $query_view = mysqli_query($conn, $sql_view);
        
        if(!$query_view){
            
            die("Query failed ." . mysqli_error($conn));
            
        }
    

    //    $sql = "SELECT * FROM posts ORDER BY post_id DESC";
    $sql = "SELECT * FROM posts WHERE post_id= $get_post_id ";

    $query = mysqli_query($conn, $sql);

    //    mysqli_query($conn,"SET NAMES utf8");
    //    mysqli_query($conn,"SET CHARACTER_SET utf8");

    while($row = mysqli_fetch_assoc($query)){
        $post_title = $row['post_title']; 
        $post_author = $row['post_author']; 
        $post_date = $row['post_date']; 
        $post_image = $row['post_image']; 
        $post_content = $row['post_content']; 

        //        echo $post_title;
        //        echo $post_author;
        //        echo $post_date;
        //        echo $post_image;
        //        echo $post_content;

                ?>

                <h1 class="page-header">
                    Page Heading
                    <small>Secondary Text</small>
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>


                <hr>

                <?php } 
    
    } else {
        
        header("Location: index.php");
        
    }
                
                
                ?>


                <!-- Blog Comments -->

                <?php

                //Comment query

                if(isset($_POST['create_comment'])){

                    $get_post_id = $_GET['p_id'];

                    $comment_author = $_POST['comment_author'];
                    $comment_email = $_POST['comment_email'];
                    $comment_content = $_POST['comment_content'];

                    if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){


                        $sql = "INSERT INTO comments (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date) ";

                        $sql .= "VALUES ($get_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'unapproved', now())";

                        $query = mysqli_query($conn, $sql);

                        if(!$query){
                            die("QUERY FAILED" . mysqli_error($conn));
                        }

                        // Increase post comment count by 1 in database
                        // $sql = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $get_post_id";

                        // $query = mysqli_query($conn, $sql);

                    } else {
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }

                }



                ?>

                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action="" method="POST" role="form">
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input class="form-control" type="text" name="comment_author">
                        </div>
                        <div class="form-group">
                            <label for="Email">Email</label>
                            <input class="form-control" type="email" name="comment_email">
                        </div>

                        <div class="form-group">
                            <label for="Email">Your Comment</label>
                            <textarea class="form-control" name="comment_content" rows="3"></textarea>
                        </div>

                        <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                    </form>
                </div>

                <hr>

                <!-- Posted Comments -->
                <?php

                // Comment query
                $sql = "SELECT * FROM comments WHERE comment_post_id = {$get_post_id} ";
                $sql .= "AND comment_status = 'approved' ";
                $sql .= "ORDER BY comment_id DESC ";

                $query = mysqli_query($conn, $sql);

                if(!$query){

                    die('QUERY FAILED.' . mysqli_error($conn)); 

                }   

                while($row = mysqli_fetch_assoc($query)){
                    $comment_date = $row['comment_date'];
                    $comment_content = $row['comment_content'];
                    $comment_author = $row['comment_author'];

                ?>

                <!-- Comment -->
                <div class="media">
                    <a class="pull-left" href="#">
                        <img class="media-object" src="http://placehold.it/64x64" alt="">
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $comment_author; ?>
                            <small><?php echo $comment_date; ?></small>
                        </h4>
                        <?php echo $comment_content; ?>
                    </div>
                </div> 
                <?php } ?>


            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>