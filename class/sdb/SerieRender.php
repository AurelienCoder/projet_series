<?php

namespace sdb;

use sdb\SerieDB;

class SerieRender{
    
    /* PROBLEME : j'ai du rajouter ces attributs sinon les erreurs suivantes se déclarent :
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
                    <div class="model_serie" onclick="infoSerie()">
                        <div style="overflow: hidden">
                            <img src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
                        </div>

                        <?php if(isset($_SESSION['nickname'])): ?>
                            <button>EDIT</button>
                        <?php endif; ?>
                        <h2><?= htmlspecialchars($this->titre_serie); ?></h2>
                        
                        <span class="tag"><?= $this->nom_tag ?></span>
                    </div>
            </div>

            <script>
                function infoSerie(){
                    alert("<?= $this->affiche_serie ?>");
                }
            </script>
    <?php }

    public function getTitreSerie(){
        return $this->titre_serie;
    }

}

?>