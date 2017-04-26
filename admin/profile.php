<?php include "includes/admin_header.php" ?>

<?php
    if(isset($_SESSION['username'])){
        $username = $_SESSION['username'];

        $sql = "SELECT * FROM users WHERE username = '{$username}'";
        $query = mysqli_query($conn, $sql);

        confirm($query);

        while($row = mysqli_fetch_array($query)){
            
            $user_id = $row['user_id'];
            $username = $row['username'];
            $user_password = $row['user_password'];
            $user_firstname = $row['user_firstname'];
            $user_lastname = $row['user_lastname'];
            $user_email = $row['user_email'];
            $user_image = $row['user_image'];
            $user_role = $row['user_role'];
            
        }

    }
?>

<?php 
if(isset($_POST['profile_user'])){

    $user_firstname = $_POST['user_firstname'];
    $user_lastname = $_POST['user_lastname'];
    $user_role = $_POST['user_role'];
    $username = $_POST['username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    //    $user_date = date('d-m-y');


    //    $post_image = $_FILES['image']['name'];
    //    $post_image_temp = $_FILES['image']['tmp_name'];
    //    move_uploaded_file($post_image_temp, "../images/$post_image");



    $sql_user = "UPDATE users SET ";
    $sql_user .= "user_firstname = '{$user_firstname}', ";
    $sql_user .= "user_lastname = '{$user_lastname}', ";
    $sql_user .= "user_role = '{$user_role}', ";
    $sql_user .= "username = '{$username}', ";
    $sql_user .= "user_email = '{$user_email}', ";
    $sql_user .= "user_password = '{$user_password}' ";
    $sql_user .= "WHERE username = '{$username}' ";

    //    $sql = "UPDATE categories SET cat_title='{$post_cat_title}' WHERE cat_id={$cat_id} ";

    $query_user = mysqli_query($conn, $sql_user);

    confirm($query_user);
}

?>



<div id="wrapper">


    <?php include "includes/admin_navigation.php" ?> 


    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">

                    <h1 class="page-header">
                        Profile
                        <!--                        <small>Author</small>-->
                    </h1>

                    <form action="" method="POST" enctype="multipart/form-data">

                        <div class="form-group">
                            <label for="firstname">Firstname</label>
                            <input type="text" value="<?php echo $user_firstname ?>" class="form-control" name="user_firstname">
                        </div>

                        <div class="form-group">
                            <label for="lastname">Lastname</label>
                            <input type="text" value="<?php echo $user_lastname ?>" class="form-control" name="user_lastname">
                        </div>    

                        <div class="form-group">

                            <select name="user_role" id="">
                                <option value="subscriber"><?php echo $user_role; ?></option>
                                <?php

                                if($user_role == 'admin'){

                                    echo "<option value='subscriber'>subscriber</option>";

                                } else {

                                    echo "<option value='admin'>admin</option>";

                                }

                                ?>
                            </select>

                        </div>

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" value="<?php echo $username ?>" class="form-control" name="username">
                        </div>

                        <div class="form-group">
                            <label for="user_email"><E></E>mail</label>
                            <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
                        </div>

                        <div class="form-group">
                            <label for="post_content">Password</label>
                            <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
                        </div>

                        <div class="form-group">
                            <input class="btn btn-primary" type="submit" name="profile_user" value="Update Profile">
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


