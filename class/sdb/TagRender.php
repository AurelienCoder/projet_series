<?php

namespace sdb;

use sdb\SerieDB;

class TagRender{
    
    private $id_tag;
    private $nom_tag;

    public function getHTML(){
        ?>
       <script>
        document.getElementsByClassName("tag")[<?= $this->id_tag ?>].innerHTML = "<?= $nom_tag; ?>";
        </script>
    <?php }

}

?>