<?php
    
    $list = $model["list"];
    $items = $list->getItems();

?>

<div class="single-shoppinglist">
    
    <h2><?php echo $list->getName(); ?></h2>
    
    <div class="single-list-inner">
        
        <p class="byline"> Viimeksi muokattu: <?php echo $list->getUpdated(); ?></p>
        
        <ul class="shoppinglist-items-listing">
            <?php 
                foreach($items as $item){
                    ?>
                    <li>
                        <?php
                            include("singleItemAsULelement.php");
                        ?>
                    </li>
                    
                <?php
                }
            ?>
            
        </ul>

    </div>
    
</div>