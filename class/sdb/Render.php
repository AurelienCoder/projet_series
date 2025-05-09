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
            <div class="model serie">
                <div style="overflow: hidden">
                    <img class="img-serie" src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?= htmlspecialchars($this->affiche_serie); ?>">
                </div>

                <?php if(isset($_SESSION['nickname'])): ?>

                    <a href="dashboard.php?value=serie&modif=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: blue; padding = 2px;">MODIFIER</button></a>

                    <a href="dashboard.php?value=serie&supp=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                <?php endif; ?>

                <h2 class="titre-serie"><?= htmlspecialchars($this->titre_serie); ?></h2>
                
                <span class="tag"><?= $this->nom_tag ?></span>

                <div  style="display: none">
                    <span class="id"><?= $this->id_serie ?></span>
                    <span class="synopsis"><?= $this->synopsis_serie ?></span>

                    <span class="reals">Les réalisateurs : <?php         
                        $realisateurs = $this->serieDB->getReal($this->id_serie);

                        //une petite fonction pour éviter d'avoir un virgule à la fin
                        $tab = [];
                        $i = 0;
                        foreach($realisateurs as $realisateur){
                            $tab[$i] = $realisateur->nom_real;
                            $i++;
                        }

                        for($i=0; $i<count($tab); $i++){
                            echo $tab[$i];
                            if(isset($tab[$i+1])){
                                echo ", ";
                            }
                        }
                    ?></span>
                    <span class="nb-saisons"> Nombre de saisons : <?=  $this->serieDB->getNbSaison($this->id_serie) ?></span>
                    <span class="duree"><?= round(($this->serieDB->getTimeSerie($this->id_serie)-$this->serieDB->getTimeSerie($this->id_serie)%60)/60)?> heures <?= $this->serieDB->getTimeSerie($this->id_serie)%60?> minutes</span>
                </div>
            </div>
        </div>
    <?php }

    public function getHTMLActor(){
        ?>

        <div class="series-list">
            <div class="model acteur">
                <div style="overflow: hidden">
                    <img src="<?= htmlspecialchars($this->photo_acteur); ?>" alt="<?php echo htmlspecialchars($this->photo_acteur); ?>">
                </div>

                <?php if(isset($_SESSION['nickname'])): ?>
                    <a href="dashboard.php?value=act&supp=<?= $this->id_acteur; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                    <a href="dashboard.php?value=act&modif=<?= $this->id_acteur; ?>" ><button class="category-btn" type="button" style="background-color: blue;">MODIFIER</button></a>
                <?php endif; ?>

                <h2><?= htmlspecialchars($this->nom_acteur); ?></h2>
                
            </div>
        </div>
    <?php }

    public function getHTMLReal(){
        ?>

        <div class="series-list">
            <div class="model real">
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
    <?php }

    public function getHTMLSaison(){
        ?>

    <div class="series-list">
        <div class="model saison">
            <div style="overflow: hidden">
                <img src="<?= htmlspecialchars($this->affiche_saison); ?>" alt="<?php echo htmlspecialchars($this->affiche_saison); ?>">
            </div>

            <h2><?= htmlspecialchars($this->titre_saison); ?></h2>
            <span style="display: none" class="id-saison"><?= $this->id_saison ?></span>

            <p>Nombre d'épisodes : <?= $this->serieDB->getNbEpisode($this->id_saison) ?> épisodes</p>

            <p>Durée d'une saison : <?=
            round(($this->serieDB->getTimeSaison($this->id_saison)-$this->serieDB->getTimeSaison($this->id_saison)%60)/60)?> heure(s) <?= $this->serieDB->getTimeSaison($this->id_saison)%60?> minutes</span>
            </>
        </div>
    </div>

    <?php }

    public function getHTMLEpisode(){
        ?>
    <div style="color: white; text-align: center;">
        <hr>
            <h2>Titre : <?= htmlspecialchars($this->titre_episode) ?></h2>
            
            <br>
            <span class="synopsis"><?= htmlspecialchars($this->synopsis_episode) ?></span>
            <br>

            <h3 style="font-style: italic">Durée de l'épisode : <?= htmlspecialchars($this->duree_episode) ?> minutes</h3>
        </div>
    </div>
    <?php }

    //utilisée dans dashboard.php pour modifier la série
    public function getTitreSerie(){
        return $this->titre_serie;
    }

    //utilisée dans search.php
    public function getIDSerie(){
        return $this->id_serie;
    }

    //utilisée dans dashboard.php pour modifier la série
    public function getAfficheSerie(){
        return $this->affiche_serie;
    }

    //utilisée dans dashboard.php pour modifier la série
    public function getSynopsisSerie(){
        return $this->synopsis_serie;
    }

    //utilisée dans dashboard.php pour modifier la série
    public function getTag(){
        return $this->nom_tag;
    }

    //utilisée dans search.php
    public function getNomReal(){
        return $this->nom_real;
    }

    //utilisée dans search.php
    public function getIDReal(){
        return $this->id_real;
    }

    //utilisée dans search.php
    public function getNomAct(){
        return $this->nom_acteur;
    }

    public function getPhotoAct(){
        return $this->photo_acteur;
    }

    //utilisée dans search.php
    public function getIDAct(){
        return $this->id_acteur;
    }
}
?>