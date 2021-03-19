<html>
    <head>
    <?php include "stylesheets.php" ?>
    <link rel="stylesheet" href="login.css"> 
    </head>
    <body>
       

        <div id = "container">
            <h3>Sign-In</h3>
            <form action = "login_handler.php" method = "post">
            <div id = "label">Email Address</div>
            <input type = "text" id = "email" name = "email" placeholder = "Email Address"></input>

            <div id = "label">Password</div>
            <input type = "password" id = "password" name = "password" placeholder = "Password"></input>

            <button type = "submit">Log in</button>
            </form>

            <?php
                session_start();
                if(isset($_SESSION['login_error']) && $_SESSION['login_error']){
                    echo '<div id = "error">Incorrect username or password</div>';
                    $_SESSION['login_error'] = FALSE;
                }
                   
                ?>

            
        
        </div>
        <hr></hr>
        <div id = "register">
            <div id = "inner-register">
               <div id = "text-inner">
                <!-------- NOT YET IMPLEMENTED -------------->
                <a class = "a-button" href = "#"><span class = "login-text">Create an Account</span></a>
                </div>
            
            </div>
            </div>

  
    </body>
</html>