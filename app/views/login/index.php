
<ul class="form-container" >
    
    <p>
        Jos haluat testata järjestelmää, käytä testitunnuksia!
        
        <ul>
            <li>Peruskäyttäjä:</li>
            <li>Käyttäjätunnus: testi</li>
            <li>Salasana: testi</li>
        </ul>
        <br />
        <ul>
            <li>Kollabori:</li>
            <li>Käyttäjätunnus: kollabori</li>
            <li>Salasana: kollabori</li>
        </ul>
    
    </p>
    
    <form id="loginform" method="post" action="?page=login&action=processLogin">
    
        <li>
            <label for="username-field">
                Käyttäjänimi
            </label>
            <input type="text" name="username" id="username-field">
        </li>
        
        <li>
            <label for="password-field">
                Salasana
            </label>
            <input type="password" name="password" id="password-field">
        </li>
        
        <li>
            <input type="submit" value="Kirjaudu">
        </li>
        
    </form>
        
</ul>