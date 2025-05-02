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

        //dans une série on ajoute le titre, l'affiche et le synopsis 
        if(isset($_POST['titre']) && isset($_POST['affiche']) && isset($_POST['synopsis'])){

            $titre = $_POST['titre'];
            $affiche = $_POST['affiche'];
            $synopsis = $_POST['synopsis'];

            $this->serieDB->addSerie($titre, $affiche, $synopsis); 
            header('Location: home.php');
            exit;
        }

        //mais on doit aussi ajouter les noms et images des acteurs/réalisateurs ainsi que les saisons
        //je récupère donc leurs noms et leurs photos envoyés en POST avec AJAX (fetch)

        //les saisons
        if(isset($_POST['titre']) && isset($_POST['numero']) && isset($_POST['affiche']) && isset($_POST['id_serie'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $this->serieDB->addSaison($_POST['titre'], $_POST['numero'], $_POST['affiche'], $_POST['id_serie']);
            exit;
        }

        //les acteurs/réalisateurs
        if(isset($_POST['nom']) && isset($_POST['image'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $nom = $_POST['nom'];
            $image = $_POST['image'];

            if($_POST['type'] == 'real'){
                $this->serieDB->addReal($nom, $image);
            }else if($_POST['type'] == 'act'){
                $this->serieDB->addAct($nom, $image);
            }
            exit;
        }?>
                    
        <!-- FORMULAIRE PRINCIPAL -->
        <section class="form-ajouter">
            <h1>Ajouter une série</h1>
            <form method="POST">
                <label>Titre :</label>
                <input value="titre" type="text" name="titre" required>

                <label>Genre :</label>
                <input type="text" name="genre" required>

                <div style="display: flex; justify-content: space-between;">
                    <div>
                        <label>Nombre de saisons : </label>
                    </div>
                    <input id="nb-saison" type="number" min="1" max ="5"></input>

                    <!-- BOUTON POUR OUVRIR LA DIV PERMETTANT D'AJOUTER UNE SAISON A LA FOIS -->
                    <button  class="category-btn" id="ajouter-real-act-saison">Ajouter les saisons</button>
                </div>

                <label>Affiche (URL de l'image) :</label>
                <input type="text" name="affiche" required>
                
                <label>Synopsis :</label>
                <textarea name="synopsis" required></textarea>

                <!-- BOUTON POUR AJOUTER UNE SERIE DANS LA BD -->
                <button type="submit" class="btn-valider">Valider</button>
            </form>
        </section>

        <!-- DIV QUI PERMET D'AJOUTER UNE SAISON A LA FOIS -->
        <div id="ajout-infos">
            <div id="sous-div"  style="margin-top: 0px">
                <h3>Ajouter une saison</h3>
                <div>
                    <label>Titre de la saison :</label>
                    <input type="text" id="nom-ajout" placeholder="">
                </div>
                <br>
                <div>
                    <label>Affiche de la saison :</label>
                    <input type="text" id="img-ajout" placeholder="">
                </div>
                <br>
                <div>
                    <label>Nombre d'acteurs : </label>
                    <input id="nb-act" type="number" min="1" max ="5"></input>

                    <!-- BOUTON POUR OUVRIR LA DIV PERMETTANT D'AJOUTER UN ACTEUR A LA FOIS -->
                    <button  class="category-btn" id="ajouter-real-act-saison">Ajouter les acteurs</button>
                </div>
                <br>
                <div>
                    <label>Nombre d'épisodes : </label>
                        <input id="nb-act" type="number" min="1" max ="5"></input>

                        <!-- BOUTON POUR OUVRIR LA DIV PERMETTANT D'AJOUTER UN EPISODE A LA FOIS -->
                        <button  class="category-btn" id="ajouter-real-act-saison">Ajouter les épisodes</button>
                </div>

                <!-- BOUTON POUR VALIDER ET AJOUTER UNE SAISON DANS LA BD -->
                <button id="valider" style="margin-top: 10px;">Valider la saison</button>

                <!-- DIV PERMETTANT D'AJOUTER UN ACTEUR A LA FOIS -->
                <hr>
                <div id="sous-div2">
                    <h3>Ajouter l'acteur n°1</h3>
                    <div>
                        <label>Nom de l'acteur : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Image de l'acteur : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <!-- BOUTON POUR VALIDER ET AJOUTER UN ACTEUR DANS LA BD -->
                    <button id="valider" style="margin-top: 10px;">Valider l'acteur</button>
                </div>

                <!-- DIV PERMETTANT D'AJOUTER UN EPISODE A LA FOIS -->
                <hr>
                <div id="sous-div2">
                    <h3>Ajouter l'épisode n°1</h3>
                    <div>
                        <label>Titre de l'épisode : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Réalisateur : </label>
                        <div>
                        <label>Nom du réalisateur : </label>
                        <input type="text" id="" placeholder="">
                    </div>
                    <br>
                    <div>
                        <label>Image du réalisateur : </label>
                        <input type="text" id="" placeholder="">
                    </div>

                            <!-- BOUTON POUR OUVRIR LA DIV PERMETTANT D'AJOUTER UN EPISODE A LA FOIS -->
                            <button  class="category-btn" id="ajouter-real-act-saison">Ajouter le réalisateur</button>
                    </div>
                    <!-- BOUTON POUR VALIDER ET AJOUTER UN ACTEUR DANS LA BD -->
                    <button id="valider" style="margin-top: 10px;">Valider l'acteur</button>
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