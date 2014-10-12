<?php
    
    if($model["success"]){ //new list was added succesfully

        $list = $model["list"];
        
        require_once("singleListElement.php");
        
    } else { // new list wasn't added
        
        require_once("index.php");        
        
    }