<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php
    $dashboard = new \series\Dashboard();

    if($logged){
        if(isset($_GET['supp'])){
            $dashboard->supprimerSerie($_GET['supp']);
        }else if(isset($_GET['modif'])){
            $dashboard->modifierSerie($_GET['modif']);
        }else{
            $dashboard->ajouterSerie();
        }
    }else{
        echo "<h1>VOUS N'AVEZ PAS ACCES A CETTE PAGE</h1>";
    }
?>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>