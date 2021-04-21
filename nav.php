    <?php
     $actualLink = $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
     $firstSlash = explode("/", $actualLink);

     if($_SERVER['HTTP_HOST'] . '/' . $firstSlash[1] . '/' === $actualLink){
         header('Location:index.php');
         exit;
     }

    ?>
    
    <div id = "logo">
            
    </div>
       
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <div id ="searchbar">
                <form method = "post" action ="search_handler.php">

            
                    <span class = "searchbar-span">
                        <input class = "search" name = "searchVal" placeholder="Search"></input>
                    </span>
                    <span class ="button-span">
                        <button type = "submit" class = "searchbutton"><i id ="customize" class="fa fa-search" aria-hidden="true"></i></button>
                    </span>
                </form>
            </div>
      
      
            <div id = "nav">
               
                <div id = "links">
                    <ul class = "nav-list">
                        <li class = "nav-item" ><a id = "hover"href = "index.php">Home</a></li>
                        <li class = "nav-item " ><a href = "shopbypart.php" id = "hover">Shop By Product #</a></li>
                        <li class = "nav-item " ><a id = "hover" href = "order-policy.php">Order Policy</a></li>
                        <li class = "nav-item " ><a  id = "hover" href = "about.php">About Us</a></li>
                        <li class = "user-info " id = "hover">
                        <a id = "hover" href = "cart.php"><span>
                            <span id = "" class = "cart">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <span class = "user-info-text">
                        </span>Cart</span></a>
                   
                    </li>
                    <!--------------Car dropdown will be implemented with JQuery/JS  ----------->
                    <li class = "user-info " id = "hover"><i class="fa fa-car" aria-hidden="true"></i></li>
                    
                    
                    <?php
                        session_start();
                        if(isset($_SESSION['logged_in'])){
                        
                            if($_SESSION['logged_in']){
                                echo '<li class = "user-info"><a id = "hover" href = "logout_handler.php">Log Out</a></li>';
                                echo '<li class = "user-info"><a id = "hover" href= "account.php"><i class = "fa fa-user" aria-hidden = "true"></i></a></li>';
                            }
                            else{
                                echo '<li class = "user-info"><a id = "hover" href= "login.php"><i class = "fa fa-user" aria-hidden = "true"></i></a></li>';; 
                            }

                        }
                        
                        else{
                            echo '<li class = "user-info"><a id = "hover" href= "login.php"><i class = "fa fa-user" aria-hidden = "true"></i></a></li>';
                        }
                        
                    ?>
                    
                    
                    </div>
                    
                    
            </div>

            </ul>
            