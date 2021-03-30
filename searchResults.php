<?php
include 'stylesheets.php';
include 'nav.php';

?>
<head><link rel="stylesheet" href="search.css"> </head>
<div id = "container">
    <div id = "headerBar">
        <h2 id = "headerTitle">Search Results</h2>
    </div>
<?php
if(isset($_SESSION['searchResults']) && count($_SESSION['searchResults'])){
    foreach ($_SESSION['searchResults'] as $result){
        echo 
        
        '<form method = "post" action = "cart.php">
        <div id = "search-row">
            <div id = "inner-search">
                <div id = "image" >
                    <img src = "'.$result['imageSrc'].'" class ="image-pic"></img>
                </div>
        
                <div id = "info">
        
                <div id = "title">
                        
                <a href = "products.php/?pID='.$result['partID'].'"><h2 class = "product">'.$result['partName'].'</h2></a>
                </div>
        
                <div id = "desc">'.$result['partDesc'].'</div>
                    
                <div id = "price">$'.$result['price'].'</div>
                </div>
        
                <input type = "hidden" name = "id" value = "'.$result['partID'].'"></input>
        
                <div id = "center">
                    <button id = "button" type = "submit">Add to Cart</button>
                </div>
        
                    
                </div>
        
        
                
                    </div>
                    </form>
        
                    
                    
                    <hr></hr>';
            }
}
else{
    echo '<h2 class = "none">No search results</h2>';
}



?>
</div>