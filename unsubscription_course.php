<?php

session_start();

function checkAuth() {
    
    if(isset($_SESSION['vibes_id'])) {
        return $_SESSION['vibes_id'];
    } else 
        return 0;
}
if(!$userid=checkAuth()) exit;

$conn=mysqli_connect("localhost", "root", "", "hmw1");
$userid=mysqli_real_escape_string($conn, $userid);
$courseid=mysqli_real_escape_string($conn, $_POST["courseid"]);

$new_unsub = "DELETE  FROM  subscriptions  WHERE course= $courseid AND  user= $userid";
$res = mysqli_query($conn, $new_unsub);

    // mysqli_close($conn);
    
    // echo json_encode(array('ok' => true));
    $up_query="SELECT ncourses FROM users WHERE id=$userid";
  
    
    
    if($res){
        
         $res= mysqli_query($conn, $up_query);
         if(mysqli_num_rows($res)>0){
         $return=mysqli_fetch_assoc($res);
    
         $data= array('ncourses'=> $return['ncourses']);
        
         
        mysqli_close($conn);
        
        echo json_encode(array('ok'=> true, 'ncourses'=> $data['ncourses']));
        exit;
    }
}
    mysqli_close($conn);
        
    echo json_encode(array('ok'=> false));
    

    ?>