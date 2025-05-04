<?php

namespace series;

use sdb\SerieDB;

/**
 * Cette classe permet d'ajouter, modifier, supprimer des élements dans la base de données directement via le site
 */
class Dashboard{

    private $serieDB;

    public function __construct(){
        $this->serieDB = new SerieDB();
    }

    //A TERMINER
    public function ajouterTag($tag){
        $this->serieDB->addTag($this->serieDB->countTags()+1, $tag);
        header('Location: home.php');
        exit;
    }
    /**
     * méthode pour ajouter une série
     */
    public function ajouterSerie(){?>

        <!-- FORMULAIRE POUR AJOUTER UNE SERIE -->
        <section class="form-ajouter">
            <h1>Ajouter la série n°<span><?= $this->serieDB->countSeries()+1 ?></span></h1>
            <form method="POST">
                <label>Titre :</label>
                <input id="titre-serie" value="titre" type="text" name="titre" required>

                <label>Affiche (URL) :</label>
                <input value="URL" id="img-serie" type="text" name="affiche" required>
                
                <label>Synopsis :</label>
                <textarea id="synopsis-serie" name="synopsis" required></textarea>

                <!-- [0] BOUTON POUR AJOUTER UNE SERIE DANS LA BD + OUVRIR LA DIV POUR AJOUTER LES TAGS -->
                <button type="submit" class="valider btn-valider">Valider la série et ajouter ses tags</button>
            </form>
        </section>

        <!-- FORMULAIRE QUI PERMET D'AJOUTER DES SAISONS/ACTEURS/EPISODES/REALISATEURS -->
        <div id="ajout-infos">
            <div id="sous-div" style="margin-top: 80px; height: 500px; overflow: scroll;">
                <label>Tag n°1 (un à la fois svp)</label>
                <input id="nom-tag" type="text" name="genre" required>
                <!-- [1] BOUTON POUR AJOUTER UN TAG DANS LA BD -->
                <button class="valider btn-valider">Ajouter le tag</button>
                <hr>
                <h3>Ajouter la saison n°1<span id="id-saison"><?= $this->serieDB->countSaisons()+1 ?></span></h3>
                <div>
                    <label>Titre de la saison :</label>
                    <input type="text" id="titre-saison">
                </div>
                <br>
                <div>
                    <label>Affiche de la saison (URL) :</label>
                    <input type="text" id="img-saison">
                </div>
                <!-- [2] BOUTON POUR AJOUTER LA SAISON DANS LA BD + COMMENCER A AJOUTER LES ACTEURS/EPISODES -->
                <button type="submit" class="valider btn-valider">Ajouter les acteurs/épisodes de cette saison</button>

                <div id="ajouter-act-real-ep" style="display:none">
                    <!-- DIV PERMETTANT D'AJOUTER UN ACTEUR A LA FOIS -->
                    <hr>
                    <div id="sous-div2">
                        <h3>Ajouter l'acteur n°1 (saison 1)<span id="id-act"><?= $this->serieDB->countActs()+1 ?></span>
                        </h3>
                        <div>
                            <label>Nom de l'acteur : </label>
                            <input value="act" type="text" id="nom-act" required>
                        </div>
                        <br>
                        <div>
                            <label>Image de l'acteur (URL) : </label>
                            <input value="img" type="text" id="img-act" required>
                        </div>

                        <!-- [3] BOUTON POUR VALIDER ET AJOUTER UN ACTEUR DANS LA BD -->
                        <button class="valider btn-valider" style="margin-top: 10px;">Acteur suivant</button>
                    </div>

                    <!-- DIV PERMETTANT D'AJOUTER UN EPISODE A LA FOIS -->
                    <hr>
                    <div id="sous-div3">
                        <h3>Ajouter l'épisode n°1 (saison 1) #<span id="id-ep"><?= $this->serieDB->countEpisodes()+1 ?></span></h3>
                        <div>
                            <label>Titre de l'épisode : </label>
                            <input type="text" id="titre-ep" required>
                        </div>
                        <br>
                        <div>
                            <label>Synopsis de l'épisode : </label>
                            <input type="text" id="synopsis-ep" required>
                        </div>
                        <br>
                        <div>
                            <label>Durée de l'épisode (secondes) :</label>
                            <input type="number" id="duree-ep" required>
                        </div>
                        <br>
                        <!-- [4] BOUTON POUR AJOUTER L'EPISODE DANS LA BD ET COMMENCER A AJOUTER LES REALISATEURS -->
                        <button class="valider btn-valider" style="margin-top: 10px;">Valider l'épisode et ajouter les réalisateurs</button>

                        <div id="ajouter-real" style="display: none">
                            <div>
                                <div>
                                    <label id="label-real">Nom du réalisateur : #<span id="id-real"><?= $this->serieDB->countReals()+1 ?></span></label>
                                    <input type="text" id="nom-real" required>
                                </div>
                            <br>
                            <div>
                                <label>Image du réalisateur (URL) : </label>
                                <input type="text" id="img-real" required>
                            </div>
                        </div>

                        <!-- [5] BOUTON POUR AJOUTER SON REALISATEUR DANS LA BD -->
                        <button class="valider btn-valider" style="margin-top: 10px;">Épisode suivant</button>
                    </div>

                    <hr>
                    <!-- [6] BOUTON POUR PASSER A LA SAISON SUIVANTE -->
                    <button class="valider btn-valider" style="margin-top: 10px;">Saison suivante</button>

                    <button id="terminer" class="btn-valider">Terminer</button>
                </div>
            </div>
        </div>

        <!-- script qui permet de transmettre les infos des acteurs/reals/saisons que l'on souhaite ajouter en utilisant fetch -->
        <script src="../js/dashboard.js"></script>

        <?php //je récupère les données saisies envoyés en POST avec AJAX (fetch)

        //LA SERIE
        if(isset($_POST['id_serie']) && isset($_POST['titre_serie']) && isset($_POST['affiche_serie']) && isset($_POST['synopsis_serie'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $this->serieDB->addSerie($_POST['id_serie'], $_POST['titre_serie'], $_POST['affiche_serie'], $_POST['synopsis_serie']);
            exit;
        }

        //LES TAGS DE LA SERIE
        if(isset($_POST['nom_tag']) && isset($_POST['id_serie'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');
            var_dump($_POST['nom_tag']);
            $idTag = $this->serieDB->getIdByTag($_POST['nom_tag']);
            $this->serieDB->addSerieTagJointure($_POST['id_serie'], $idTag);
            exit;
        }

        //LES SAISONS DE LA SERIE
        if(isset($_POST['id_saison']) && isset($_POST['titre_saison']) && isset($_POST['num_saison']) && isset($_POST['affiche_saison']) && isset($_POST['id_serie'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $this->serieDB->addSaison($_POST['id_saison'], $_POST['titre_saison'], $_POST['num_saison'], $_POST['affiche_saison'], $_POST['id_serie']);
            exit;
        }

        //LES ACTEURS D'UNE SAISON
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
        }
        
        //LES REALISATEURS D'UNE SAISON
        if(isset($_POST['nom_real']) && isset($_POST['image_real'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $id_ep = $_POST['id_ep'];
            $id_real = $_POST['id_real'];
            $nom = $_POST['nom_real'];
            $image = $_POST['image_real'];

            $this->serieDB->addReal($id_real, $nom, $image);
            $this->serieDB->addEpisodeRealisateurJointure($id_ep, $id_real);
            exit;
        }

        //LES EPISODES D'UNE SAISON
        if(isset($_POST['id_ep'])){
            //obligatoire sinon ça ne fonctionne pas
            header('Content-Type: application/json');

            $id_saison = $_POST['id_saison'];
            $id_ep = $_POST['id_ep'];
            $titre = $_POST['titre_ep'];
            $synopsis = $_POST['synopsis_ep'];
            $duree = $_POST['duree_ep'];

            $this->serieDB->addEp($id_ep, $titre, $synopsis, $duree);
            $this->serieDB->addSaisonEpisodeJointure($id_saison, $id_ep);
            exit;
        }
    }

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