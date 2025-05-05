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
        <span style="color:red">Veuillez ne rechercher qu'un champ svp merci</span>
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
                <input type="text" id="real" name="real" placeholder="Nom du réalisateur">
            </div>

            <div class="form-group">
                <label for="acteur">Acteur(s) : (séparez chaque acteur par une virgule)</label>
                <input type="text" id="act" name="act" placeholder="Nom du/des acteur(s)">
            </div>
            <br>
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
            document.getElementById('title').after(input);
        </script>

        <?php $serieDB = new SerieDB();

        if($_GET['search'] == "realisateurs"){//affiche tous les réalisateurs
            echo "<script>document.getElementById('title').innerText = 'LES RÉALISATEURS'</script>";

            $realisateurs = $serieDB->getAllRealisators();
            
            foreach($realisateurs as $realisateur){
                echo $realisateur->getHTMLReal();
            }
        }else if($_GET['search'] == "acteurs"){//affiche tous les acteurs
            echo "<script>document.getElementById('title').innerText = 'LES ACTEURS'; </script>";

            $acteurs = $serieDB->getAllActors();
            
            foreach($acteurs as $acteur){
                echo $acteur->getHTMLActor();
            }
        }else if($_GET['search'] == "series"){//affiche toutes les séries
            echo "<script>document.getElementById('title').innerText = 'LES SERIES'; </script>";

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
    public function serieSearch($nom_serie){
        $serieDB = new SerieDB();
        //affiche les saisons d'une série
        $serie = $serieDB->getSerieByTitre($nom_serie);
        if($serie != null && $serie[0]->getIDSerie() != null){
            $serieID = $serie[0]->getIDSerie();
            $serieTitre = $serie[0]->getTitreSerie();

            echo "<h1 class='centrer' style='text-decoration: underline'>La série " . $serieTitre . "</h1><br>";

            echo "<hr><h1 class='centrer'>Durée : " . round(($serieDB->getTimeSerie($serieID)- $serieDB->getTimeSerie($serieID)%60) /60) . " heures " . $serieDB->getTimeSerie($serieID)%60 . " minutes </h1><br>";
            echo "<hr><h1 class='centrer'>Les saisons de " . $serie[0]->getTitreSerie(). " - " . $serieDB->getNbSaison($serieID) . " saisons</h1><div id='title'></div>";
            echo "<div class='center-div'>";
            $saisons = $serieDB->getSaisons($serieID);

            foreach($saisons as $saison){
                echo $saison->getHTMLSaison();
            }
            echo "</div><br><hr>";
    
            //affiche les réalisateurs d'une série
            echo " <h1 class='centrer'>Les réalisateurs de " . $serieTitre . "</h1><div id='title'></div> ";
            echo "<div class='center-div'>";
            $realisateurs = $serieDB->getReal($serieID);
    
            foreach($realisateurs as $realisateur){
                echo $realisateur->getHTMLReal();
            }
            echo "</div><br><hr>";
            
            //affiche les acteurs d'une série
            echo " <h1 class='centrer'>Les acteurs de " . $serieTitre . "</h1><div id='title'></div> ";
            echo "<div class='center-div'>";
            $acteurs = $serieDB->getActeurs($serieID);
    
            foreach($acteurs as $acteur){
                echo $acteur->getHTMLActor();
            }
            echo "</div>";
        } else {
            echo "<h1>Cette série n'existe pas !</h1>";
        }

    }

    public function tagSearch($nom_tag){
        $serieDB = new SerieDB();
        $tags = $serieDB->getTagNames();
        $ok = false;
        foreach($tags as $tag){
            if($nom_tag == $tag->getTag()){
                $ok = true;
                echo " <h1 class='centrer' style='text-decoration: underline'>Les séries " . $nom_tag  . "</h1><div id='title'></div> ";

                echo "<div class='center-div'>";
                $series = $serieDB->getSeriesByTagName($nom_tag);
    
                foreach($series as $serie){
                    echo $serie->getHTMLSerie();
                }
            echo "</div>";
            }
        }
        if($ok == false){
            echo "<h1 class='centrer'>Ce tag n'existe pas !</h1>";
        }
    }

    public function realSearch($nom_real){
        $serieDB = new SerieDB();

        $real = $serieDB->getRealByNom($nom_real);

        if($real != null && $real[0]->getIDReal() != null){
            echo " <h1 class='centrer' style='text-decoration: underline'>Les séries réalisées par " .  $real[0]->getNomReal()  . "</h1><div id='title'></div> ";

            echo "<div class='center-div''>";
            $series = $serieDB->getSeriesByReal($real[0]->getIDReal());
    
            foreach($series as $serie){
                echo $serie->getHTMLSerie();
            }
            echo "</div>";
        }
        else{
            echo "<h1 class='centrer'>Pas de série liée à ce réalisateur</h1>";
        }
    }

    public function actSearch($nom_act){
        $tab = explode(',', $nom_act);

        $serieDB = new SerieDB();

        if(count($tab) == 1){
            $act = $serieDB->getActByNom($nom_act);

            if($act != null && $act[0]->getIDAct() != null){
                echo " <h1 class='centrer' style='text-decoration: underline'>Les séries jouées par " . $act[0]->getNomAct()  . "</h1><div id='title'></div> ";
        
                echo "<div class='center-div'>";
                $series = $serieDB->getSeriesByAct($act[0]->getIDAct());
        
                foreach($series as $serie){
                    echo $serie->getHTMLSerie();
                }
                echo "</div>";
                }
                else{
                    echo "<h1 class='centrer'>Pas de série liée à cet acteur</h1>";
                }
        }else{
            $series = $serieDB->getMultipleAct($tab[0], $tab[1]);

            foreach($series as $serie){
                echo $serie->getHTMLSerie();
            }
        }
    }

    public function episodesSearch($idSaison){
        $serieDB = new SerieDB();

        if($idSaison>0 && $idSaison<$serieDB->countSaisons()){
            echo " <h1 class='centrer'>Les épisodes de la " . $serieDB->getSaisonById($idSaison)  . " de " . $serieDB->getTitreSerieBySaison($idSaison) . "</h1><div id='title'></div> ";

        echo "<div class='center-div'>";
        $episodes = $serieDB->getEpisodes($idSaison);

        foreach($episodes as $episode){
            echo $episode->getHTMLEpisode();
        }
        echo "</div>";
        }
        else{
            echo "<h1 class='centrer'>L'ID de la saison est inexistant</h1>";
        }
    }
}
?>