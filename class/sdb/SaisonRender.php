<?php

namespace sdb;

use sdb\serieDB;

class SaisonRender{
    private $id_saison;
    private $titre_saison;
    private $numero_saison;
    private $affiche_saison;
    private $id_serie;

    public function getHTML(){
        ?>

    <div class="series-list">
        <div class="model_serie" onclick="infoSerie()">
            <div style="overflow: hidden">
                <img src="<?= htmlspecialchars($this->affiche_saison); ?>" alt="<?php echo htmlspecialchars($this->affiche_saison); ?>">
            </div>

            <h2><?= htmlspecialchars($this->titre_saison); ?></h2>
            
            <h2><?= htmlspecialchars($this->numero_saison); ?></h2>
        </div>
    </div>

    <?php }

}
?>
