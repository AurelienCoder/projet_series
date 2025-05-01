<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<!-- PAS ENCORE UTILISÉ -->
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
        $serieDB = new \sdb\SerieDB();

        //si l'utilisateur n'a pas encore fait de requête, alors on affiche le formulaire avec generateForm();
        if(!isset($_GET['search']) || $_GET['search'] == ""){
            $search->generateForm(); 
        }else if(isset($_GET['search'])){ //sinon, on affiche le résultat de sa recherche grâce à getSearch();
            echo "<div id='home-title'></div>

            <div style='display:flex; overflow-x: auto;'>";
                $search->getSearch(); 
            echo "</div>";
        } else if(isset($_GET['acteur'])){

            $seriesActeur = $serieDB->getSpecialRequest($_GET['acteur']);
            
            foreach($seriesActeur as $serie){
                echo $serie->getHTML();
            }
        }else if(isset($_GET['serie'])){

            echo "<div id='home-title'></div>

            <div style='display:flex; overflow-x: auto;'>";
                $saisons = $search->getSaisons($_GET['serie']);
            echo "</div>";
        }
        ?>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
