<?php

if(isset($_POST['create_post'])){

    $post_category = $_POST['post_category'];
    $post_title = $_POST['title'];
    $post_user = $_POST['user'];
    $post_date = date('d-m-y');

    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];

    $post_content = $_POST['post_content'];
    //    $post_comment_count = 4;
    $post_tags = $_POST['post_tags'];

    // not getting it from the fields, yet, so it's hardcoded, will be modified later on to be dynamic
    $post_status = $_POST['post_status'];

    move_uploaded_file($post_image_temp, "../images/$post_image");

    $sql = "INSERT INTO posts(post_category_id, post_title, post_user, post_date, post_image, post_content, post_tags, post_status) ";
    $sql .= "VALUES({$post_category},'{$post_title}','{$post_user}',now(),'{$post_image}','{$post_content}', '{$post_tags}','{$post_status}' ) ";

    $query = mysqli_query($conn, $sql);

    confirm($query);

    $get_post_id = mysqli_insert_id($conn);
    
    echo "<p class='bg-success'>Post Created. <a href='../post.php?p_id={$get_post_id}'>View Post</a> or <a href='post.php'>Edit More Posts</a></p>";

}



?>  

<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" class="form-control" name="title">
    </div>

    <div class="form-group">

        <label for="category">Category</label>

        <select class="form-control" name="post_category" id="">
            <?php

            $sql_cat = "SELECT * FROM categories";
            $query_cat = mysqli_query($conn, $sql_cat);

            confirm($query_cat);

            while($row = mysqli_fetch_assoc($query_cat)){
                $cat_id = $row['cat_id']; 
                $cat_title = $row['cat_title'];

                echo "<option value='$cat_id'>{$cat_title}</option>";

            }

            ?>

        </select>

    </div>
<!-- 
    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" class="form-control" name="author">
    </div> -->

    <!-- dropdown user -->
    <div class="form-group">

        <label for="users">Users</label>

        <select class="form-control" name="user" id="">
            <?php

            $sql_cat = "SELECT * FROM users";
            $query_cat = mysqli_query($conn, $sql_cat);

            confirm($query_cat);

            while($row = mysqli_fetch_assoc($query_cat)){
                $user_id = $row['user_id']; 
                $username = $row['username'];

                echo "<option value='$username'>{$username}</option>";

            }

            ?>

        </select>

    </div>





    <div class="form-group">
       <select name="post_status" id="">
           <option value="draft">Post Status</option>
           <option value="published">Publish</option>
           <option value="draft">Draft</option>
       </select>
   </div>

   <div class="form-group">
    <label for="post_image">Post Image</label>
    <input type="file" name="image">
</div>

<div class="form-group">
    <label for="post_tags">Post Tags</label>
    <input type="text" class="form-control" name="post_tags">
</div>

<div class="form-group">
    <label for="post_content">Post Content</label>
    <textarea class="form-control" name="post_content" id="" cols="30" rows="10"></textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>



</form>