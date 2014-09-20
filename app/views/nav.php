
<nav id="main navigation">
    <ul>
        <?php 
        
        //show different nav for users depending on their login status
        $logged_in_nav =    '<a href="?page=info">Info</a>' 
                        .   '<a href="?page=register">Rekisteröidy</a>' 
                        .   '<a href="?page=login">Kirjaudu sisään</a>';
        
        $logged_out_nav =   '<a href="?page=logout">Kirjaudu ulos</a>';
        
        echo(       isset($_SESSION["user"]["logged_in"])
                &&! empty($_SESSION["user"]["logged_in"])
                &&  $_SESSION["user"]["logged_in"] 
                ?   $logged_in_nav
                :   $logged_out_nav
        );
        
        ?>
    </ul>
    
</nav>


