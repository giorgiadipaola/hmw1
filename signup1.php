<?php 

     session_start();
    function checkAuth() {
       
        if(isset($_SESSION['vibes_id'])) {
            return $_SESSION['vibes_id'];
        } else 
            return 0;
    }

    if (checkAuth()) {
        header("Location: home.php");
        exit;
    } 
   
    if(!empty($_POST["username"]) && !empty($_POST["password"]) && 
       !empty($_POST["email"]) && !empty($_POST["name"]) &&
       !empty($_POST["surname"]) && !empty($_POST["confirm_password"]) && !empty($_POST["allow"]))
       {   
           
           $error=array();
           $conn = mysqli_connect("localhost", "root", "", "hmw1") or die("Errore: ".mysqli_connect_error());
        
        if(!preg_match('/^[a-zA-Z0-9_]{1,15}$/',$_POST['username'])) {
            $error[]='Username non valido';
        } else{
            $username = mysqli_real_escape_string($conn, $_POST['username']);
            $query = "SELECT username FROM users WHERE username = '$username'";
            $res = mysqli_query($conn, $query);
            if (mysqli_num_rows($res) > 0) {
                $error[] ="Ups.. esiste già un ".$username ; 
            }
        }
    
        if (strlen($_POST["password"]) <8) {
            $error[] = "La password inserita è troppo corta!!";
        } 
       
        if (strcmp($_POST["password"], $_POST["confirm_password"]) != 0) {
            $error[] = "Devi mettere la stessa!";
        }
        #FILTER_VALIDATE_EMAIL: convalida gli indirizzi email
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            $error[] = "Non so Rick.. a me non sembra un'email!";
        } else {
            $email = mysqli_real_escape_string($conn, strtolower($_POST['email']));
            $res = mysqli_query($conn, "SELECT email FROM users WHERE email = '$email'");
            if (mysqli_num_rows($res) > 0) {
                $error[] = "Email già associata ad un altro utente!";
            }
        }

       if ($cont=count($error)==0) {
                 
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $surname = mysqli_real_escape_string($conn, $_POST['surname']);
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $password = password_hash($password, PASSWORD_BCRYPT);
        $query = "INSERT INTO users(username, password, email, name, surname) VALUES('$username', '$password', '$email', '$name', '$surname')";
        
        if (mysqli_query($conn, $query)) {
            $errore="mysqli true";
            $_SESSION["username"] = $_POST["username"];
            #mysqli_insert_id($conn):return an integer that represents the value of the AUTO_INCREMENT
            # field updated by the last query.Returns zero if there were no update or no AUTO_INCREMENT field
            $_SESSION["vibes_id"] = mysqli_insert_id($conn);
            mysqli_close($conn);
            header("Location: home.php");
            
            exit;
        } else{
            $error[]= "errore di connessione al database";  
        }
        mysqli_close($conn);
    } 
}
    

?>


<html>

<head>
    <link rel= "stylesheet" href="signup1.css">
    <link href="https://fonts.googleapis.com/css2?family=MuseoModerno:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
    <script src="signup1.js" defer="true"></script>
    <title>Vibes- Iscrizione</title>

</head>
<body>

    <section>
        <img src="logo1.png">
        
    <main>
  
        <h1> Crea il tuo account! </h1>
        <div id="checkForm" class="hidden"> Devi compilare tutti i campi!</div>
    <form name='signup_form' method='post' >
  
    <div class="name_surname">
      <p class="name"> 
          <label for="name"> Nome <input type="text" name='name' <?php if(isset($_POST["name"])){echo "value=".$_POST["name"];} ?>></label>
          <span>Nome insolito</span>
      </p>
               
      <p class="surname">  <label for="surname">Cognome<input type="text" name='surname' <?php if(isset($_POST["surname"])){echo "value=".$_POST["surname"];} ?>></label>
        <span>Cognome insolito</span>
    </p>
     </div>   
     <div class="fields">
     <p class="username">
        <label for="username">Nome Utente<input type='text' name='username' <?php if(isset($_POST["username"])){echo "value=".$_POST["username"];} ?>></label>
        <span>Username non disponibile</span>
    </p>
    <p class="email">
        <label for="email">Email<input type='text' name='email' <?php if(isset($_POST["email"])){echo "value=".$_POST["email"];} ?>></label> <span>Email non valida</span>
    </p>
    <p class="password">
        <label for="password">Password<input type='password' name='password' <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></label> <span>Deve essere di almeno 8 caratteri!</span>
    </p>

    <p class="confirm_password">
        <label for="confirm_password">Conferma Password<input type='password' name='confirm_password' <?php if(isset($_POST["confirm_password"])){echo "value=".$_POST["confirm_password"];} ?>></label>
       <span>Le password non coincidono!</span>
    </p>
    
    <div class="allow"> 
                    <div><input type='checkbox' name='allow' value="1"  <?php if(isset($_POST["password"])){echo "value=".$_POST["password"];} ?>></div>
                    <div id="allow_sentence"><label for='allow'>Acconsento e non leggerò mai la politica</label></div>
                </div>
    
    <p>
     <input id="signup_button" type='submit' value="REGISTRATI" id="submit">
    </p>
</div>
    </form>
    <div class="login">Hai già un account? <a href="login1.php">Accedi</a>

</main>

</section>
</body>
</html>