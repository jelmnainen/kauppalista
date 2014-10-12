<?php
    
    if($model["success"]){ //handle case success
        
        $list = $model["list"];
    
        require_once("allLists.php");
    
    } else {
    
        require_once("showSingleList.php");
    
    }