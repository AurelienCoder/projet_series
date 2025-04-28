<?php

class Logger{

    public function generateLoginForm(string $action=null): void{ ?>
        <form method="post" action="<?php $action ?>" class="magic-card">
            <legend style="text-align: center; font-size: 25px;">Please Login</legend>
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

        $error = null ;
        $nick = null ;
        $granted = false ;
        if (empty($username)){
            $error = "username is empty" ;
        }elseif (empty($password)){
            $error = "password is empty" ;
        }elseif ($user == $username and $pwd == $password){
            $granted = true ;
            $nick = htmlspecialchars("administrateur") ;
        }else{
            $error = "Authentification Failed" ;
        }
        return array(
            'granted' => $granted,
            'nick' => $nick,
            'error' => $error
        ) ;
    }
}