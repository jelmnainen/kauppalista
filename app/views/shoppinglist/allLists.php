<h1>Kauppalistasi:</h1>


<?php

foreach($model["lists"] as $list){
    
    $items = $list->getItems();
    
    include("showSingleList.php");
    
} 



