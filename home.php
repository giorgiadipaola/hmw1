
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
        <link rel = 'stylesheet' href='home.css'>
        <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
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
       
        <script src='home.js' defer></script>
        
        <script src='api_rest.js'defer></script>
    </head>

<body>


    <nav>
        <div class="logo"> <img src="icons8-cappello-di-laurea-80.png">Vibes</div>
        <div id="links">
        <a id="here"> HOME </a> 
        <a href="classroom.php"> CLASSROOM </a> 
        <a href="yourcourses.php"> YOUR COURSES </a>
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

        <h1 id="titolo"> </h1>

        <div id="welcome"> <div id="box-welcome"> Welcome to Vibes, <br><?php 
                        echo $userdata['name']; ?>
                        </div></div>
    </header>

    <section id="courses-view">
    <div id="header-courses">
    <h1>All available courses:</h1>
    <h2>Click<span class="material-symbols-outlined" id="sub-arrow">bookmarks</span> <img id="arrow" src="icons8-cursore-64.png">to Subscribe!</h2>
</div>
    <section id="courses-section">
    
    </section> 
    
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
        <p id="foot-title"> <strong>Contacts</strong>
       <span> 500 Terry Francois St 
San Francisco, CA 94158</span>


<span>  123-456-7890 <br>

Info@vibes.com</span>


         </p>
            
      <div id="social">
        <img src="insta.png">
       <img src="facebook.png">
       <img src="twitter.png">
       <img src="github.png">
       
   </div>

   </footer>

</body>

</html>