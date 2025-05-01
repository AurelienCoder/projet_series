<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
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

            $serie = $_GET['serie'];

            $serieID = $serieDB->getIdBySerie($serie);
            echo "<h1>La série " . $serie . " - Durée : " . round($serieDB->getTimeSerie($serieID)/60,1) . " heures</h1>";

            echo " <h1>Les saisons de " . $serie . " - " . $serieDB->getNbSaison($serieID) . " saisons</h1><div id='home-title'></div>";
            echo "<div style='display:flex; overflow-x: auto;'>";
            $saisons = $serieDB->getSaisons($serieID);

            foreach($saisons as $saison){
                echo $saison->getHTMLSaison();
            }
            echo "</div>";

            echo " <h1>Les acteurs de " . $serie . "</h1><div id='home-title'></div> ";
            echo "<div style='display:flex; overflow-x: auto;'>";
            $acteurs = $serieDB->getActeurs($serieID);

            foreach($acteurs as $acteur){
                echo $acteur->getHTMLActor();
            }
            echo "</div>";

            echo " <h1>Les réalisateurs de " . $serie . "</h1><div id='home-title'></div> ";
            echo "<div style='display:flex; overflow-x: auto;'>";
            $realisateurs = $serieDB->getReal($serieID);

            foreach($realisateurs as $realisateur){
                echo $realisateur->getHTMLReal();
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
