
<h2>Lisää ostosta</h2>

<form method="POST" action="?page=shoppinglist&action=addItem&params=<?php echo $model["id"]; ?>">

    <ul>
        <li>
            <label for="name">Nimi: </label>
            <input name="name" type="text" value="">
        </li>
        <li>
            <label for="price">Hinta: </label>
            <input name="price" type="text" value="">
        </li>
        <li>
            <label for="shop">Kauppa: </label>
            <input name="shop" type="text" value="">
        </li>
        <li>
            <label for="bought">Ostettu: </label><br />
                        Kyllä   <input type="radio" name="bought" value="true" ><br />
                        Ei      <input type="radio" name="bought" value="false" checked="checked">
                       
        </li>
        <li>
            <input type="submit" value="Lähetä">
        </li>
    </ul>
    
</form>