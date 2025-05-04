<?php

/**
 * Cette classe génère la page login.php et permet de se connecter
 */             
class Logger{

    public function generateLoginForm(string $action=null): void{ ?>
        <form method="post" action="<?php $action ?>" class="magic-card">
            <legend style="text-align: center; font-size: 25px;">ESPACE RESERVE A L'ADMINISTRATEUR</legend>
            <div class="form-group">
                <input type="text" name="username" placeholder="username">
                <input type="password" name="password" placeholder="password">
            </div>
            <button type="submit" class="btn btn-primary">LOGIN</button>
        </form>
    <?php
    }

    public function log(string $username, string $password) : array{
        $user = "admin";
        $pwd = "1234";

        $error = null;
        $nick = null;
        $granted = false;
        if(empty($username)){
            $error = "Le pseudo est vide";
        }elseif(empty($password)){
            $error = "Le mot de passe est vide";
        }elseif($user == $username and $pwd == $password){
            $granted = true ;
            $nick = htmlspecialchars("administrateur");
        }else{
            $error = "Authentification échouée";
        }
        return array(
            'granted' => $granted,
            'nick' => $nick,
            'error' => $error
        ) ;
    }
}