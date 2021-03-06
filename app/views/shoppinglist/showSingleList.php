<?php
    
    $list = $model["list"];
    $items = $list->getItems();

?>

<div class="single-shoppinglist">
    
    <h2><?php echo $list->getName(); ?></h2>
    
    <div class="single-list-inner">
        
        <p class="byline"> Viimeksi muokattu: <?php echo $list->getUpdated(); ?></p>
        
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
        
        <a href="?page=item&action=addItemToList&params=<?php echo $list->getID(); ?>">
            Lisää uusi ostos listalle
        </a>
        

    </div>
    
</div>