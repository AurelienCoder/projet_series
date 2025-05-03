<?php

namespace sdb;

use sdb\SerieDB;

/**
 * Cette classe utilise les fonctions présentes dans serieDB : elle recupère les requêtes et elle transforme le tout en HTML
 */
class Render{
    
    /* PROBLEME : on a du rajouter ces attributs sinon les erreurs suivantes se déclarent :
    Deprecated: Creation of dynamic property sdb\Render::$id_serie is deprecated in C:
    Deprecated: Creation of dynamic property sdb\Render::$titre_serie is deprecated in C: 
    ... */
    private $id_serie;
    private $titre_serie;
    private $affiche_serie;
    private $synopsis_serie;

    private $id_tag;
    private $nom_tag;

    private $id_acteur;
    private $nom_acteur;
    private $photo_acteur;

    private $id_real;
    private $nom_real;
    private $photo_real;

    private $id_saison;
    private $titre_saison;
    private $numero_saison;
    private $affiche_saison;

    private $id_episode;
    private $titre_episode;
    private $synopsis_episode;
    private $duree_episode;

    private $serieDB;

    public function __construct(){
        $this->serieDB = new SerieDB();
    }

    public function getHTMLSerie(){
        ?>

        <div class="series-list">
            <div class="model_serie">
                <div style="overflow: hidden">
                    <img class="img-serie" src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
                </div>

                <?php if(isset($_SESSION['nickname'])): ?>

                    <a href="dashboard.php?value=serie&modif=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: blue; padding = 2px;">MODIFIER</button></a>

                    <a href="dashboard.php?value=serie&supp=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                <?php endif; ?>

                <h2 class="titre-serie"><?= htmlspecialchars($this->titre_serie); ?></h2>
                
                <span class="tag"><?= $this->nom_tag ?></span>

                <div  style="display: none">
                    <span class="synopsis"><?= $this->synopsis_serie ?></span>
                    <span class="reals">Les réalisateurs : <?php         
                        $realisateurs = $this->serieDB->getReal($this->id_serie);
                        foreach($realisateurs as $realisateur){
                            echo $realisateur->nom_real . ", ";
                        } 
                    ?></span>
                    <span class="nb-saisons"> Nombre de saisons : <?=  $this->serieDB->getNbSaison($this->id_serie) ?></span>
                    <span class="duree">Durée : <?= round($this->serieDB->getTimeSerie($this->id_serie)/60,1) ?> heures</span>

                </div>
            </div>
        </div>
        <script src="../js/details.js"></script>
    <?php }

    public function getHTMLActor(){
        ?>

        <div class="series-list">
            <div class="model_serie">
                <div style="overflow: hidden">
                    <img src="<?= htmlspecialchars($this->photo_acteur); ?>" alt="<?php echo htmlspecialchars($this->photo_acteur); ?>">
                </div>

                <?php if(isset($_SESSION['nickname'])): ?>
                    <a href="dashboard.php?value=act&supp=<?= $this->id_acteur; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                <?php endif; ?>

                <h2><?= htmlspecialchars($this->nom_acteur); ?></h2>
                
            </div>
        </div>
        <script src="../js/details.js"></script>
    <?php }

    public function getHTMLReal(){
        ?>

        <div class="series-list">
            <div class="model_serie">
                <div style="overflow: hidden">
                    <img src="<?= htmlspecialchars($this->photo_real); ?>" alt="<?php echo htmlspecialchars($this->photo_real); ?>">
                </div>

                <!-- si nous sommes connectés en tant qu'admin, nous pouvons modifier chaque élement -->
                <?php if(isset($_SESSION['nickname'])): ?>
                    <a href="dashboard.php?value=real&supp=<?= $this->id_real; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                <?php endif; ?>

                <h2><?= htmlspecialchars($this->nom_real); ?></h2>
                
            </div>
        </div>
        <script src="../js/details.js"></script>
    <?php }

    public function getHTMLSaison(){
        ?>

    <div class="series-list">
        <div class="model_serie">
            <div style="overflow: hidden">
                <img src="<?= htmlspecialchars($this->affiche_saison); ?>" alt="<?php echo htmlspecialchars($this->affiche_saison); ?>">
            </div>

            <h2><?= htmlspecialchars($this->titre_saison); ?></h2>
            
            <h2>Nombre d'épisodes : <?= $this->serieDB->getNbEpisode($this->numero_saison) ?> épisodes</h2>

            <h2>Durée d'une saison : <?php
                echo round($this->serieDB->getTimeSaison($this->numero_saison)/60,1) ?> heures
            </h2>
        </div>
    </div>

    <?php }

    public function getHTMLEpisode(){
        ?>
    <div class="series-list">
        <div class="model_serie">
            <h2><?= htmlspecialchars($this->titre_episode); ?></h2>
            
            <span class="synopsis" style="display:none"><?= $this->synopsis_serie ?></span>

            <h2><?= htmlspecialchars($this->duree_episode); ?></h2>
        </div>
    </div>
    <?php }

    //utilisée dans dashboard.php pour modifier la série
    public function getTitreSerie(){
        return $this->titre_serie;
    }

    //utilisée dans dashboard.php pour modifier la série
    public function getAfficheSerie(){
        return $this->affiche_serie;
    }

    //utilisée dans dashboard.php pour modifier la série
    public function getSynopsisSerie(){
        return $this->synopsis_serie;
    }
}
?>