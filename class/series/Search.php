<?php

namespace series;

use sdb\SerieDB;

class Search{

    public function generateForm(){?>
        <form action="search_result.php" method="GET" class="search-form">
            <div class="form-group">
                <label for="tag">Tag :</label>
                <input type="text" id="tag" name="tag" placeholder="Comédie...">
            </div>

            <div class="form-group">
                <label for="serie">Nom de la série :</label>
                <input type="text" id="serie" name="serie" placeholder="Nom de la série">
            </div>

            <div class="form-group">
                <label for="saison">Numéro de saison :</label>
                <input type="number" id="saison" name="saison" min="1" placeholder="">
            </div>

            <div class="form-group">
                <label for="episode">Numéro d'épisode :</label>
                <input type="number" id="episode" name="episode" min="1" placeholder="">
            </div>

            <div class="form-group">
                <label for="realisateur">Réalisateur :</label>
                <input type="text" id="realisateur" name="realisateur" placeholder="Nom du réalisateur">
            </div>

            <div class="form-group">
                <label for="acteur">Acteur :</label>
                <input type="text" id="acteur" name="acteur" placeholder="Nom de l'acteur">
            </div>

            <div class="form-group">
                <button type="submit" class="favorite styled">Rechercher</button>
            </div>
        </form>
    <?php }

    public function getSearch(){
        $serieDB = new SerieDB();

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

            echo "<script src='../js/doublons.js'></script>";
        }
    }
}
?>