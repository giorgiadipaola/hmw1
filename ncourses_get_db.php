<?php

session_start();

function checkAuth() {
    
    if(isset($_SESSION['vibes_id'])) {
        return $_SESSION['vibes_id'];
    } else 
        return 0;
}

if(!$userid= checkAuth())
{
   header("Location: login1.php");
   exit;
}

$conn = mysqli_connect("localhost", "root", "", "hmw1");








?>