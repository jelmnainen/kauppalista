<?php

$list = $model["list"];

?>

<h2>Muokkaa <?php echo $list->getName(); ?>a</h2>
<form method="post" action="?page=shoppinglist&action=modifyList&params=<?php echo $list->getID(); ?>">
    <ul>
        <li>
            <label for="name">Nimi</label>
            <input type="text" value="<?php echo $list->getName(); ?>" name="name">
        </li>
        <li>
            <input type="submit" value="Lähetä">
        </li>
    </ul>
</form>    