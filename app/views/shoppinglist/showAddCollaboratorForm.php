<?php 
    if(count($model["collaborators"]) > 0){
        ?>
            <h2>Listan tämänhetkiset kollaborit</h2>

            <table class="table">
                <thead>
                    <th>Käyttäjänimi</th>
                    <th>Poista kollaboreista</th>
                </thead>
                <tbody>
                    <?php 
                        foreach($model["collaborators"] as $collaborator){
                            ?>
                                <tr>
                                    <td><?php echo $collaborator->getUsername(); ?></td>
                                    <td>
                                        <a href="?page=shoppinglist&action=removeCollaboratorByIDFromListByID&params=<?php echo $collaborator->getID() . ";" . $model["id"]; ?>">
                                            <span class="glyphicon glyphicon-arrow-right btn-danger btn-xs"></span>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        <?php
    } else {
        ?>
            <div class="alert alert-info">Listalla ei ole vielä yhtään kollaboria</div>
        <?php
    }
    
?>

<h2>Lisää listallesi kollabori</h2>

<form method="POST" action="?page=shoppinglist&action=addCollaboratorToList&params=<?php echo $model["id"]; ?>">

    <div class="input-group">
        
            <span class="input-group-addon">Käyttäjätunnus</span>
            <input type="text" name="username" class="form-control">
        
    </div>
    <br />
    <div class="input-group">
        
        <input type="submit" value="Lisää kollabori">
        
    </div>

</form>

<h2>Hae käyttäjää</h2>

<form method="POST" action="?page=shoppinglist&action=searchForUsers&params=<?php echo $model["id"]; ?>">
    
    <div class="input-group">
        
        <span class="input-group-addon">Käyttäjätunnus</span>
        <input type="text" name="username" class="form-control">
    </div>
    <br />
    <div class="input-group">
        <input type="submit" value="Hae käyttäjänimeä">
    </div>
</form>