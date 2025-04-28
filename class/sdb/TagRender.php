<?php

namespace sdb;

use sdb\SerieDB;

class TagRender{
    
    private $id_tag;
    private $nom_tag;

    public function getTag(){
        ?>
       <script>
        document.getElementsByClassName("tag")[<?= $this->id_tag-1?>].innerHTML = "<?= $this->nom_tag; ?>";
        </script>
    <?php }

}

?>