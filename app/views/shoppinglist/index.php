<h1>Kauppalistat:</h1>


<?php

foreach($model["lists"] as $list){
    

    ?>

<ul style="list-style-type:none;">
    <li style="font-weight: bold;">
        <?php echo $list->getName(); ?>
    </li>
    <li>
        Aktiivinen: <?php echo $list->getActive(); ?>
    </li>
     <li>
        Päivitetty: <?php echo $list->getUpdated(); ?>
    </li>
    <li>
        <a href="?page=shoppinglist&action=modify&param=<?php echo $list->getID(); ?>">Muokkaa</a>
    </li>
</ul>

    <?php
    
}
?>

