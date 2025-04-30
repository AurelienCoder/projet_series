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
        if(isset($_POST['titre']) && isset($_POST['affiche']) && isset($_POST['synopsis'])){

            $titre = $_POST['titre'];
            $affiche = $_POST['affiche'];
            $synopsis = $_POST['synopsis'];

            $this->serieDB->addSerie($titre, $affiche, $synopsis); 
            header('Location: home.php');
            exit;
        }

        //je récupère le nom du réalisateur et sa photo envoyés en POST avec AJAX (fetch)
        if(isset($_POST['nom']) && isset($_POST['image'])){
            header('Content-Type: application/json');
            $nom = $_POST['nom'];
            $image = $_POST['image'];

            $this->serieDB->addReal($nom, $image);
            exit;
        }?>

        <section class="form-ajouter">
            <h1>Ajouter une série</h1>
            <form method="POST">
                <label>Titre :</label>
                <input type="text" name="titre" required>

                <div style="display: flex">
                    <div>
                        <label>Nombre de Réalisateurs : </label>
                        <input id="nb-real" type="number" min="1" max ="5"></input>
                    </div>

                    <div>
                        <label>Nombre d'acteurs : </label>
                        <input id="nb-act" type="number" min="1" max ="5"></input>
                    </div>

                    <div>
                        <label>Nombre de saisons : </label>
                        <input id="nb-saison" type="number" min="1" max ="5"></input>
                    </div>
                    <button type="submit"  class="category-btn" id="ajouter-real-act-saison">Ajouter</button>
                </div>

                <div id="ajout-infos">
                    <div id="sous-div">
                        <h3>Ajouter</h3>
                        <label>Nom :</label>
                        <input type="text" id="nom-ajout" placeholder="">
                        <label>Image :</label>
                        <input type="text" id="img-ajout" placeholder="">

                        <!-- A MODIFIER : AJOUTER EPISODES -->
                        <button id="valider" style="margin-top: 10px;">Valider</button>
                    </div>
                </div>

                <script src="../js/fetch.js"></script>
                
                <!-- A MODIFIER -->
                <script>
                    let totalRealAjout;

                    let infos = document.getElementById('ajout-infos');
                    let sousDiv = document.getElementById('sous-div');

                    document.getElementById('ajouter-real-act-saison').addEventListener('click', function(){
                        infos.style.display = 'block';
                        totalRealAjout = document.getElementById('nb-real').value;
                    })

                    let nbReal = 1;

                    sousDiv.childNodes[1].innerText = 'Réalisateur n°' + nbReal;

                    document.getElementById('valider').addEventListener('click', function(){
                        if(nbReal<totalRealAjout){

                            let nom = document.getElementById('nom-ajout').value;
                            let image = document.getElementById('img-ajout').value;

                            let url = "dashboard.php";
                            fetchBD(url, nom, image);
                            
                            document.getElementById('nom-ajout').value = '';
                            document.getElementById('img-ajout').value = '';

                            nbReal++;
                            sousDiv.childNodes[1].innerText = 'Réalisateur n°' + nbReal;

                        }else{
                            infos.style.display = 'none';
                        }
                    })
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
        
        if(isset($_POST['titre']) && isset($_POST['affiche']) && isset($_POST['synopsis'])){
            $titre = $_POST['titre'];
            $affiche = $_POST['affiche'];
            $synopsis = $_POST['synopsis'];
        
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