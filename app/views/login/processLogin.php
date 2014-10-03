<?php 

if($model){
        
        ?>

        <h2>Tervetuloa takaisin!</h2>
        <p>Niin siis se sisäänkirjautuminen meni nappiin</p>
        
        <?php

    } else {
        
        ?>
        
        <h2>Kirjautuminen epäonnistui</h2>
        <p>
            Joko käyttäjänimi tai salasana oli väärin.
            <a href="?page=login">
                Kokeile uudestaan?
            </a>
        </p>

        <?php
        
    }