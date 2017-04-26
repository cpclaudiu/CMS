<?php include "includes/admin_header.php" ?>

<div id="wrapper">


    <?php include "includes/admin_navigation.php" ?> 


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Welcome to Comments
                        <!--                        <small>Author</small>-->
                    </h1>

                    <?php

                    if(isset($_POST['checkBoxArray'])){

                        foreach($_POST['checkBoxArray'] as $commentValueId){
                            $bulk_options = $_POST['bulk_options'];

                            switch($bulk_options){

                                case 'approved':

                                $sql = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
                                $query_published = mysqli_query($conn, $sql);

                                confirm($query_published);

                                break;


                                case 'unapproved':

                                $sql = "UPDATE comments SET comment_status = '{$bulk_options}' WHERE comment_id = {$commentValueId} ";
                                $query_draft = mysqli_query($conn, $sql);

                                confirm($query_draft);

                                break;

                                case 'delete':

                                $sql = "DELETE FROM comments WHERE comment_id = {$commentValueId}";
                                $query_delete = mysqli_query($conn, $sql);

                                confirm($query_delete);

                                break;

                            }


                        }

                    }

                    ?>







                    <form action="" method='POST'>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover table-collapse">

                                <div class="col-xs-4" id="bulkOptionContainer">

                                    <select class="form-control" name="bulk_options" id="">


                                        <option value="">Select Options</option>
                                        <option value="approved">Approved</option>
                                        <option value="unapproved">Unapproved</option>
                                        <option value="delete">Delete</option>


                                    </select>


                                </div>

                                <div class="col-xs-4">

                                    <input type="submit" name="submit" class="btn btn-success" value="Apply">

                                </div>



                                <thead>
                                    <tr>
                                        <th><input id="selectAllBoxes" type="checkbox"></th>
                                        <th>Id</th>
                                        <th>Author</th>
                                        <th>Comment</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                        <th>In Response to</th>
                                        <th>Date</th>
                                        <th>Approve</th>
                                        <th>Unapprove</th>
                                        <th>Delete</th>
                                        <!--                <th>Edit</th>-->
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php

                                    $sql = "SELECT * FROM comments WHERE comment_post_id =" . mysqli_real_escape_string($conn, $_GET['id']). " " ;
                                    $query = mysqli_query($conn, $sql);



                                    while($row = mysqli_fetch_assoc($query)){
                                        $comment_id = $row['comment_id'];
                                        $comment_post_id = $row['comment_post_id'];
                                        $comment_author = $row['comment_author'];
                                        $comment_content = $row['comment_content'];
                                        $comment_email = $row['comment_email'];
                                        $comment_status = $row['comment_status'];
                                        $comment_date = $row['comment_date'];

                                        echo "<tr>";
                                        ?>
                                        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php  echo $comment_id ?>'></td>
                                        <?php
                                        echo "<td>{$comment_id}</td>";
                                        echo "<td>{$comment_author}</td>";
                                        echo "<td>{$comment_content}</td>";
                                        echo "<td>{$comment_email}</td>";
                                        echo "<td>{$comment_status}</td>";


                // Setting the title for the "In Response To" field from the show comment table

                                        $query_sql = "SELECT * FROM posts WHERE post_id = $comment_post_id";
                                        $select_post_id_query = mysqli_query($conn, $query_sql);

                                        while($row = mysqli_fetch_assoc($select_post_id_query)) {
                                            $post_id = $row['post_id'];
                                            $post_title = $row['post_title'];

                    // if else for testing
                                            if($post_title){
                                                echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
                                            } else {
                                                echo "<td>No Title</td>";
                                            }
                                        }

                                        echo "<td>{$comment_date}</td>";
                                        echo "<td><a href='post_comments.php?approved=$comment_id&id=".$_GET['id']."'>Approve</a></td>";
                                        echo "<td><a href='post_comments.php?unapproved=$comment_id&id=".$_GET['id']."'>Unapprove</a></td>";   
                                        echo "<td><a href='post_comments.php?delete=$comment_id&id=".$_GET['id']."'>Delete</a></td>";
                                        echo "</tr>";

                                    }
                                    ?>

                                </tbody>
                            </table>

                            <?php

            // Set comment status to unapproved
                            if(isset($_GET['unapproved'])){
                                $the_comment_id = $_GET['unapproved'];

                                $sql = "UPDATE comments SET comment_status = 'unapproved' WHERE comment_id = $the_comment_id";
                                $unapprove_query = mysqli_query($conn, $sql);

                                confirm($unapprove_query);    

                                header("Location: post_comments.php?id=".$_GET['id'] ."");
                            }

            // Set comment status to approved
                            if(isset($_GET['approved'])){
                                $the_comment_id = $_GET['approved'];

                                $sql = "UPDATE comments SET comment_status = 'approved' WHERE comment_id = $the_comment_id";
                                $approve_query = mysqli_query($conn, $sql);

                                confirm($approve_query);    

                                header("Location: post_comments.php?id=".$_GET['id'] ."");
                            }

            // Delete comment
                            if(isset($_GET['delete'])){
                                $the_comment_id = $_GET['delete'];

                                $sql = "DELETE FROM comments WHERE comment_id = {$the_comment_id}";
                                $query = mysqli_query($conn, $sql);

                                confirm($query);    

                                header("Location: post_comments.php?id=".$_GET['id'] ."");
                            }

                            ?>

                        </div>

                    </form>

                </div>
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->


    <?php include "includes/admin_footer.php" ?>