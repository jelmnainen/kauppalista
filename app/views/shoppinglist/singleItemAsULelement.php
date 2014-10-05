<ul class="shoppinglist-items-listing-single-item">
                    <li>
                        <?php echo $item->getName(); ?>
                    </li>
                    
                    <?php
                        echo (!empty($item->getPrice())
                            ?     '<li>Hinta: ' 
                                    . $item->getPrice() 
                                . '€</li>' 
                                    
                            : '' 
                        ); 
                    ?>
                    

                    <?php
                        echo (!empty($item->getShop()) 
                                ?     '<li>Kauppa: ' 
                                        . $item->getShop() 
                                    . '</li>'
                                
                                : ''
                        ); 
                    ?>
       
                     <?php 
                        echo (!empty($item->getBuyer()) 
                                ?     '<li>' . 
                                        $item->getBuyer()
                                    . '</li>'
                                : ''
                        ); 
                    ?>
                    <li>
                        <?php echo ($item->getIsBought() ? 'Ostettu' : 'Ei ostettu'); ?>
                    </li>
                    <li>
                        <a href="?page=item&action=showModifyForm&params=<?php echo $item->getID(); ?>">
                            Muokkaa
                        </a>
                    </li>
                    <li>
                        <a href="?page=shoppinglist&action=deleteItemFromList&params=<?php echo $item->getID(); ?>">
                            Poista ostos
                        </a>
                </ul>