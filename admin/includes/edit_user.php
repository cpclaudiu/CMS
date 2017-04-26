<?php

if(isset($_GET['edit_user'])){
    $get_user_id = $_GET['edit_user'];

    $sql = "SELECT * FROM users WHERE user_id = $get_user_id ";
    $query_users = mysqli_query($conn, $sql);

    confirm($query_users);

    while($row = mysqli_fetch_assoc($query_users)){
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_password = $row['user_password'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_image = $row['user_image'];
        $user_role = $row['user_role'];

    }






    if(isset($_POST['edit_user'])){

        $user_firstname = $_POST['user_firstname'];
        $user_lastname = $_POST['user_lastname'];
        $user_role = $_POST['user_role'];
        $username = $_POST['username'];
        $user_email = $_POST['user_email'];
        $user_password = $_POST['user_password'];
        $user_date = date('d-m-y');



        if(!empty($user_password)){


            $sql_password = "SELECT user_password FROM users WHERE user_id = $user_id";
            $query = mysqli_query($conn, $sql_password);

            confirm($query);

            $row = mysqli_fetch_array($query);

            $db_user_password = $row['user_password'];



            if($db_user_password != $user_password){

                $hashed_password = password_hash($user_password, PASSWORD_BCRYPT, array('cost' => 12));



                $sql_user = "UPDATE users SET ";
                $sql_user .= "user_firstname = '{$user_firstname}', ";
                $sql_user .= "user_lastname = '{$user_lastname}', ";
                $sql_user .= "user_role = '{$user_role}', ";
                $sql_user .= "username = '{$username}', ";
                $sql_user .= "user_email = '{$user_email}', ";
                $sql_user .= "user_password = '{$hashed_password}' ";
                $sql_user .= "WHERE user_id = $get_user_id ";


                $query_user = mysqli_query($conn, $sql_user);

                confirm($query_user);
                
            }

            echo "User Update" . "<a href='users.php'>View Users?</a>";

        }


    }

} else {

    header("Location: index.php");

}


?>  

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
            <option value="<?php echo $user_role; ?>"><?php echo $user_role; ?></option>
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

    <!--
<div class="form-group">
<label for="post_image">Post Image</label>
<input type="file" name="image">
</div>
-->

<div class="form-group">
    <label for="user_email"><E></E>mail</label>
    <input type="email" value="<?php echo $user_email ?>" class="form-control" name="user_email">
</div>

<div class="form-group">
    <label for="post_content">Password</label>
    <input type="password" value="<?php echo $user_password ?>" class="form-control" name="user_password">
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="edit_user" value="Update User">
</div>

</form>