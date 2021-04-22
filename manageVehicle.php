<?php
include 'stylesheets.php'; 
include 'nav.php';

if(!isset($_SESSION['user']) || !$_SESSION['logged_in']){
    header('Location:index.php');
}
?>
<html>
    <head>
    <link rel="stylesheet" href="manag.css">
    <script src = "JS/vehicles.js"></script>
    </head>
    <body>
       
        <div id = "container">
        <div id = "headerBar">
            <h2 class = "headerTitle">Vehicle Management</h2>
        </div>
        <form>
            <table>
            <div id = "headerBar-small"><h2 class = "headerTitle-small">Your Vehicles</h2></div>
                <tr>
                
                    <th>Vehicle</th>
                    <th>Model</thead>
                    <th>Year</th>
                    <th>Delete</th>
                </tr>
                <?php 
           
               
                $dao = new Database();
                $result = $dao->getVehiclesUser($_SESSION['user']->getAccountID());
            
                foreach($result as $i){
                    echo '<tr class = "data">
                <td>'.$i['make'].'</td>
                <td>'.$i['model'].'</td>
                <td>'.$i['year'].'</td>
                <td><a class = "delete" href = "removeVehicle_handler.php?vID='.$i['vehicleID'].'"><i class="fas fa-minus-circle"></i></a>
                <input type = "hidden" class ="vID" name = "vID" value = "'.$i['vehicleID'].'"></input>
                </td>';
                
                }
                
                ?>
                
            
           
        </table>


        </form>

        
            <div id = "headerBar-small" class = "padding"><h2 class = "headerTitle-small">Add a Vehicle</h2></div>
            <div id = "inputContainer">
                <label for = "selectVehcile"></label>
                
                    <form id = "addVehicle" method = "post" action = "addVehicle_handler.php">
                        <div id = "select">
                            <div>
                            <label for = "make" class = "header">Make</label>
                            </div>
                       
                            <select name = "make" class = "input" id = "make">
                            <?php
                            
                                $dao = new Database();
                                foreach($dao->getAllMake() as $i){
                                    echo'<option>'.$i['make'].'</option>';
                                } 
                            ?>
                            </select>
                            <div>
                                <label for = "model" class = "header">Model</label>
                            </div>
                            
                            <select name = "model" class ="input" id = "model">
                            </select>
                            <div>
                            <label for = "year" class = "header">Make</label>
                            </div>
                      
                            <select name = "year" class = "input" id ="year"></select>
                            <div>
                                <button type = "submit" class = "button">Add Vehicle</button>
                            </div>
                        </div>

                    </form>
                
            <div>
      
        </div>
    </body>
</html>