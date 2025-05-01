<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<!-- PAS ENCORE UTILISÉ -->
<?php
    $tag = $_GET['tag'] ?? '';
    $serie = $_GET['serie'] ?? '';
    $saison = $_GET['saison'] ?? '';
    $episode = $_GET['episode'] ?? '';
    $realisateur = $_GET['realisateur'] ?? '';
    $acteur = $_GET['acteur'] ?? '';
?>

<?php ob_start() ?>

<div style="margin-top: 10px; margin-bottom: 30px;">
    <?php 
        $search = new \series\Search();
        $serieDB = new \sdb\SerieDB();

        if(isset($_GET['search'])){ //$_GET['search'] est utilisé pour afficher soit tous les acteurs ou les réalisateurs ou les séries
            echo "<div id='home-title'></div>

            <div style='display:flex; overflow-x: auto;'>";
                $search->getSearch(); 
            echo "</div>";
        } else if(isset($_GET['serie'])){

            echo "
            <div id='home-title'></div>

            <div style='display:flex; overflow-x: auto;'>";
                $acteurs = $serieDB->getActeurs($serieDB->getIdBySerie($_GET['serie']));

                foreach($acteurs as $acteur){
                    echo $acteur->getHTMLActor();
                }
            echo "</div>";

            echo "<div style='display:flex; overflow-x: auto;'>";
                $realisateurs = $serieDB->getReal($serieDB->getIdBySerie($_GET['serie']));

                foreach($realisateurs as $realisateur){
                    echo $realisateur->getHTMLReal();
                }
            echo "</div>";
            
            echo "<div style='display:flex; overflow-x: auto;'>";

                $saisons = $serieDB->getSaisons($serieDB->getIdBySerie($_GET['serie']));

                foreach($saisons as $saison){
                    echo $saison->getHTMLSaison();
                }
            echo "</div>";
        }else{
            //si l'utilisateur n'a pas encore fait de requête, alors on affiche le formulaire avec generateForm();
            $search->generateForm(); 
        }
        ?>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
