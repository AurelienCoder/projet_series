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
    <div id="home-title"></div>

    <div style="display:flex; overflow-x: auto;">
        <?php if(isset($_GET['search'])){
            
            $serieDB = new \sdb\SerieDB();

            if($_GET['search'] == "realisateurs"){
                echo "<script>document.getElementById('home-title').innerText = 'LES RÉALISATEURS'; </script>";

                $realisateurs = $serieDB->getAllRealisators();
                
                foreach($realisateurs as $realisateur){
                    echo $realisateur->getHTML();
                }
            }else if($_GET['search'] == "acteurs"){
                echo "<script>document.getElementById('home-title').innerText = 'LES ACTEURS'; </script>";

                $acteurs = $serieDB->getAllActors();
                
                foreach($acteurs as $acteur){
                    echo $acteur->getHTML();
                }
            }else if($_GET['search'] == "series"){
                echo "<script>document.getElementById('home-title').innerText = 'LES SERIES'; </script>";

                $series = $serieDB->getAllSeries();
                
                foreach($series as $serie){
                    echo $serie->getHTML();
                }
            }
        }
        ?>
   </div>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
