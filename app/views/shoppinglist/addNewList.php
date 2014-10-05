<h2>
    <?php echo $model["message"] ; ?>
</h2>

<?php
    
    if($model["success"]){ //new list was added succesfully
        
        require_once("showSingleList.php");
        
    } else { // new list wasn't added
        
        require_once("index.php");        
        
    }