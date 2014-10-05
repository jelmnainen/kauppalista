<?php
    
    $item = $model["item"];
    
?>

<h2>Muokkaa ostosta</h2>

<form method="POST" action="?page=item&action=modifyItem&params=<?php echo $item->getID(); ?>">

    <ul>
        <li>
            <label for="name">Nimi: </label>
            <input name="name" type="text" value="<?php echo $item->getName(); ?>">
        </li>
        <li>
            <label for="price">Hinta: </label>
            <input name="price" type="text" value="<?php echo $item->getPrice(); ?>">
        </li>
        <li>
            <label for="shop">Kauppa: </label>
            <input name="shop" type="text" value="<?php echo $item->getShop(); ?>">
        </li>
        <li>
            <label for="bought">Ostettu: </label><br />
            <?php
                echo ($item->getIsBought() === "true" //string, not bool
                        ?     'Kyllä   <input type="radio" name="bought" value="true" checked="checked"><br />'
                            . 'Ei      <input type="radio" name="bought" value="false">'
                        :     'Kyllä   <input type="radio" name="bought" value="true"><br />'
                            . 'Ei      <input type="radio" name="bought" value="false" checked="checked">');
            ?>
        </li>
        <li>
            <input type="submit" value="Lähetä">
        </li>
    </ul>
    
</form>