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
    }

    public function modifierSerie($id){

        //$id = (int)$_GET['id'];

        $serie = $this->serieDB->getSerieById($id);
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $titre = $_POST['titre'] ?? '';
            $affiche = $_POST['affiche'] ?? '';
            $synopsis = $_POST['synopsis'] ?? '';
        
            $this->serieDB->updateSerie($id, $titre, $affiche, $synopsis);
            header('Location: dashboard.php');
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