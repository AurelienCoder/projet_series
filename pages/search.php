<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php 
    $tag = $_GET['tag'] ?? '';
    $serie = $_GET['serie'] ?? '';
    $saison = $_GET['saison'] ?? '';
    $episode = $_GET['episode'] ?? '';
    $realisateur = $_GET['realisateur'] ?? '';
    $acteur = $_GET['acteur'] ?? '';
?>

<div style="margin-top: 10px; margin-bottom: 30px;">
<?php 
    $search = new \series\Search();
    if(!isset($_GET['search'])){
        $search->generateForm(); 
    }else{
        $search->getSearch(); 
    }?>
   </div>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
