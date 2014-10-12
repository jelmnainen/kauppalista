<?php

if(isset($model["message"]) && strlen($model["message"]) > 0){
    
    $message = $model["message"];
    $alertType = "alert-info";
    
    if(isset($model["alertType"])){
        
        $alertType =  $model["alertType"];
    }
    ?>

    <div class="bs-example" id="top-message">
        <div class="alert <?php echo $alertType; ?>">
            <span class="close" id="top-message-close" data-dismiss="alert">&times;</span>
            <?php echo $message; ?>
        </div>
    </div>

<?php
}