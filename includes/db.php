<?php

//$db_user = 'localhost';
$db['db_host'] = "localhost";
$db['db_user'] = "root";
$db['db_pass'] = "";
$db['db_name'] = "cms";

foreach($db as $key => $value){
    
    define(strtoupper($key), $value);
   
}
//$servername = 'localhost';
//$username = 'root';
//$password = ''; 
//$db = 'cms';
//
//$conn = mysqli_connect($servername, $username, $password, $db);
$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

//if($conn){
//    echo 'We are connected';
//}

?>