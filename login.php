<html>
    <head>
    <?php include "stylesheets.php" ?>
    <link rel="stylesheet" href="logrc.css"> 
    </head>
    <body>
       

        <div id = "container">
            <div id = "header-bar">
                <div id = "arrow">
                    <a href = "index.php" ><i class="fas fa-arrow-circle-left"></i></a>
                </div>
            
            
      
            <h3>Sign-In</h3>
            </div>
           
            

          
            <form action = "login_handler.php" method = "post">
            <div id = "label">Email Address</div>
            <input class="input-text" type = "text" id = "email" name = "email" placeholder = "Email Address"></input>

            <div id = "label">Password</div>
            <input class ="input-text" type = "password" id = "password" name = "password" placeholder = "Password"></input>
            
            <input class ="submitForm" type = "submit" value ="Log In"></button>
          
            
            </form>

            <?php
                session_start();
                if(isset($_SESSION['login_error']) && $_SESSION['login_error']){
                    echo '<div id = "error">Incorrect email or password</div>';
                    $_SESSION['login_error'] = FALSE;
                }
                   
                ?>

            
        
        </div>
        <hr></hr>
        <div id = "register">
            <div id = "inner-register">
               <div id = "text-inner">
                <!-------- NOT YET IMPLEMENTED -------------->
                <a class = "a-button" href = "create_account.php"><span class = "login-text">Create an Account</span></a>
                </div>
            
            </div>
            </div>

  
    </body>
</html>