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

    /**
     * méthode pour ajouter une série
     */
    public function ajouterSerie(){

        //dans une série on ajoute le titre, l'affiche et le synopsis 
        if(isset($_POST['titre']) && isset($_POST['affiche']) && isset($_POST['synopsis'])){

            $titre = $_POST['titre'];
            $affiche = $_POST['affiche'];
            $synopsis = $_POST['synopsis'];

            $this->serieDB->addSerie($titre, $affiche, $synopsis); 
            header('Location: home.php');
            exit;
        }

        //mais on doit aussi ajouter les noms et images des acteurs/réalisateurs :
        //je récupère donc leurs noms et leurs photos envoyés en POST avec AJAX (fetch)
        if(isset($_POST['nom']) && isset($_POST['image'])){

            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $nom = $_POST['nom'];
            $image = $_POST['image'];

            $this->serieDB->addReal($nom, $image);
            exit;
        }?>

        <!-- formulaire principal -->
        <section class="form-ajouter">
            <h1>Ajouter une série</h1>
            <form method="POST">
                <label>Titre :</label>
                <input type="text" name="titre" required>

                <label>Genre :</label>
                <input type="text" name="genre" required>

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

                <label>Affiche (URL de l'image) :</label>
                <input type="text" name="affiche" required>
                
                <label>Synopsis :</label>
                <textarea name="synopsis" required></textarea>

                <button type="submit" class="btn-valider">Ajouter</button>
            </form>
        </section>

        <!-- div qui permet d'ajouter des acteurs, des réalisateurs ou des saisons -->
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

        <!-- script qui permet de transmettre les infos des acteurs/reals/saisons que l'on souhaite ajouter en utilisant fetch -->
        <script src="../js/dashboard.js"></script>
    <?php }

    /**
     * méthode qui supprime une série
     */
    public function supprimerSerie($id){        
        $this->serieDB->deleteSerie($id);
        header('Location: home.php');
        exit;
    }

    /**
     * méthode qui modifie une série
     */
    public function modifierSerie($id){
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