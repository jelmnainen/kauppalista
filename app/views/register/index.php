<?php
    global $CONFIG;
    $actionurl = $CONFIG["homeurl"] . "?page=register&action=processRegisteration";
 ?>
<ul class="form-container" >
    
    <form id="registerform" method="post" action="<?php echo $actionurl; ?>">
    
        <li>
            <h2 style="color:red;">
                Älä käytä sellaista käyttäjätunnusta/salasanaa, jonka vuotamisesta on jotain haittaa
            </h2>
            <p>
                Sivuston tietokantayhteydet on toistaiseksi suojattu näiltä hyökkäystyypeiltä:
                <ul>
                    <li>
                        SQL-injektiot
                    </li>
                </ul>                
            </p>
        </li>
        <li>
            <label for="username">
                Käyttäjänimi
            </label>
            <input type="text" name="username" id="username">
        </li>
        
        <li>
            <label for="password">
                Salasana
            </label>
            <input type="password" name="password" id="password">
        </li>
        
        <li>
            <label for="password-retype">
                Salasana (uudestaan)
            </label>
            <input type="password" name="password-retype" id="password-retype">
        </li>

        
        <li>
            <label for="email">
                Sähköposti 
            </label>
            <input type="text" name="email" id="email">
        </li>
        
        <li>
            <input type="submit" value="Lähetä">
        </li>
        
    </form>
        
</ul>