<h1>Kauppalistasi:</h1>


<?php

foreach($model["lists"] as $list){
    
    $items = $list->getItems();
    

    ?>

<ul class="single-shoppinglist" style="list-style-type:none;">
    <li style="font-weight: bold;">
        <a href="?page=shoppinglist&action=showSingleList&params=<?php echo $list->getID(); ?>">
            <?php echo htmlspecialchars($list->getName()); ?>
        </a>
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
    <li>
        <a href="?page=shoppinglist&action=deleteList&params=<?php echo $list->getID(); ?>">Poista</a>
    </li>
    <li>
        <ul class="shoppinglist-items-listing">
            <?php foreach($items as $item){
                ?>
            <li>
                <?php
                    include("singleItemAsULelement.php");
                ?>
            </li>
            
                <?php
            
            } //end single list items listing
            
            ?>
            
        </ul>
    </li>
</ul>

    <?php
    
} // end items

?>

<a href="?page=shoppinglist&action=addForm">Lisää uusi lista</a>

