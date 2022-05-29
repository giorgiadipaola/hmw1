



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

$new_sub = "INSERT INTO subscriptions(user, course) VALUES($userid, $courseid)";
$query="SELECT nsubs FROM courses WHERE id =$courseid";

$res = mysqli_query($conn, $new_sub);
if($res){
    $res= mysqli_query($conn, $query);
    if(mysqli_num_rows($res)>0){
        $return=mysqli_fetch_assoc($res);
        $data=array('nsubs'=>$return['nsubs']);
    mysqli_close($conn);
    echo json_encode(array('ok' => true, 'nsubs'=>$data['nsubs']));
    exit;
}
mysqli_close($conn);
echo json_encode(array('ok'=> true));
}
mysqli_close($conn);
        
echo json_encode(array('ok'=> false));
    ?>