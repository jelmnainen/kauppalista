
<nav id="main navigation">
    <ul>
        <?php 
        
        //show different nav for users depending on their login status
        $logged_out_nav =   '<li><a href="?page=home">Info</a></li>' 
                        .   '<li><a href="?page=register">Rekisteröidy</li></a>' 
                        .   '<li><a href="?page=login">Kirjaudu sisään</li></a>'
                        .   '<li><a href="?page=shoppinglist">Kauppalistat</a></li>';
        
        $logged_in_nav  =   '<li><a href="?page=home">Info</a></li>'
                        .   '<li><a href="?page=shoppinglist">Kauppalistat</a></li>'
                        .   '<li><a href="?page=login&action=logout">Kirjaudu ulos</a>';
        
        
         if(        isset($_SESSION["user"])
                &&! empty($_SESSION["user"]) ){

                echo $logged_in_nav;
               
            } else {
                
                echo $logged_out_nav;
                
            }
        
        
        ?>
    </ul>
    
</nav>


