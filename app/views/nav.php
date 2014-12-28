
<nav id="main navigation">
    <ul class="nav nav-pills nav-justified">
        <?php 
        
        //show different nav for users depending on their login status     
        if(        isset($_SESSION["user"])
                &&! empty($_SESSION["user"]) ){

             ?>
                
            <li><a href="?page=home&action=info">Info</a></li>
            <li><a href="?page=shoppinglist">Kauppalistat</a></li>
            <li><a href="?page=login&action=logout">Kirjaudu ulos</a>
                
            <?php
               
        } else {
           
            ?>
                <li><a href="?page=home&action=info">Info</a></li>
                <li><a href="?page=register">Rekisteröidy</li></a> 
                <li><a href="?page=login">Kirjaudu sisään</li></a>
                
            <?php
        }
        ?>
    </ul>
    
</nav>


