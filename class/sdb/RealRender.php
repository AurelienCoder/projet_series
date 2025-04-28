<?php

namespace sdb;

use sdb\SerieDB;

class RealRender{
    
    /* PROBLEME : j'ai du rajouter ces attributs sinon les erreurs suivantes se déclarent :
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

                        <?php if(isset($_SESSION['nickname'])): ?>
                            <button>EDIT</button>
                        <?php endif; ?>

                        <h2><?= htmlspecialchars($this->nom_real); ?></h2>
                        
                    </div>
            </div>
    <?php }

}

?>