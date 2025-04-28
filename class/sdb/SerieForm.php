<?php

namespace gdb;

use sdb\SerieDB;

class SerieForm{
    
    private $gdb;

    public function generateForm(): void{
        ?>
        <form id="game-form" method="POST" enctype="multipart/form-data">
            <div>
                <label for="name" class="form-label">Name</label>
                <br>
                <input type="text" class="form-control" id="name" name="name">
            </div>
            <hr>
            <div>
                <label for="description" class="form-label">Description</label>
                <br>
                <textarea class="form-control" id="description" name="description"></textarea>
            </div>
            <hr>
            <div>
                <label for="image" class="form-label" style="width: 100%">Image</label>
                <input type="file" class="form-control" id="image" name="image" accept="image/png, image/gif, image/jpeg">
            </div>
            <hr>
            <div style="display: flex">
                <button type="submit">Submit</button>
                <button type="reset">Reset</button>
            </div>
        </form>
        
        <script>
            let button = document.getElementsByTagName('button')[1];
            button.addEventListener('click', function(){
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
                document.getElementById('image').value = '';
            })
        </script>
    <?php
    }

    public function createGame($name, $description=null, $imgFile=null){
        if($this->gdb == null) $this->gdb = new GameDB();
        $this->gdb->createGame($name, $description, $imgFile);
    }
}

?>