<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php
    $dashboard = new \series\Dashboard();

    if(isset($_GET['idSupp'])){
        $dashboard->supprimerSerie($_GET['idSupp']);
    }else if(isset($_GET['idModif'])){
        $dashboard->modifierSerie($_GET['idModif']);
    }else{
        $dashboard->ajouterSerie();
    }
?>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>