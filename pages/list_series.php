<?php
    session_start() ;
    $logged = isset($_SESSION['nickname']) ;
    require_once "../class/Autoloader.php";
    Autoloader::register();
?>

<?php ob_start() ?>
<?php 

?>
<?php $code = ob_get_clean() ?>
<?php Template::render($code); ?>