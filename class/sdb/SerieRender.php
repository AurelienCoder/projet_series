<?php

namespace sdb;

use sdb\SerieDB;

class SerieRenderer{
    
    private $name;
    private $description;
    private $image;
    private $id;

    public function getHTML(){
        ?>
        <div style="text-align: center" class="game">            
            <h2><?= $this->name ?></h2>
            <img style="width:150px; height:auto" src="./../uploads/<?= $this->image ?>"/>
            <h3><?= $this->description ?></h3>
        </div>
        <hr>
    <?php }

}

?>