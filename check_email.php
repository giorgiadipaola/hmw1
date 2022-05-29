<?php

    $conn= mysqli_connect("localhost", "root", "", "hmw1");

  $email= mysqli_real_escape_string($conn, $_GET["q"]);

    $query= "SELECT email FROM users WHERE email= '$email'";
    $res= mysqli_query($conn, $query) or die(mysqli_error($conn));

    echo json_encode (array('exists' => mysqli_num_rows($res) >0 ? true : false) );  //array con unico campo exists che sarà true se il numero di righe !=0

    mysqli_close($conn);

        

?>