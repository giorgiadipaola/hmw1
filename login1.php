<?php
    session_start();
    if(isset($_SESSION["username"]))
    {
        header("Location: home.php");
        exit;
    }

    if(!empty($_POST["username"]) && !empty($_POST["password"]))
    {
        $conn=mysqli_connect("localhost", "root", "", "hmw1");
        $username = mysqli_real_escape_string($conn, $_POST["username"]);
        $password = mysqli_real_escape_string($conn, $_POST["password"]);
         $query="SELECT * FROM users WHERE username= '".$username."'" ;
         $res = mysqli_query($conn, $query);
         if(mysqli_num_rows($res)>0){
             $entry= mysqli_fetch_assoc($res);
             if(password_verify($_POST['password'], $entry['password'])){
             $_SESSION["username"]= $entry["username"];
             $_SESSION["vibes_id"]= $entry['id'];
             header("Location: home.php");
             mysqli_free_result($res);
             mysqli_close($conn);
             exit;
            }
             else{
                 $error_password=true;
             }
         } 
              $error="Credenziali errate";
         
    } 
    else if (isset($_POST["username"]) || isset($_POST["password"])) {
        
        $error = "Inserisci username e password.";
    }
    
    
    


?> 

<html>
<head>
    <link rel= "stylesheet" href="login1.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <script src="login1.js" defer="true"></script>
    <title>Vibes-Login</title>
</head>
<body>

    <section>
        <img src="logo1.png">
        
    <main>
    <?php
        if (isset($error)) {
            echo "<span class='errore'>$error</span>";
        }
        ?>
        <span class='errore hidden' id="error_span"> Devi compilare tutti i campi! </span>
    <form name='login_form' method='post'>
        <p>
      <label> <div class="field"> <span class="material-symbols-outlined"> person </span>
        Username </div>
        <input type='text' name='username'></label> 
    <p>  
      <label> <div class="field"> <span class="material-symbols-outlined">
        lock
        </span>Password </div> <input type='password' name='password'></label>
   </p>
   <div class="remember">
                    <div><input type='checkbox' name='remember' value="1"></div>
                    <div id="remember_sentence"><label for='remember'>Ricorda l'accesso</label></div>
                </div>
    <div id="submit"> <input type="submit" id="login_button" value="LOGIN"> </div> 
   
    </form>
 
    <div class="signup">Non hai un account? <a href="signup1.php">Iscriviti qui </a>
</main>
</section>
</body>
</html>