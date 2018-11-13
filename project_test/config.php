<?php
//　データベース 連結
function db_con(){
    $hostname = "localhost:3306";
    $user = "root";
    $password = "pswd";
    $dbname = "php_testdb";
    $con = mysqli_connect($hostname, $user, $password, $dbname);
    if (mysqli_connect_errno()) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    
    return $con;
}

?>