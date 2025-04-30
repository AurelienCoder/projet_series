<?php

namespace sdb;

use sdb\serieDB;

class EpisodeRender{
    private $id_episode;
    private $titre_episode;
    private $synopsis_episode;
    private $duree_episode;

    public function getHTML(){
        ?>
    <div class="series-list">
        <div class="model_serie" onclick="infoSerie()">
            <h2><?= htmlspecialchars($this->titre_episode); ?></h2>
            
            <span class="synopsis" style="display:none"><?= $this->synopsis_serie ?></span>

            <h2><?= htmlspecialchars($this->duree_episode); ?></h2>
        </div>
    </div>
    <?php }
}
?>