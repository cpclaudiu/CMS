<div class="table-responsive">
    <table class="table table-bordered table-hover table-collapse">
        <thead>
            <tr>
                <th>Id</th>
                <th>Username</th>
                <th>Firstname</th>
                <th>Lastname</th>
                <th>Email</th>
                <th>Role</th>
                <th>Admin</th>
                <th>Subscriber</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>

            <?php

            $sql = "SELECT * FROM users";
            $query_users = mysqli_query($conn, $sql);



            while($row = mysqli_fetch_assoc($query_users)){
                $user_id = $row['user_id'];
                $username = $row['username'];
                $user_password = $row['user_password'];
                $user_firstname = $row['user_firstname'];
                $user_lastname = $row['user_lastname'];
                $user_email = $row['user_email'];
                $user_image = $row['user_image'];
                $user_role = $row['user_role'];
                
                echo "<tr>";
                echo "<td>{$user_id}</td>";
                echo "<td>{$username}</td>";
                echo "<td>{$user_firstname}</td>";

                // Comment title using relational database concept
                //                $sql_category = "SELECT * FROM categories WHERE cat_id={$post_category_id}";
                //                $query_category = mysqli_query($conn, $sql_category);
                //
                //                while($row = mysqli_fetch_assoc($query_category)){
                //                    $cat_id = $row['cat_id']; 
                //                    $cat_title = $row['cat_title'];
                //
                //                    echo "<td>{$cat_title}</td>";
                //
                //                }

                //            echo "<td>{$post_category_id}</td>";


                echo "<td>{$user_lastname}</td>";
                echo "<td>{$user_email}</td>";
                echo "<td>{$user_role}</td>";


                // Setting the title for the "In Response To" field from the show comment table

//                $query_sql = "SELECT * FROM posts WHERE post_id = $comment_post_id";
//                $select_post_id_query = mysqli_query($conn, $query_sql);
//
//                while($row = mysqli_fetch_assoc($select_post_id_query)){
//                    $post_id = $row['post_id'];
//                    $post_title = $row['post_title'];
//
//
//                    echo "<td><a href='../post.php?p_id=$post_id'>{$post_title}</a></td>";
//                }
//
//                echo "<td>{$comment_date}</td>";
                echo "<td><a href='users.php?change_to_admin={$user_id}'>Admin</a></td>";
                echo "<td><a href='users.php?change_to_subscriber={$user_id}'>Subscriber</a></td>";   
                echo "<td><a href='users.php?source=edit_user&edit_user={$user_id}'>Edit</a></td>";
                echo "<td><a href='users.php?delete={$user_id}'>Delete</a></td>";
                echo "</tr>";

            }
            ?>
        </tbody>
    </table>
    
    <?php

            // Set user role to admin
    if(isset($_GET['change_to_admin'])){
        $the_user_id = $_GET['change_to_admin'];

        $sql = "UPDATE users SET user_role = 'admin' WHERE user_id = $the_user_id ";
        $admin_query = mysqli_query($conn, $sql);

        confirm($admin_query);    

        header("Location: users.php");
    }

            // Set user role to subscriber
    if(isset($_GET['change_to_subscriber'])){
        $the_user_id = $_GET['change_to_subscriber'];

        $sql = "UPDATE users SET user_role = 'subscriber' WHERE user_id = $the_user_id";
        $sub_query = mysqli_query($conn, $sql);

        confirm($sub_query);    

        header("Location: users.php");
    }

            // Delete user
    if(isset($_GET['delete'])){

        if(isset($_SESSION['user_role'])){

            if($_SESSION['user_role'] == 'admin'){

                $the_user_id = mysqli_real_escape_string($conn, $_GET['delete']);

                $sql = "DELETE FROM users WHERE user_id = $the_user_id";
                $query = mysqli_query($conn, $sql);

                confirm($query);    

                header("Location: users.php");
            }
        }
    }

    ?>
    
    
</div>