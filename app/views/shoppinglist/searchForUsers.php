<?php

if(count($model["users"]) > 0 ){
    ?>


        <table class="table">
            <thead>
                <tr>
                    <th>Käyttäjänimi</th>
                    <th>Lisää kollabori</th>
                </tr>
            </thead>
            <tbody>
                <?php
                
                    foreach($model["users"] as $user){
                        ?>
                        <tr>
                            <td><?php echo $user->getUsername() ?></td>
                            <td>
                                <a href="?page=shoppinglist&action=addUserByIDAsCollaborator&params=<?php echo $user->getID() . ";" . $model["listID"]; ?>">
                                    <span class="glyphicon glyphicon-arrow-right btn-success btn-xs"></span>
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

        <div class="alert alert-info">
            Nimellä ei löytynyt yhtään käyttäjää.
        </div>

    <?php
}