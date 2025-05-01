<?php

namespace series;

use sdb\SerieDB;

/**
 * Cette classe a pour but de génerer un formulaire de recherche et ensuite
 * de retourner les résultats de la page search.php ET les résultats du <select> présent dans header.php
 */
class Search{

    /**
     * cette méthode génère un formulaire si aucune recherche n'est précisée que ce soit dans header.php ou search.php
     */
    public function generateForm(){?>
        <form name="search" action="search.php" method="GET" class="search-form">
            
            <div class="form-group">
                <label for="serie">Nom de la série :</label>
                <input type="text" id="serie" name="serie" placeholder="Nom de la série">
            </div>

            <div class="form-group">
                <label for="tag">Tag :</label>
                <input type="text" id="tag" name="tag" placeholder="Comédie...">
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

    /**le <select> dans header.php renvoie vers search.php et utilise $_GET['search'] :
     * $_GET['search'] récupère ce que l'utilisateur souhaite rechercher et en fonction de ce résultat,
     * nous appellons les requêtes nécessaires grâce à la classe SerieDB
     * 
     * NE PREND EN COMPTE UNIQUEMENT LES SERIES OU LES REALISATEURS OU LES ACTEURS
     */
    public function getSearch(){ ?>
        <script>
            let input = document.createElement('input');
            input.id = 'search-input';
            input.placeholder = 'rechercher...';
            document.getElementById('home-title').after(input);
        </script>

        <?php $serieDB = new SerieDB();

        if($_GET['search'] == "realisateurs"){
            echo "<script>document.getElementById('home-title').innerText = 'LES RÉALISATEURS'</script>";

            $realisateurs = $serieDB->getAllRealisators();
            
            foreach($realisateurs as $realisateur){
                echo $realisateur->getHTMLReal();
            }
        }else if($_GET['search'] == "acteurs"){
            echo "<script>document.getElementById('home-title').innerText = 'LES ACTEURS'; </script>";

            $acteurs = $serieDB->getAllActors();
            
            foreach($acteurs as $acteur){
                echo $acteur->getHTMLActor();
            }
        }else if($_GET['search'] == "series"){
            echo "<script>document.getElementById('home-title').innerText = 'LES SERIES'; </script>";

            $series = $serieDB->getAllSeries();
            
            foreach($series as $serie){
                echo $serie->getHTMLSerie();
            }

            echo "<script src='../js/doublons.js'></script>";
        }

        echo "<script src='../js/search.js'></script>";
    }
}
?>