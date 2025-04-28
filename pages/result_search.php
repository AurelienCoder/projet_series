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

<?php if ($logged): ?>
    <h1 style="text-align:center;">Hi <?php echo htmlspecialchars($_SESSION['nickname']); ?></h1>
<?php endif; ?>

<div style="margin-top: 100px;">
    <div class="title" style="text-align:center; font-size:2rem;">LES SERIES DU MOMENT : </div>

    <?php 
        $serieDB = new \sdb\SerieDB();
        $series = $serieDB->getAllSeries();

        foreach($series as $serie){
            if($_GET['serie'] == $serie->getTitreSerie()){
                echo $serie->getHTML();
            }
        }
    ?>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
