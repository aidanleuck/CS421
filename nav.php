    <?php
    include 'database.php';
    include 'user.php';
    session_start();
   
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
                        <li class = "nav-item" ><a class= "link" id = "hover"href = "index.php">Home</a></li>
                        <li class = "nav-item " ><a class= "link" href = "shopbypart.php" id = "hover">Shop By Product #</a></li>
                        <li class = "nav-item " ><a class= "link"id = "hover" href = "order-policy.php">Order Policy</a></li>
                        <li class = "nav-item " ><a class= "link" id = "hover" href = "about.php">About Us</a></li>
                        <li class = "user-info " id = "hover">
                        <a class= "link" id = "hover" href = "cart.php"><span>
                            <span id = "" class = "cart">
                                <i class="fas fa-shopping-cart"></i>
                            </span>
                            <span class = "user-info-text">
                        </span>Cart</span></a>
                   
                    </li>
                    
                   
                    <li class = "user-info car" id = "hover"><i class="fa fa-car" aria-hidden="true"></i>
                   
                    <div class = "dropdown hidden">
                    <h3 class = "no-margin">Select a Vehicle</h3>
                    <select class= "vehicleSel">
                    <?php  
       
                    
                    $dao = new Database();
                   
                     if(isset($_SESSION['logged_in']) && $_SESSION['logged_in']){
                        $result = $dao->getVehiclesUser($_SESSION['user']->getAccountID());
                        
                        if(isset($_SESSION['selectedVehicle'])){
                            foreach($result as $i){
                                if($_SESSION['selectedVehicle'] === $i["vehicleID"]){
                                    echo '<option selected="selected">'.$i["year"] . " " . $i["make"] . " ". $i["model"].'</option>';
                                }
                                else{
                                    echo '<option>'.$i["year"] . " " . $i["make"] ." ". $i["model"].'</option>';
                                }
                                
                            }
                        }
                        else{
                            foreach($result as $i){
                                echo '<option>'.$i["year"] . " " . $i["make"] . " ". $i["model"].'</option>';
                            }
                        }

                        
                     }
                    ?></select>
                    <div class = "small-text">
                    Nothing there? <a id = "link" href = "manageVehicle.php">Click Here</a>.
                    </div>
                    </div>
                    
                    </li>
                 
                    
                    
                    <?php
                        
                        if(isset($_SESSION['logged_in'])){
                        
                            if($_SESSION['logged_in']){
                                echo '<li class = "user-info"><a id = "hover" href = "logout_handler.php">Log Out</a></li>';
                                echo '<li class = "user-info"><a class= "link"id = "hover" href= "account.php"><i class = "fa fa-user" aria-hidden = "true"></i></a></li>';
                            }
                            else{
                                echo '<li class = "user-info"><a class= "link" id = "hover" href= "login.php"><i class = "fa fa-user" aria-hidden = "true"></i></a></li>';; 
                            }

                        }
                        
                        else{
                            echo '<li class = "user-info"><a class= "link"id = "hover" href= "login.php"><i class = "fa fa-user" aria-hidden = "true"></i></a></li>';
                        }
                        
                    ?>
                    
                    
                    </div>
                    
                    
            </div>

            </ul>
            