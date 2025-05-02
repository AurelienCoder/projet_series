<?php

namespace series;

use sdb\SerieDB;

/**
 * Cette classe a pour but de génerer un formulaire de recherche et ensuite de retourner les résultats dans la page search.php
 * et aussi de retourner les résultats quand on clique dans header.php sur 'les séries', 'les acteurs', 'les réalisateurs', 'Plus d'options de recherche'
 */
class Search{

    /**
     * cette méthode génère un formulaire si aucune recherche n'est précisée dans search.php
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

    /**
     * cette méthode génère UNIQUEMENT TOUTES LES SERIES OU TOUS LES REALISATEURS OU TOUS LES ACTEURS :
     * si nous cliquons sur 'les séries', 'les acteurs', 'les réalisateurs' (dans header.php) alors, nous sommes renvoyés vers search.php 
     * qui utilise $_GET['search'] :
     * $_GET['search'] récupère ce que l'utilisateur souhaite rechercher (tous les acteurs, ou reals ou séries) et en fonction de ce résultat,
     * nous appellons les requêtes nécessaires grâce à la classe SerieDB
     */
    public function generalSearch(){ ?>
        <script>
            let input = document.createElement('input');
            input.id = 'search-input';
            input.placeholder = 'rechercher...';
            document.getElementById('home-title').after(input);
        </script>

        <?php $serieDB = new SerieDB();

        if($_GET['search'] == "realisateurs"){//affiche tous les réalisateurs
            echo "<script>document.getElementById('home-title').innerText = 'LES RÉALISATEURS'</script>";

            $realisateurs = $serieDB->getAllRealisators();
            
            foreach($realisateurs as $realisateur){
                echo $realisateur->getHTMLReal();
            }
        }else if($_GET['search'] == "acteurs"){//affiche tous les acteurs
            echo "<script>document.getElementById('home-title').innerText = 'LES ACTEURS'; </script>";

            $acteurs = $serieDB->getAllActors();
            
            foreach($acteurs as $acteur){
                echo $acteur->getHTMLActor();
            }
        }else if($_GET['search'] == "series"){//affiche toutes les séries
            echo "<script>document.getElementById('home-title').innerText = 'LES SERIES'; </script>";

            $series = $serieDB->getAllSeries();
            
            foreach($series as $serie){
                echo $serie->getHTMLSerie();
            }

            echo "<script src='../js/doublons.js'></script>";
        }

        echo "<script src='../js/search.js'></script>";
    }

    /**
     * cette méthode renvoie des informations sur une série particulière
     */
    public function serieSearch(){
        $serieDB = new SerieDB();
        //affiche les saisons d'une série
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

        //affiche les réalisateurs d'une série
        echo " <h1>Les réalisateurs de " . $serie . "</h1><div id='home-title'></div> ";
        echo "<div style='display:flex; overflow-x: auto;'>";
        $realisateurs = $serieDB->getReal($serieID);

        foreach($realisateurs as $realisateur){
            echo $realisateur->getHTMLReal();
        }
        echo "</div>";
        
        //affiche les acteurs d'une série
        echo " <h1>Les acteurs de " . $serie . "</h1><div id='home-title'></div> ";
        echo "<div style='display:flex; overflow-x: auto;'>";
        $acteurs = $serieDB->getActeurs($serieID);

        foreach($acteurs as $acteur){
            echo $acteur->getHTMLActor();
        }
        echo "</div>";
    }
}
?>