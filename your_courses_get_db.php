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
      
  
      $userid = mysqli_real_escape_string($conn, $userid);
    
     $query = "SELECT * FROM courses JOIN subscriptions ON  subscriptions.course=courses.id WHERE subscriptions.user= $userid";
  
      $res = mysqli_query($conn, $query) or die("Non funziona".mysqli_error($conn));
      

      $coursesArray = array();
      if (mysqli_num_rows($res) > 0) {
         
          while($entry = mysqli_fetch_assoc($res)) {
              $coursesArray[] = array('id' => $entry['id'], 'coursename' => $entry['coursename'], 
                                  'teacher' => $entry['teacher'], 'schedule1' => $entry['schedule1'], 
                                  'schedule2' => $entry['schedule2'], 'img_src'=> $entry['img_src']
                                 );
          }
      } 
    
 
        
      mysqli_close($conn);
      echo json_encode($coursesArray);
  
      exit;

?>