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
$userid= mysqli_real_escape_string($conn, $userid);

     $query= "SELECT DISTINCT username, email from users join subscriptions on 
      users.id=subscriptions.user where subscriptions.course 
      in(select course from subscriptions where user= $userid) and users.id!= $userid ";

      $res=mysqli_query($conn, $query) or die("Non funziona".mysqli_error($conn));

      $mates=array();

      while($row= mysqli_fetch_assoc($res)){
          $mates[]=$row;
              }
              mysqli_free_result($res);
      mysqli_close($conn);
      
      echo json_encode($mates);
      ?>