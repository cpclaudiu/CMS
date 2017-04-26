<?php

if(isset($_GET['p_id'])){
    $get_post_id = $_GET['p_id'];


}

$sql = "SELECT * FROM posts WHERE post_id=$get_post_id";
$query = mysqli_query($conn, $sql);

while($row = mysqli_fetch_assoc($query)){
    $post_id = $row['post_id'];
    $post_user = $row['post_user'];
    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];
    $post_comment_count = $row['post_comment_count'];
    $post_date = $row['post_date'];
}

if(isset($_POST['update_post'])){

    $post_user = $_POST['user'];
    $post_title = $_POST['post_title'];
    $post_category_id = $_POST['post_category'];
    $post_status = $_POST['post_status'];
    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];
    $post_content = $_POST['post_content'];
    $post_tags = $_POST['post_tags'];

    //moving the image from a temporary location to a permanent location
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)){

        $sql = "SELECT * FROM posts WHERE post_id=$get_post_id";
        $query_image = mysqli_query($conn, $sql);

        while($row = mysqli_fetch_assoc($query_image)){
            $post_image = $row['post_image'];
        }

    }


    $sql_post = "UPDATE posts SET ";
    $sql_post .= "post_title = '{$post_title}', ";
    $sql_post .= "post_category_id = '{$post_category_id}', ";
    $sql_post .= "post_date = now(), ";
    $sql_post .= "post_user = '{$post_user}', ";
    $sql_post .= "post_status = '{$post_status}', ";
    $sql_post .= "post_tags = '{$post_tags}', ";
    $sql_post .= "post_content = '{$post_content}', ";
    $sql_post .= "post_image = '{$post_image}' ";
    $sql_post .= "WHERE post_id = {$get_post_id}";

    //    $sql = "UPDATE categories SET cat_title='{$post_cat_title}' WHERE cat_id={$cat_id} ";

    $query_post = mysqli_query($conn, $sql_post);

    confirm($query_post);
    
    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$get_post_id}'>View Post</a> or <a href='post.php'>Edit More Posts</a></p>";
}



?>
<form action="" method="POST" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input value="<?php echo $post_title ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">

        <select name="post_category" id="">
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

    <!-- <div class="form-group">
        <label for="author">Post Author</label>
        <input value="<?php echo $post_user; ?>" type="text" class="form-control" name="post_user">
    </div> -->


    <div class="form-group">

        <label for="users">Users</label>

        <select class="form-control" name="user" id="">

        <?php echo "<option value='$post_user'>{$post_user}</option>"; ?>
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
            <option value='<?php echo $post_status; ?>'><?php echo $post_status; ?></option>
            <?php
            if($post_status == 'published'){
                
                echo "<option value='draft'>draft</option>";

            } else {
                echo "<option value='published'>published</option>";
            }
            ?>




        </select>
    </div>

    <div class="form-group"> 
        <img src="../images/<?php echo $post_image; ?>" width="100" alt="">
        <input type="file" name="image">
    </div>    

    <div class="form-group">
        <label for="post_tags">Post Tags</label>
        <input value="<?php echo $post_tags; ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
        <label for="post_content">Post Content</label>
        <textarea class="form-control" name="post_content" id="" cols="30" rows="10"><?php echo $post_content; ?>
        </textarea>
    </div>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>

</form>