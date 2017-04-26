<div class="table-responsive">

    <?php

    if(isset($_POST['checkBoxArray'])){

        foreach($_POST['checkBoxArray'] as $postValueId){
            $bulk_options = $_POST['bulk_options'];

            switch($bulk_options){
                case 'published':
                $sql = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $query_published = mysqli_query($conn, $sql);

                confirm($query_published);

                break;


                case 'draft':
                $sql = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";
                $query_draft = mysqli_query($conn, $sql);

                confirm($query_draft);

                break;

                case 'delete':
                $sql = "DELETE FROM posts WHERE post_id = {$postValueId}";
                $query_delete = mysqli_query($conn, $sql);

                confirm($query_delete);

                break;


                case 'clone':

                $sql = "SELECT * FROM posts WHERE post_id = '{$postValueId}' ";
                $query_clone = mysqli_query($conn, $sql);

                while($row = mysqli_fetch_array($query_clone)){
                    $post_category_id = $row['post_category_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_image = $row['post_image'];
                    $post_content = $row['post_content'];
                    $post_tags = $row['post_tags'];
                    $post_status = $row['post_status'];
                }

                $sql = "INSERT INTO posts(post_category_id, post_title, post_author, post_date, post_image, post_content, post_tags, post_status) ";
                $sql .= "VALUES({$post_category_id}, '{$post_title}', '{$post_author}', now(), '{$post_image}', '{$post_content}', '{$post_tags}', '{$post_status}')";

                $query_insert = mysqli_query($conn, $sql);

                confirm($query_insert);

                break;


            }


        }

    }

    ?>

    <form action="" method="POST">

        <table class="table table-bordered table-hover table-collapse">

            <div class="col-xs-4" id="bulkOptionContainer">

                <select class="form-control" name="bulk_options" id="">


                    <option value="">Select Options</option>
                    <option value="published">Published</option>
                    <option value="draft">Draft</option>
                    <option value="delete">Delete</option>
                    <option value="clone">Clone</option>

                </select>


            </div>

            <div class="col-xs-4">

                <input type="submit" name="submit" class="btn btn-success" value="Apply">
                <a class="btn btn-primary" href="post.php?source=add_post">Add New</a>

            </div>




            <thead>
                <tr>
                    <th><input id="selectAllBoxes" type="checkbox"></th>
                    <th>Id</th>
                    <th>Users</th>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Tags</th>
                    <th>Comments</th>
                    <th>Date</th>
                    <th>Views</th>
                    <th>View Post</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>

            <tbody>

                <?php

                $sql = "SELECT * FROM posts ORDER BY post_id DESC";
                $query = mysqli_query($conn, $sql);



                while($row = mysqli_fetch_assoc($query)){
                    $post_id = $row['post_id'];
                    $post_author = $row['post_author'];
                    $post_user = $row['post_user'];
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_status = $row['post_status'];
                    $post_image = $row['post_image'];
                    $post_tags = $row['post_tags'];
                    $post_comment_count = $row['post_comment_count'];
                    $post_date = $row['post_date'];
                    $post_views_count = $row['post_views_count'];

                    echo "<tr>";
                    ?>

                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value="<?php echo $post_id; ?>"></td>

                    <?php

                    echo "<td>{$post_id}</td>";

                    if(!empty($post_author)){


                        echo "<td>{$post_author}</td>";

                    } elseif(!empty($post_user)){


                        echo "<td>{$post_user}</td>";


                    }





                    echo "<td>{$post_title}</td>";

                    // Category title using relational database concept
                    $sql_category = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
                    $query_category = mysqli_query($conn, $sql_category);

                    while($row = mysqli_fetch_assoc($query_category)){
                        $cat_id = $row['cat_id']; 
                        $cat_title = $row['cat_title'];

                        echo "<td>{$cat_title}</td>";

                    }

                    //            echo "<td>{$post_c ategory_id}</td>";


                    echo "<td>{$post_status}</td>";
                    echo "<td><img width='50' src='../images/{$post_image}' alt='image'></td>";
                    echo "<td>{$post_tags}</td>";

                    $sql_comments = "SELECT * FROM comments WHERE comment_post_id = $post_id"; 
                    $query_comments = mysqli_query($conn, $sql_comments);
                    $row = mysqli_fetch_array($query_comments);
                    $comment_id = $row['comment_id'];
                    $count_comments = mysqli_num_rows($query_comments);


                    echo "<td><a href='post_comments.php?id=$post_id'>{$count_comments}</a></td>";

                    echo "<td>{$post_date}</td>";
                    echo "<td><a href='post.php?reset={$post_id}'>{$post_views_count}</a></td>";
                    echo "<td><a href='../post.php?p_id={$post_id}'>View Post</a></td>";
                    echo "<td><a href='post.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
                    echo "<td><a onClick=\"javascript: return confirm('Are you sure you want to delete?');\" href='post.php?delete={$post_id}'>Delete</a></td>";
                    echo "</tr>";

                }
                ?>

                <?php
                // Delete post query
                if(isset($_GET['delete'])){
                    $the_post_id = $_GET['delete'];

                    $sql = "DELETE FROM posts WHERE post_id={$the_post_id}";
                    $query = mysqli_query($conn, $sql);
                    header("Location: post.php");
                }
                // reset
                if(isset($_GET['reset'])){
                    $the_post_id = $_GET['reset'];
                    
                    $reset_sql = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($conn, $the_post_id);
                    $reset_query = mysqli_query($conn, $reset_sql);
                    
                    header("Location: post.php");
                    
                }

                ?>

            </tbody>
        </table>


    </form>

</div>

