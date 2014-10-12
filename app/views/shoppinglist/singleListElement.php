<?php
    
    $items = $list->getItems();

?>

<div class="single-shoppinglist">
    
    <h2><?php echo $list->getName(); ?></h2>
    
    <div class="single-list-inner">
        
        <p class="byline">
            Viimeksi muokattu: <?php echo $list->getUpdated(); ?><br />
            <?php echo ($list->getActive() ? "Aktiivinen" : "Epäaktiivinen"); ?><br />
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
        
        <a href="?page=item&action=showAddItemToListForm&params=<?php echo $list->getID(); ?>">
            Lisää uusi ostos listalle
        </a>
        <br />
        <a href="?page=shoppinglist&action=showAddCollaboratorForm&params=<?php echo $list->getID(); ?>">
            Lisää listalle kollabori
        </a>
        <br />
        <a href="?page=shoppinglist&action=deleteList&params=<?php echo $list->getID(); ?>">
            Poista lista
        </a>
        

    </div>
    
</div>