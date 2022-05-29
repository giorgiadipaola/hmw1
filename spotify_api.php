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

$client_id =     "05415bcdb7d444f89eecc235fff54ff9";
 $client_secret = "5dd7d7b65bd840ae9180981e60d02ea5";


 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, 'https://accounts.spotify.com/api/token' );
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 curl_setopt($ch, CURLOPT_POST, 1);
 curl_setopt($ch, CURLOPT_POSTFIELDS, 'grant_type=client_credentials'); 
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.base64_encode($client_id.':'.$client_secret))); 
 $token=json_decode(curl_exec($ch), true);
 curl_close($ch);    

 $query = urlencode($_GET["q"]);
 $url = 'https://api.spotify.com/v1/search?type=track&q='.$query;
 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
 
 curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Bearer '.$token['access_token'])); 
 $res=curl_exec($ch);
 curl_close($ch);

 echo $res;
?>