<?php
include 'stylesheets.php'; 
include 'user.php';
include 'database.php';
include 'nav.php'; 

if(!$_SESSION['logged_in']){
    header('Location: index.php');
}

?>

<html>
    <head>
    <link rel="stylesheet" href="manag.css?v=">
    <script src = "JS/updateAccount_validation.js"></script>
    </head>
    <body>
        <div id = "container">
            <div id ="headerBar">
                <h2 id = "headerTitle">Manage Your Account</h2>
            </div>
            <?php 
            
            $dao = new Database();
            $userInfo = $dao->getUserByID($_SESSION['user']->getAccountID());
            echo '
            <form method = "post" id = "form" action = "updateAccountHandler.php">
            <div id = "inputContainer">
                    <label for = "email">Email</label>
                    <div id = "inputError">
                   
                        <input type = "text" name = "email" id = "email" class = "input" value = "'; if(isset($_SESSION['savedForm']['email'])){
                            echo htmlentities($_SESSION['savedForm']['email']);
                        } 
                        else{
                            echo htmlentities($userInfo["email"]);
                        }
                        echo'"></input>
                        <span class = "error">'; if(isset($_SESSION['errors']['email'])) echo $_SESSION['errors']['email']; echo '</span>
                        </div>
                    </div>
                    <div id = "inputContainer">
                        <label for = "address">Address</label>
                        <div id ="inputError">
                        <input type = "text" name = "address" id = "address" class = "input" value = "'; if(isset($_SESSION['savedForm']['address'])){
                            echo $_SESSION['savedForm']['address'];
                        } 
                        else{
                            echo htmlentities($userInfo["address"]);
                        }
                        echo '"></input>
                        <span class = "error">'; if(isset($_SESSION['errors']['address'])) echo $_SESSION['errors']['address']; echo '</span>
                        </div>
                    </div>
               
                <div id = "inputContainer">
                    
                    <label for = "city">City</label>
                    <div id = "inputError">
                    <input type = "text" name = "city" id = "city" class = "input"value = "'; if(isset($_SESSION['savedForm']["city"])){
              
                        echo htmlentities($_SESSION['savedForm']['city']);
                    } 
                    else{
                        echo htmlentities($userInfo["city"]);
                    } echo '"></input>
                    <span class = "error">'; if(isset($_SESSION['errors']['address'])) echo $_SESSION['errors']['address']; echo '</span>
                    </div>
                </div>';
                

               echo '<div id = "inputContainer">
                    
                <label for = "state">State</label>';
                

                $states = array("AL", "AK", "AZ", "AR", "CA", "CO", "CT", "DE", "FL", "GA", "HI", "ID", "IL", "IN", "IA", "KS", "KY", 
                "LA", "ME", "MD", "MA", "MI", "MN", "MS", "MO", "MT", "NE", "NV", "NH", "NJ", "NM", "NY", "NC", "ND", "OH", "OK", "OR", "PA",
                "RI", "SC", "SD", "TN", "TX", "UT", "VT", "VA", "WA", "WV", "WI", "WY");
                echo '<div id ="inputError">
                <select name = "state" id = "state" class = "input">';
                

                    
                
                foreach($states as $state){
                    if(isset($_SESSION['savedForm']['state']) && $state === $_SESSION['savedForm']['state']){
                        echo '<option selected = "selected">';
                    }
                    else if($state === $userInfo['state'] ){
                        echo '<option selected = "selected">';
                    }
                    else{
                        echo '<option>';
                    }
                    
                    echo $state;
                    echo '</option>';
                } 
                
                echo '</select>
                <span class = "error">'; if(isset($_SESSION['errors']['state'])) echo $_SESSION['errors']['state']; echo '</span>
                </div>
                
            </div>';

            echo '<div id = "inputContainer">
                    <label for = "zip">Zip Code</label>
                    <div id = "inputError">
                   
                        <input type = "text" name = "zip" id = "zip" class = "input" value = "'; if(isset($_SESSION['savedForm']['zip'])){
                            echo htmlentities($_SESSION['savedForm']['zip']);
                        } 
                        else{
                            echo htmlentities($userInfo["zip"]);
                        }
                        echo'"></input>
                        <span class = "error">'; if(isset($_SESSION['errors']['zip'])) echo $_SESSION['errors']['zip']; echo '</span>
                        </div>
                    </div>';
                   

            if(isset($_SESSION['succesfulForm']) && !$_SESSION['succesfulForm']){
                    echo '<h4 class = "error">There were errors in your form the account was not updated</h4>';
            }
            else if(isset($_SESSION['succesfulForm']) && $_SESSION['succesfulForm']){
                    echo '<h4 class = "good">Account Updated</h4>';
            }    
            echo '<button class = "button" type = "submit">Update Information</button>
                
            </form>';
           
            $_SESSION['savedForm'] = NULL;
            $_SESSION['errors'] = NULL;
            $_SESSION['succesfulForm'] = NULL;
            ?>
        </div>
        <?php include 'footer.php' ?>
    </body>
</html>