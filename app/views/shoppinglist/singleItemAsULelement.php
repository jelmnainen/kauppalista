<?php

    //isBought is a string...
    $isBought = ($item->getIsBought() === "true" ? TRUE : FALSE); 

    $status = ($isBought ? "list-group-item-success" : "list-group-item-warning");
    
    $price = ( !empty($item->getPrice())
                            ?  ": " . $item->getPrice() . "€" 
                            : '' 
                        ); 
    
?>

<ul class="shoppinglist-items-listing-single-item list-group">
                    <li class="list-group-item <?php echo $status; ?> ">
                        <?php 
                            echo $item->getName() 
                                    . $price ; 
                        ?>
                        
                        <?php if(!$isBought) { ?>
                        
                            <a class="text-right" href="?page=shoppinglist&action=itemHasBeenBought&params=<?php echo $item->getID(); ?>">
                                <span class="glyphicon glyphicon-ok btn-success btn-xs"></span>
                            </a>
                        
                        <?php } else { ?>
                        
                            <a class="text-right" href="?page=shoppinglist&action=setItemToNotBought&params=<?php echo $item->getID(); ?>">
                                <span class="glyphicon glyphicon-chevron-up btn-warning btn-xs"></span>
                            </a>
                        
                        <?php } ?>
                        
                        <a href="?page=item&action=showModifyForm&params=<?php echo $item->getID(); ?>">
                            <span class="glyphicon glyphicon-pencil btn-xs"></span>
                        </a>
                        <a class="text-right" href="?page=shoppinglist&action=deleteItemFromList&params=<?php echo $item->getID(); ?>">
                            <span class="glyphicon glyphicon-remove btn-danger btn-xs"></span>
                        </a>
                    </li>
                    

                    <?php
                        echo (!empty($item->getShop()) 
                                ?     '<li class="list-group-item">Kauppa: ' 
                                        . $item->getShop() 
                                    . '</li>'
                                
                                : ''
                        ); 
                    ?>
       
                     <?php 
                        echo (!empty($item->getBuyer()) 
                                ?     '<li class="list-group-item">' . 
                                        'Ostaja: ' .  $item->getBuyer()
                                    . '</li>'
                                : ''
                        ); 
                    ?>
                    
                        
                </ul>