<?php

namespace sdb;

use sdb\SerieDB;

/**
 * Cette classe utilise la fonction getAllActors() de serieDB : elle recupère le sql (les ids, noms et photos des acteurs) 
 * et elle transforme le tout en HTML
 */
class ActorRender{
    
    /* PROBLEME : on a du rajouter ces attributs sinon les erreurs suivantes se déclarent :
    Deprecated: Creation of dynamic property sdb\SerieRender::$id_acteur is deprecated in C:
    ... */
    private $id_acteur;
    private $nom_acteur;
    private $photo_acteur;

    public function getHTML(){
        ?>

        <div class="series-list">
                    <div class="model_serie" onclick="infoSerie()">
                        <div style="overflow: hidden">
                            <img src="<?= htmlspecialchars($this->photo_acteur); ?>" alt="<?php echo htmlspecialchars($this->photo_acteur); ?>">
                        </div>

                        <?php if(isset($_SESSION['nickname'])): ?>
                            <button>EDIT</button>
                        <?php endif; ?>

                        <h2><?= htmlspecialchars($this->nom_acteur); ?></h2>
                        
                    </div>
            </div>
    <?php }

}

?>