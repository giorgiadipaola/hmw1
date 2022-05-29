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
?>

<html>
    <?php

$conn = mysqli_connect("localhost", "root", "", "hmw1");
$userid = mysqli_real_escape_string($conn, $userid);
$query = "SELECT * FROM users WHERE id = $userid";
$res1 = mysqli_query($conn, $query);
$userdata = mysqli_fetch_assoc($res1);   
    
    ?>
    <head>
        <title> Vibes-Home</title>
        <link rel = 'stylesheet' href='yourcourses.css'>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@1,500&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Marcellus+SC&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hurricane&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@200&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Lora&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merriweather+Sans:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Merienda&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@300&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        
        
        <script src='api_rest.js' defer></script>
        <script src='yourcourses.js' defer></script>
    </head>

<body>


    <nav>
        <div class="logo"> <img src="icons8-cappello-di-laurea-80.png">Vibes</div>
        <div id="links">
        <a  href="home.php"> HOME </a> 
        <a href="classroom.php"> CLASSROOM </a> 
        <a id="here"> YOUR COURSES </a>
        <a id="pause-coffee"> PA<span class="material-symbols-outlined">
coffee
</span>SE?</a>
        <a  class="logout" href="logout.php"> <span class="material-symbols-outlined" id="logout_symbol">
            logout
            </span> </a>
     </div>
   <div id="menu"> 
       <div></div>
       <div></div>
       <div></div>
   </div>
    </nav> 

    <header>

    <div id="box-profile"> 
    <div class="user" ></div>
                        
   
                        <div class="name">
                            <?php 
                                echo $userdata['name']." ".$userdata['surname'] ; 
                            ?>
                        </div>
                        <div class="username">
                           <span> @<?php echo $userdata['username'] ?></span>
                        </div>
                        <div class="statistics">
                            <div>
                            Courses  <br> <span id="count-update" class="count"><?php echo $userdata['ncourses'] ?></span>
                            </div>
                           
                        </div>
        
                     </div>
                     <div id="mates-view">
                     <p id="mates-title">  Course Mates</p>
     <div id="box-mates"> 
         
</div>
    </header>
   
    <div id="header-courses">
    <h1> Your courses:</h1>
    <h2>Click<span class="material-symbols-outlined" id="sub-arrow">bookmark_remove</span> <img id="arrow" src="icons8-cursore-64.png">to Unsubscribe!</h2>
</div>
    <section id="courses-section">

    </section>
    <section id="modal-view" class="hidden" >
         
         <div id="query">
         <div id="close-query"><span class="material-symbols-outlined" id="x">
         close
          </span> </div><img src="spotify.png">
         <form>
           <input type='text' id='subject' id="search" placeholder="SEARCH" name="search">
           <input type='submit' id='submit' value='cerca' class="hidden">
         </form>
         <div id="contents">
           
         </div>
         </div>
         
       </section>
    <footer>
        <p id="foot-title"> <strong>FOLLOW US</strong></p>
    
      <div id="social">
        <img src="insta.png">
       <img src="facebook.png">
       <img src="twitter.png">
       <img src="github.png">
      
       
   </div>
   </footer>
</body>

</html>