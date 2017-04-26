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
        $get_post_author = $_GET['author'];
    }

    //    $sql = "SELECT * FROM posts ORDER BY post_id DESC";
    $sql = "SELECT * FROM posts WHERE post_user = '{$get_post_author}' ";

    $query = mysqli_query($conn, $sql);

    //    mysqli_query($conn,"SET NAMES utf8");
    //    mysqli_query($conn,"SET CHARACTER_SET utf8");

    while($row = mysqli_fetch_assoc($query)){
        $post_title = $row['post_title']; 
        $post_author = $row['post_user']; 
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
                    All posts by <?php echo $post_author?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content?></p>


                <hr>

                <?php } ?>


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
                        $sql = "UPDATE posts SET post_comment_count = post_comment_count + 1 WHERE post_id = $get_post_id";

                        $query = mysqli_query($conn, $sql);

                        if(!$query){
                            die('Failed' . nysqli_error($conn));
                        }


                    } else {
                        echo "<script>alert('Fields cannot be empty')</script>";
                    }

                }



                ?>
    

            </div>

            <!-- Blog Sidebar Widgets Column -->

            <?php include "includes/sidebar.php"; ?>

        </div>
        <!-- /.row -->

        <hr>

        <?php include "includes/footer.php"; ?>