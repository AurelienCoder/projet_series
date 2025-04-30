<?php

namespace series;

use sdb\SerieDB;

/**
 * cette classe permet de créer des formulaires pour ajouter, modifier des élements dans la base de données directement via le site
 * et les supprimer aussi
 */
class Dashboard{

    private $serieDB;

    public function __construct(){
        $this->serieDB = new SerieDB();
    }  

    public function ajouterSerie(){
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $titre = $_POST['titre'] ?? '';
            $affiche = $_POST['affiche'] ?? '';
            $synopsis = $_POST['synopsis'] ?? '';
        

            $this->serieDB->addSerie($titre, $affiche, $synopsis); 
            header('Location: home.php');
            exit;
        } ?>
        <section class="form-ajouter">
            <h1>Ajouter une série</h1>
            <form method="POST">
                <label>Titre :</label>
                <input type="text" name="titre" required>

                <div style="display: flex">
                    <div>
                        <label>Nombre de Réalisateurs : </label>
                        <input id="nb-real" type="number" name="titre" min="1" max ="5"></input>
                    </div>

                    <div>
                        <label>Nombre d'acteurs : </label>
                        <input id="nb-act" type="number" name="titre" min="1" max ="5"></input>
                    </div>

                    <div>
                        <label>Nombre de saisons : </label>
                        <input id="nb-saison" type="number" name="titre" min="1" max ="5"></input>
                    </div>
                    <button type="submit"  class="category-btn" id="ajouter-real-act-saison">Ajouter</button>
                </div>

                <!-- A MODIFIER -->
                <div id="ajout-infos">
                    <div id="sous-div">
                        <h3>Ajouter</h3>
                        <label>Nom :</label>
                        <input type="text" id="nom-info" placeholder="">
                        <label>Image :</label>
                        <input type="text" id="img-info" placeholder="">

                        <!-- A MODIFIER : AJOUTER EPISODES -->
                        <button id="valider" style="margin-top: 10px;">Valider</button>
                    </div>
                </div>

                <script>
                    let totalActAjout;
                    let totalRealAjout;
                    let totalNbSaison;

                    document.getElementById('ajouter-real-act-saison').addEventListener('click', function(){
                        infos.style.display = "block";

                        totalActAjout = document.getElementById('nb-act').value;
                        totalRealAjout = document.getElementById('nb-real').value;
                        totalNbSaison = document.getElementById('nb-saison').value;
                    })

                    document.getElementById('valider').addEventListener('click', function(){
                        const infos = document.getElementById("ajout-infos");
                        const sousDiv = document.getElementById("sous-div");

                        if(k<nb_act){
                            sousDiv.childNodes[1].innerText = "Acteur n°" + k;
                        }else if(k<nb_real){

                        }else if(k<nb_saison){

                        }

                        for(let i=0; i<nb_real; i++){
                            sousDiv.childNodes[1].innerText = "Réalisateur : ";
                        }

                        for(let i=0; i<nb_saison; i++){
                            sousDiv.childNodes[1].innerText = "Saison :";
                        }
                    })
                    function validerActeur(){
                        /* AJOUTER ACTEUR A BASE DE DONNEES */
                        k++;
                    }

                    infos.style.display = "none";

                </script>

                <label>Affiche (URL de l'image) :</label>
                <input type="text" name="affiche" required>
                
                <label>Synopsis :</label>
                <textarea name="synopsis" required></textarea>

                <button type="submit" class="btn-valider">Ajouter</button>
            </form>
        </section>
    <?php }

    public function supprimerSerie($id){        
        $this->serieDB->deleteSerie($id);
        header('Location: home.php');
        exit;
    }

    public function modifierSerie($id){

        //$id = (int)$_GET['id'];

        $serie = $this->serieDB->getSerieById($id);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $titre = $_POST['titre'] ?? '';
            $affiche = $_POST['affiche'] ?? '';
            $synopsis = $_POST['synopsis'] ?? '';
        
            $this->serieDB->updateSerie($id, $titre, $affiche, $synopsis);
            header('Location: home.php');
            exit;
        }?>

        <section class="form-modifier">
            <h1>Modifier une série</h1>
            <form method="POST">
                <label>Titre :</label>
                <input type="text" name="titre" value="<?= htmlspecialchars($serie->getTitreSerie()); ?>" required>
        
                <label>Affiche (URL de l'image) :</label>
                <input type="text" name="affiche" value="<?= htmlspecialchars($serie->getAfficheSerie()); ?>" required>
        
                <label>Synopsis :</label>
                <textarea name="synopsis" required><?= htmlspecialchars($serie->getSynopsisSerie()); ?></textarea>
        
                <button type="submit" class="btn-valider">Enregistrer</button>
            </form>
        </section>
   <?php }
}
?>