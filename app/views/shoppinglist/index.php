<h1>Kauppalistat:</h1>


<?php

foreach($model["lists"] as $list){
    

    ?>

<ul style="list-style-type:none;">
    <li style="font-weight: bold;">
        <?php echo htmlspecialchars($list->getName()); ?>
    </li>
    <li>
        <?php echo ($list->getActive() ? "Aktiivinen" : "Epäaktiivinen"); ?>
    </li>
     <li>
        Päivitetty: <?php echo $list->getUpdated(); ?>
    </li>
    <li>
        <a href="?page=shoppinglist&action=modify&params=<?php echo $list->getID(); ?>">Muokkaa</a>
    </li>
</ul>

    <?php
    
}
?>

<a href="?page=shoppinglist&action=addForm">Lisää uusi lista</a>

