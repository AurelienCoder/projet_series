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

        <div class="series-list">
           <!-- A RAJOUTER : RENVOYER VERS UN LIEN LORS D'UN CLICK SUR UNE SERIE onclick="openSerie()" -->
                    <div class="model_serie">
                        <div style="overflow: hidden">
                            <img src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
                        </div>

                        <?php if(isset($_SESSION['nickname'])): ?>
                            <button>EDIT</button>
                        <?php endif; ?>
                        <h2><?= htmlspecialchars($this->titre_serie); ?></h2>
                        
                        <span class="tag"></span>


                    </div>
            </div>
    <?php }

    public function getTitreSerie(){
        return $this->titre_serie;
    }

}

?>