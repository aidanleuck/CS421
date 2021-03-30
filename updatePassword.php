<?php
include 'stylesheets.php'; 
include 'nav.php';;

if(!$_SESSION['logged_in']){
    header('Location:index.php');
}
?>
<html>
    <head>
    <link rel="stylesheet" href="manag.css?v=<?=time();?>">
    </head>
    <body>
        <div id = "container">
            <div id = "headerBar">
                <h2 id = "headerTitle">Update Password</h2>
            </div>
            <form method = "post" action = "updatePasswordHandler.php">
                <div id = "inputContainer">
                    <label for = "currentPassword">Current Password</label>
                    <div id = "inputError">
                        <input type = "password" name = "currentPassword" id = "currentPassword" class = "input"></input>
                        <span class = "error"><?php if(isset($_SESSION['errors']['currentPassword'])){echo $_SESSION['errors']['currentPassword'];}?></span>
                    </div>
                </div>

                <div id = "inputContainer">
                    <label for = "newPassword1">New Password</label>
                    <div id = "inputError">
                        <input type = "password" name = "newPassword1" id = "newPassword1" class = "input"></input>
                        <span class = "error"><?php if(isset($_SESSION['errors']['newPassword1'])){echo $_SESSION['errors']['newPassword1'];}?></span>
                    </div>
                </div>
                <div id = "inputContainer">
                    <label for = "newPassword2">Confirm Password</label>
                    <div id = "inputError">
                        <input type = "password" name = "newPassword2" id = "newPassword2" class = "input"></input>
                        <span class = "error"><?php if(isset($_SESSION['errors']['newPassword2'])){echo $_SESSION['errors']['newPassword2'];}?></span>
                    </div>
                </div>
                <?php if(isset($_SESSION['additionalErrors'])){
                    echo '<div id = "additionalErrors">
                    <div id = "error_box">
                    <span class="error_symbol"><i class="fas fa-exclamation-triangle"></i></span>
                            <span class = "middle">'.$_SESSION['additionalErrors'].'</span>
                            <span class = "right"><i class="fas fa-times-circle"></i></span>
                    </div>
                    </div>';

                }

                if(isset($_SESSION['succesfulForm']) && !$_SESSION['succesfulForm']){
                    echo '<h4 class = "error">There were errors in your form the password was not updated</h4>';
                }
                else if($_SESSION['succesfulForm']){
                    echo '<h4 class = "good">Password Updated</h4>';
                }    
                $_SESSION['additionalErrors'] = NULL;
                $_SESSION['errors'] = NULL;
                $_SESSION['succesfulForm'] = NULL;
                ?>
                <button class = "button" type = "submit">Update Password</button>
                </div>
            </form>

        </div>
        

    </body>
</html>
