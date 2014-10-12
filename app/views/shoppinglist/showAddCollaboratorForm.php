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