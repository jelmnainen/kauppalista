<?php

if(isset($model["message"]) && strlen($model["message"])){
    
    $message = $model["message"];
    ?>

<div class="bs-example" id="top-message">
    <div class="alert alert-info">
        <span class="close" id="top-message-close" data-dismiss="alert">&times;</span>
        <?php echo $message; ?>
    </div>
</div>

<?php
}