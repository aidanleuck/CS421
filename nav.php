            <span class = "searchbar-span">
            <input class = "search" placeholder="Search"></input>
            </span>
            <span class ="button-span">
            <button class = "searchbutton"><i id ="customize" class="fa fa-search" aria-hidden="true"></i></button>
            </span>
        <nav>
            <div id = "nav">
                <ul class = "nav-list">
                    <li class = "nav-item hover"><a href = "index.php">Home</a></li>
                    <li class = "nav-item hover"><a href = "shopbypart.php">Shop By Product #</a></li>
                    <li class = "nav-item hover"><a href = "order-policy.php">Order Policy</a></li>
                    <li class = "nav-item hover"><a href = "about.php">About Us</a></li>
                    <li class = "user-info hover">
                    <a href = "cart.php"><span class = "hover">
                        <span class = "cart">
                            <i class="gg-shopping-cart"></i>
                        </span>
                        <span class = "user-info-text">
                    </span>Cart</span></a>
                    
                    </li>
                    <!--------------Car dropdown will be implemented with JQuery/JS  ----------->
                    <li class = "user-info hover"><i class="fa fa-car" aria-hidden="true"></i></li>
                    <?php
                        session_start();
                        if($_SESSION['logged_in']){
                            echo '<a href = "logout_handler.php"><li class = "user-info hover">Log Out</li></a>';
                            echo '<a href= "account.php">';
                        }
                        else{
                            echo '<a href= "login.php">'; 
                        }
                    ?>
                    
                    <li class = "user-info hover"><i class="fa fa-user"></i></li></a>
                    
                    
            </div>

            </ul>
        </nav>