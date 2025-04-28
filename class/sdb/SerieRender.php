<?php

namespace sdb;

use sdb\SerieDB;

class SerieRender{
    
    private $id_serie;
    private $titre_serie;
    private $affiche_serie;
    private $synopsis_serie;

    public function getHTML(){
        ?>

            <div class="series-list" id="series-list">
                    <div class="model_serie" onclick="openSerie(<?php echo $this->id_serie; ?>)">
                        <img src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
                        <h2><?= htmlspecialchars($this->titre_serie); ?></h2>
                        <span class="tag">Genre : </span>
                    </div>
            </div>
    <?php }

    public function getIdSerie(){
        return $this->titre_serie;
    }

}

?>