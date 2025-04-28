<?php
session_start();

require_once "../class/Autoloader.php";
Autoloader::register();

$logger = new Logger();

$username = null;
$password = null;
if (isset($_POST['username']) and isset($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $response = $logger->log(trim($username), trim($password));
    if ($response['granted']){
        $_SESSION['nickname'] = $response['nick'];
        header("Location: ../index.php");
        exit() ;
    }
}

ob_start();

if(!isset($response)):
    $logger->generateLoginForm("", $username);
elseif (!$response['granted']) :
    echo "<div class='' id='error'>" .$response['error']."</div>";
    $logger->generateLoginForm("", $username, $response['error']);
endif;

$code = ob_get_clean();
Template::render($code);
?>