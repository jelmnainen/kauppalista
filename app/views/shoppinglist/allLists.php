
<h2>Omat listasi</h2>
<?php

var_dump($model);

if(count($model["lists"]) > 0){

    foreach($model["lists"] as $list){

        include("singleListElement.php");

    } 
    
} else {
    
    ?>
        
        <p>Sinulla ei ole vielä yhtään listaa</p>

    <?php
    
}

?>
<br />
<a href="?page=shoppinglist&action=addForm">Lisää uusi lista</a>


<?php 

if(isset($model["collablists"])){

    if(count($model["collablists"]) > 0){

        ?>

        <h2>Listat, joissa olet mukana</h2>

        <?php

            foreach($model["collablists"] as $collablist){

                include("singleCollabListElement.php");

            }

    }
    
}





