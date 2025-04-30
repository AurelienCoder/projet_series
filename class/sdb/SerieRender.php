<?php

namespace sdb;

use sdb\SerieDB;

/**
 * Cette classe utilise la fonction getAllSeries() de serieDB : elle recupère le sql (les ids, titres, affiches... des séries) 
 * et elle transforme le tout en HTML
 */
class SerieRender{
    
    /* PROBLEME : on a du rajouter ces attributs sinon les erreurs suivantes se déclarent :
    Deprecated: Creation of dynamic property sdb\SerieRender::$id_serie is deprecated in C:
    Deprecated: Creation of dynamic property sdb\SerieRender::$titre_serie is deprecated in C: 
    ... */
    private $id_serie;
    private $titre_serie;
    private $affiche_serie;
    private $synopsis_serie;

    private $id_tag;
    private $nom_tag;

    public function getHTML(){
        ?>

        <div class="series-list">
                    <div class="model_serie">
                        <div style="overflow: hidden">
                            <img class="img-serie" src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
                        </div>

                        <?php if(isset($_SESSION['nickname'])): ?>

                            <a href="dashboard.php?idModif=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: blue; padding = 2px;">MODIFIER</button></a>

                            <a href="dashboard.php?idSupp=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                        <?php endif; ?>

                        <h2 class="titre-serie"><?= htmlspecialchars($this->titre_serie); ?></h2>
                        
                        <span class="tag"><?= $this->nom_tag ?></span>

                        <span class="synopsis" style="display:none"><?= $this->synopsis_serie ?></span>
                    </div>
            </div>
    <?php }

    public function getTitreSerie(){
        return $this->titre_serie;
    }

    //getter pour l'ID si besoin
    public function getIdSerie(){
        return $this->id_serie;
    }

    // getter pour l'affiche si besoin
    public function getAfficheSerie(){
        return $this->affiche_serie;
    }

    //getter pour le synopsis si besoin
    public function getSynopsisSerie(){
        return $this->synopsis_serie;
    }
}

?>