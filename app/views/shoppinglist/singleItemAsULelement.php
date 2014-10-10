<?php

    $status = ($item->getIsBought() ? "list-group-item-success" : "list-group-item-warning");
    
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
                        <a class="text-right" href="?page=shoppinglist&action=setItemToBought&params=<?php echo $item->getID(); ?>">
                            <span class="glyphicon glyphicon-ok btn-success btn-xs"></span>
                        </a>
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
                                        $item->getBuyer()
                                    . '</li>'
                                : ''
                        ); 
                    ?>
                    
                        
                </ul>