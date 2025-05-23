<?php
session_start();

require_once "../class/Autoloader.php";
Autoloader::register();

$logger = new Logger();

$username = null;
$password = null;

if(isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $response = $logger->log(trim($username), trim($password));

    if($response['granted']){
        $_SESSION['time'] = time();
        $_SESSION['nickname'] = $response['nick'];
        header("Location: home.php");
        exit();
    }
}

ob_start();

if(!isset($response)):
    $logger->generateLoginForm();
elseif (!$response['granted']):
    echo "<div><h1 style='color:white; text-align:center'>" .$response['error']."</h1></div>";
    $logger->generateLoginForm();
endif;

$code = ob_get_clean();
Template::render($code);
?>