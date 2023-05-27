<?php
    $servername="localhost";
    $username="root";
    $password="";
    $database="users";

    $conn=mysqli_connect($servername,$username,$password,$database);

    if(!$conn)
    {
        echo "Server is not responding right now. Please try again later";
    }

?>