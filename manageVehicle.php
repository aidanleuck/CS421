<?php
include 'stylesheets.php'; 
include 'nav.php';

?>
<html>
    <head><link rel="stylesheet" href="manag.css"></head>
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

                <tr>
                    <td>Subaru</td>
                    <td>Outback</td>
                    <td>2010</td>
                    <td><a href = ""><i class="fas fa-minus-circle"></i></a></td>
                
                
                </tr>
                <tr>
                    <td>Ford</td>
                    <td>Fusion</td>
                    <td>2010</td>
                    <td><a href = ""><i class="fas fa-minus-circle"></i></a></td>
                
                
                </tr>
            
           
        </table>


        </form>

        <form>
            <div id = "headerBar-small" class = "padding"><h2 class = "headerTitle-small">Add a Vehicle</h2></div>
            <div id = "inputContainer">
                <label for = "selectVehcile"></label>
                <h1>NOTE: ADDING A VEHICLE WILL REQUIRE JQUERY WILL BE IMPLEMENTED LATER (THIS PAGE IS A MOCKUP)</h1>
            <div>
        </form>
        </div>
    </body>
</html>