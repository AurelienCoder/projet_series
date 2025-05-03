<?php

namespace series;

use sdb\SerieDB;

/**
 * Cette classe permet de créer des formulaires pour ajouter, modifier des élements dans la base de données directement via le site
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

        //mais on doit aussi ajouter les noms et images des acteurs/réalisateurs ainsi que les saisons
        //je récupère donc leurs noms et leurs photos envoyés en POST avec AJAX (fetch)

        //LA SERIE
        if(isset($_POST['id_serie']) && isset($_POST['titre_serie']) && isset($_POST['affiche_serie']) && isset($_POST['synopsis_serie'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $this->serieDB->addSerie($_POST['id_serie'], $_POST['titre_serie'], $_POST['affiche_serie'], $_POST['synopsis_serie']);
            exit;
        }

        //LES SAISONS DE LA SERIE
        if(isset($_POST['id_saison']) && isset($_POST['titre_saison']) && isset($_POST['num_saison']) && isset($_POST['affiche_saison']) && isset($_POST['id_serie'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $this->serieDB->addSaison($_POST['id_saison'], $_POST['titre_saison'], $_POST['num_saison'], $_POST['affiche_saison'], $_POST['id_serie']);
            exit;
        }

        //LES ACTEURS
        if(isset($_POST['nom']) && isset($_POST['image'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $nom = $_POST['nom'];
            $image = $_POST['image'];

            $id_saison = $_POST['id_saison'];
            $id_act = $_POST['id_act'];
            
            $this->serieDB->addAct($id_act, $nom, $image);
            $this->serieDB->addSaisonActJointure($id_saison, $id_act);
            exit;
        }?>
                    
        <!-- FORMULAIRE PRINCIPAL -->
        <section class="form-ajouter">
            <h1>Ajouter la série n°<span><?= $this->serieDB->countSeries()+1?></span></h1>
            <form method="POST">
                <label>Titre :</label>
                <input id="titre-serie" value="titre" type="text" name="titre" required>

                <label>Genre (un à la fois)</label>
                <input type="text" name="genre" required>
                <button  class="valider">Genre suivant</button>

                <label>Affiche (URL) :</label>
                <input value="URL" id="img-serie" type="text" name="affiche" required>
                
                <label>Synopsis :</label>
                <textarea id="synopsis-serie" name="synopsis" required></textarea>

                <!-- BOUTON POUR AJOUTER UNE SERIE DANS LA BD + OUVRIR LA DIV POUR AJOUTER LES SAISONS -->
                <button type="submit" class="valider btn-valider">Valider la série et ajouter ses saisons</button>
            </form>
        </section>

        <!-- DIV QUI PERMET D'AJOUTER UNE SAISON A LA FOIS -->
        <div id="ajout-infos">
            <div id="sous-div"  style="margin-top: 0px">
                <h3>Ajouter une saison</h3> <span id="id-saison" style="display: none"><?= $this->serieDB->countSaisons()+1?></span>
                <div>
                    <label>Titre de la saison :</label>
                    <input value="TITRE11SAISON" type="text" id="titre-saison" placeholder="">
                </div>
                <br>
                <div>
                    <label>Affiche de la saison (URL) :</label>
                    <input value="AFFICHETITIREZI" type="text" id="img-saison" placeholder="">
                </div>

                <button type="submit" class="valider btn-valider">Valider la saison et ajouter ses acteurs/épisodes</button>

            <div id="ajouter-act-real-ep" style="display:none">
                <!-- DIV PERMETTANT D'AJOUTER UN ACTEUR A LA FOIS -->
                <hr>
                <div id="sous-div2">
                    <h3>Ajouter l'acteur n°1 (saison 1) [n°<span id="id-act"><?= $this->serieDB->countActs()+1?></span> dans la BD]
                    </h3>
                    <div>
                        <label>Nom de l'acteur : </label>
                        <input value="act" type="text" id="nom-act" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Image de l'acteur (URL) : </label>
                        <input value="img" type="text" id="img-act" placeholder="">
                    </div>

                    <!-- BOUTON POUR VALIDER ET AJOUTER UN ACTEUR DANS LA BD -->
                    <button class="valider" style="margin-top: 10px;">Acteur suivant</button>
                </div>

                <!-- DIV PERMETTANT D'AJOUTER UN EPISODE A LA FOIS -->
                <hr>
                <div id="sous-div2">
                    <h3>Ajouter l'épisode n°1 (saison 1)</h3>
                    <div>
                        <label>Titre de l'épisode : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Synopsis de l'épisode : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Durée de l'épisode : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <div>
                        <label>Nom du réalisateur : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Image du réalisateur (URL) : </label>
                        <input type="text" id="" placeholder="">
                    </div>

                    <!-- BOUTON POUR VALIDER ET AJOUTER UN ÉPISODE DANS LA BD -->
                    <button class="valider" style="margin-top: 10px;">Épisode suivant</button>
                </div>

                <!-- BOUTON POUR VALIDER ET AJOUTER UNE SAISON DANS LA BD -->
                <button class="valider" style="margin-top: 10px;">Saison suivante</button>

                <button id="terminer">Terminer</button>
    </div>
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
        /*
        j'ai besoin de récuperer les données d'une série selon son ID. J'utilise donc getSerieByid(). Grâce à cette fonction,
        j'obtiens une instance de la classe Render contenant les attributs : $titre_serie, $affiche_serie,, $synopsis_serie,
        que je récupère en utilisant les Getters : getTitreSerie(),getAfficheSerie(),getSynopsisSerie()...
        */
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
                <!--après avoir tout fusionner dans une classe Render, j'ai eu un problème et j'ai du ajouté [0] -->
                <input type="text" name="titre" value="<?= htmlspecialchars($serie[0]->getTitreSerie()); ?>" required>
        
                <label>Affiche (URL de l'image) :</label>
                <input type="text" name="affiche" value="<?= htmlspecialchars($serie[0]->getAfficheSerie()); ?>" required>
        
                <label>Synopsis :</label>
                <textarea name="synopsis" required><?= htmlspecialchars($serie[0]->getSynopsisSerie()); ?></textarea>
        
                <button type="submit" class="btn-valider">Enregistrer</button>
            </form>
        </section>
   <?php }

    /**
     * méthode qui supprime un acteur
     */
    public function supprimerAct($id){
        $this->serieDB->deleteAct($id);
        header('Location: search.php?search=acteurs');
        exit;
    }

    /**
     * méthode qui supprime un réalisateur
     */
    public function supprimerReal($id){
        $this->serieDB->deleteReal($id);
        header('Location: search.php?search=realisateurs');
        exit;
    }
}
?>