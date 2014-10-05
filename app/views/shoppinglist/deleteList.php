<h2><?php echo $model["message"] ?></h2>

<?php
    
    if($model["success"]){ //handle case success
    
        require_once("index.php");
    
    } else {
    
        require_once("showSingleList.php");
    
    }