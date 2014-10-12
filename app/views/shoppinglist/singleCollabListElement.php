<?php
    
    $items = $collablist->getItems();

?>

<div class="single-shoppinglist">
    
    <h2><?php echo $collablist->getName(); ?></h2>
    
    <div class="single-list-inner">
        
        <p class="byline">
            Viimeksi muokattu: <?php echo $collablist->getUpdated(); ?><br />
            <?php echo ($collablist->getActive() ? "Aktiivinen" : "Epäaktiivinen"); ?><br />
        </p>
        
        <ul class="shoppinglist-items-listing list-group">
            <?php 
            
            if(count($items) > 0){
                foreach($items as $item){
                    ?>
                    <li>
                        <?php
                            include("singleItemAsULelement.php");
                        ?>
                    </li>
                    
                <?php
                }
            } else {
                ?>
                    <li>
                        Listalla ei ole yhtään ostosta.
                    </li>
                <?php
            }
            ?>
            
        </ul>
        
        <a href="?page=item&action=showAddItemToListForm&params=<?php echo $collablist->getID(); ?>">
            Lisää uusi ostos listalle
        </a>

    </div>
    
</div>