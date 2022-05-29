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
      
      $courses = array();
  $query="SELECT courses.id as id, courses.coursename as coursename,courses.nsubs as nsubs, courses.teacher as teacher,courses.schedule1 as schedule1,courses.schedule2 as schedule2,courses.img_src as img_src, EXISTS (SELECT user FROM subscriptions where course=courses.id and user=$userid)as subscribed from courses order by id";
      $res = mysqli_query($conn, $query);
      while($row = mysqli_fetch_assoc($res))
      {
            $courses[] = $row;
      }
      
      mysqli_free_result($res);
      mysqli_close($conn);
      
      echo json_encode($courses);

?>