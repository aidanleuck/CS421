<html>

<head>
	<link rel="stylesheet" href="create_accour.css">
	<?php include "stylesheets.php" ?>
</head>

<body>
	<div id="body">
		<div id="headerBar"> <a href="login.php"><i class="fas fa-arrow-circle-left"></i></a>
			<div id="title-position">
				<h1>Create an Account</h1> </div>
		</div>
		<div id="container">
			<form action="account_handler.php" method="post">
				<div id="label">
					<label for="email">
						<h3>Email Address</h3></label>
				</div>
                <input class="input-text" type="text" id="email" name="email" placeholder="Email Address" value="<?php  session_start(); if(isset($_SESSION['savedForm']['email1'])) echo $_SESSION['savedForm']['email1'];?>"></input>
                <span class = "error">
                        <?php 
                            
                            if(isset($_SESSION['errors']['emptyEmail1']) && $_SESSION['errors']['emptyEmail1']){
                               echo "*";
                            }
                            if(isset($_SESSION['errors']['email1Valid']) && !$_SESSION['errors']['email1Valid']){
                                echo "Email is not in the correct format";
                            }
                        ?>
                    </span>
				<div id="input">
					<div id="label">
						<label for="confirmEmail">
                            <h3>Confirm Email</h3></label>
					</div>
                    <input class="input-text" type="text" id="confirmEmail" name="confirmEmail" placeholder="Confirm Email" value="<?php if(isset($_SESSION['savedForm']['email2'])) echo $_SESSION['savedForm']['email2'];?>"></input>
                    <span class = "error">
                        <?php 
                             if(isset($_SESSION['errors']['emptyEmail2']) && $_SESSION['errors']['emptyEmail2']){
                                echo "*";
                             }
                             if(isset($_SESSION['errors']['email2Valid']) && !$_SESSION['errors']['email2Valid']){
                                 echo "Email is not in the correct format";
                             }
                        ?>
                    </span>
				</div>
				<div id="input">
					<div id="label">
						<label for="password">
							<h3>Password</h3></label>
					</div>
                    <input class="input-text" type="password" id="password" name="password" placeholder="Password"></input>
                    <span class = "error">
                        <?php 
                            if(isset($_SESSION['errors']['emptyPassword1']) && $_SESSION['errors']['emptyPassword1']){
                                echo "*";
                             }
                             if(isset($_SESSION['errors']['password1Valid']) && !$_SESSION['errors']['password1Valid']){
                                 echo "Password must be 8 characters long and contain one special character and number";
                             }
                        ?>
                    </span>
				</div>
				<div id="input">
					<div id="label">
						<label for="confirmPassword">
                            <h3>Confirm Password</h3></label>
					</div>
                    <input class="input-text" type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm Password"></input>
                    <span class = "error">
                        <?php 
                            if(isset($_SESSION['errors']['emptyPassword2']) && $_SESSION['errors']['emptyPassword2']){
                                echo "*";
                             }
                             if(isset($_SESSION['errors']['password2Valid']) && !$_SESSION['errors']['password2Valid']){
                                 echo "Password must be 8 characters long and contain one special character and number";
                             }
                           
                        ?>
                    </span>
                </div>

                <div id = "additionalErrors">
                    
                    <?php 
                    if(isset($_SESSION['additionalErrors']) && count($_SESSION['additionalErrors'])){
                        echo'<h3>Additional Errors</h3>';
                        foreach ($_SESSION['additionalErrors'] as $error ){
                            echo '<div id = "error_box">
                            <span class="error_symbol"><i class="fas fa-exclamation-triangle"></i></span>
                            <span class = "middle">'.$error.'</span>
                            <span class = "right"><i class="fas fa-times-circle"></i></span>
                            </div>';
                        }
                    } 
                    $_SESSION['additionalErrors'] = NULL;
                    $_SESSION['errors'] = NULL;
                    $_SESSION['savedForm'] = NULL;
                    ?>
                    
                </div>
                <button type = "submit">Create Account</button>
			</form>
		</div>
	</div>
</body>

</html>