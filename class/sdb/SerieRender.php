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
        <div class="model_serie">
            <img src="../images/Affiches/<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
            <h2><?= htmlspecialchars($this->titre_serie); ?></h2>
             <span class="tag">Genre : </span>
        </div>
        <hr>
    <?php }

}

?>