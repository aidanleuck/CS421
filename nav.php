    <div id = "logo">
            F
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
                                echo '<a href = "logout_handler.php"><li id = "hover" class = "user-info">Log Out</li></a>';
                                echo '<a href= "account.php">';
                            }
                            else{
                                echo '<a href= "login.php">'; 
                            }

                        }
                        
                        else{
                            echo '<a href= "login.php">'; 
                        }
                    ?>
                    
                    <li class = "user-info" id = "hover"><i class="fa fa-user"></i></li></a>
                    </div>
                    
                    
            </div>

            </ul>
            