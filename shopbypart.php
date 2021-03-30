<html>
    <head>
        <?php
        include "stylesheets.php"
        ?>
         <link rel="stylesheet" href="table.css">
    </head>
    <body>
        <?php
        include "nav.php"
        ?>
        <div id = "container">
        <table>
            <thead>
                <tr>
                    <th>Part #</th>
                    <th>Part Name</th>
                    <th>Price</th>
                    <th></th>
                </tr>
                <?php include 'database.php'; 
                $dao = new Database();
                $dao->printAllParts();?>
            </thead>

        </table>
        </div>
        <?php
        include "footer.php"
        ?>

    </body>
</html>
