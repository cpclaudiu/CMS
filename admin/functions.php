<?php

// counts the users online, and ecoes them
function users_online(){

    if(isset($_GET['onlineusers'])){
        global $conn;

        if(!$conn){
            session_start();

            include("../includes/db.php");

            $session = session_id();
            $time = time();
            $time_out_in_seconds = 05;

            $time_out = $time - $time_out_in_seconds;

            $sql = "SELECT * FROM users_online WHERE session = '$session'";
            $query = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($query);

            if($count == NULL){

                mysqli_query($conn, "INSERT INTO users_online(session, time) VALUES('$session', '$time')");

            } else {

                mysqli_query($conn, "UPDATE users_online SET time = '$time' WHERE session = '$session' ");

            }

            $users_online_query = mysqli_query($conn, "SELECT * FROM users_online WHERE time > '$time_out' ");
            echo $count_user = mysqli_num_rows($users_online_query);

        } 

    } // get request is set
}

users_online();

// tests the validity of database connection
function confirm($result){
    global $conn;

    if(!$result){
        die("Query failed ." . mysqli_error($conn));
    }
}

//CREATE
function insert_categories(){

    global $conn;

    if(isset($_POST['submit'])){

        $cat_title = $_POST['cat_title'];

        if($cat_title == "" || empty($cat_title)){

            echo "This field should not be empty";

        } else {

            $sql = "INSERT INTO categories(cat_title) VALUE('{$cat_title}') ";

            $query = mysqli_query($conn, $sql);

            if(!$query){

                die("QUERY FAILED" . mysqli_error($conn));

            }

        }


    }
}

//READ
function findAllCategories(){

    global $conn;

    $sql = "SELECT * FROM categories";
    $query = mysqli_query($conn, $sql);



    while($row = mysqli_fetch_assoc($query)){
        $cat_title = $row['cat_title'];
        $cat_id = $row['cat_id']; 

        echo "<tr>";
        echo "<td>{$cat_id}</td>";
        echo "<td>{$cat_title}</td>";
        echo "<td><a href ='categories.php?delete={$cat_id}'>Delete</a></td>";
        echo "<td><a href ='categories.php?edit={$cat_id}'>Edit</a></td>";
        echo "<tr>";

    }

}
// DELETE
function deleteCategorie(){

    global $conn;

    if(isset($_GET['delete'])){

        $get_cat_id = $_GET['delete'];

        $sql = "DELETE FROM categories WHERE cat_id={$get_cat_id} ";

        $query =mysqli_query($conn, $sql);

        // resets the page after delete was pushed
        header("Location: categories.php");


    }
}




?>