<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<?php 

if(isset($_POST['submit'])){

    $username = $_POST['username']; 
    $email    = $_POST['email']; 
    $password = $_POST['password']; 


    if(!empty($username) && !empty($email) && !empty($password)) {


        $username = mysqli_real_escape_string($conn, $username);
        $email    = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);


        $password = password_hash($password, PASSWORD_BCRYPT, array('cost' => 12));

        // $sql = "SELECT randSalt FROM users";
        // $query = mysqli_query($conn, $sql);

        // if(!$query){
        //     die("Query Failed. " . mysqli_error($conn));
        // }

        // $row = mysqli_fetch_array($query);

        // $salt = $row['randSalt'];
        
        // $password = crypt($password, $salt);

        $sql = "INSERT INTO users (username, user_email, user_password, user_role) ";
        $sql .= "VALUES('{$username}', '{$email}', '{$password}', 'subscriber') ";
        $query = mysqli_query($conn, $sql);

        if(!$query){
            die("Query Failed ". mysqli_error($conn) . ' ' . mysqli_error($conn));
        }

        $message = "Your registration has been submitted";

    } else {
        $message = "Fields cannot be empty";
        echo "";
    }

} else {
    
    $message = "";
    
}





?>

<!-- Navigation -->


<?php include "includes/navigation.php"; ?>


<!-- Page content -->
<div class="container">

    <section id="login">
        <div class="container">
            <div class="row">
                <div class="col-xs-6 col-xs-offset-3">
                    <div class="form-wrap">
                        <h1>Register</h1>
                        <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                          
                          <h6 class="text-center"><?php echo $message; ?></h6> 
                            <div class="form-group">
                                <label for="username" class="sr-only">Username</label>
                                <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Name">
                            </div>

                            <div class="form-group">
                                <label for="email" class="sr-only">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                            </div>

                            <div class="form-group">
                                <label for="password" class="sr-only">Password</label>
                                <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                            </div>

                            <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register"> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <hr>

    <?php include "includes/footer.php" ?>

