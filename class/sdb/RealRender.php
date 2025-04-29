<?php

namespace sdb;

use sdb\SerieDB;

/**
 * Cette classe utilise la fonction getAllRealisators() de serieDB : elle recupère le sql (les ids, noms et photos des réalisateurs) 
 * et elle transforme le tout en HTML
 */
class RealRender{
    
    /* PROBLEME : on a du rajouter ces attributs sinon les erreurs suivantes se déclarent :
    Deprecated: Creation of dynamic property sdb\SerieRender::$id_real is deprecated in C:
    ... */
    private $id_real;
    private $nom_real;
    private $photo_real;

    public function getHTML(){
        ?>

        <div class="series-list">
                    <div class="model_serie" onclick="infoSerie()">
                        <div style="overflow: hidden">
                            <img src="<?= htmlspecialchars($this->photo_real); ?>" alt="<?php echo htmlspecialchars($this->photo_real); ?>">
                        </div>

                        <!-- si nous sommes connectés en tant qu'admin, nous pouvons modifier chaque élement -->
                        <?php if(isset($_SESSION['nickname'])): ?>
                            <button>MODIFIER</button>
                        <?php endif; ?>

                        <h2><?= htmlspecialchars($this->nom_real); ?></h2>
                        
                    </div>
            </div>
    <?php }

}

?>