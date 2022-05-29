<?php


    $conn= mysqli_connect("localhost", "root", "", "hmw1");
    $username= mysqli_real_escape_string($conn, $_GET["q"]);

    $query= "SELECT username FROM users WHERE username= '$username'";
    $res= mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode (array('exists' => mysqli_num_rows($res) >0 ? true : false) );  //array con unico campo exists che sarà true se il numero di righe !=0

    mysqli_close($conn);


?>