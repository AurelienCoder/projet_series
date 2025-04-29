<?php

namespace sdb;

use sdb\SerieDB;

/**
 * Cette classe utilise la fonction getAllSeries() de serieDB : elle recupère le sql (les ids, titres, affiches... des séries) 
 * et elle transforme le tout en HTML
 */
class SerieRender{
    
    /* PROBLEME : on a du rajouter ces attributs sinon les erreurs suivantes se déclarent :
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
                    <div class="model_serie">
                        <div style="overflow: hidden">
                            <img src="<?= htmlspecialchars($this->affiche_serie); ?>" alt="<?php echo htmlspecialchars($this->affiche_serie); ?>">
                        </div>

                        <?php if(isset($_SESSION['nickname'])): ?>
                            <button class="category-btn" type="button" style="background-color: blue;">MODIFIER</button>
                            <button class="category-btn" type="button" style="background-color: red;">SUPPRIMER</button>
                        <?php endif; ?>

                        <h2><?= htmlspecialchars($this->titre_serie); ?></h2>
                        
                        <span class="tag"><?= $this->nom_tag ?></span>
                    </div>
            </div>

            <!-- PETIT PROBLEME -->
            <script>
                document.getElementsByClassName("model_serie")[<?= $this->id_serie-1 ?>].addEventListener('click', function(){
                    let div = document.createElement('div');
                    div.id = 'alert';
                    div.style.width = window.innerWidth + "px";
                    div.style.height = window.innerHeight + "px";
                    document.getElementsByTagName('body')[0].appendChild(div);

                    let divLogo = document.createElement('div');
                    divLogo.id = 'logo';
                    div.appendChild(divLogo);
                    
                    let a = document.createElement('a');
                    a.href = "home.php";
                    divLogo.appendChild(a);

                    let h1Logo = document.createElement('h1');
                    h1Logo.innerText = "- Retour";
                    a.appendChild(h1Logo);

                    let h1 = document.createElement('h1');
                    h1.innerText = "Titre : <?= htmlspecialchars($this->titre_serie); ?>";
                    div.appendChild(h1);
                    
                    let h3 = document.createElement('h3');
                    h3.innerText = "Synopsis : <?= htmlspecialchars($this->synopsis_serie); ?>";
                    div.appendChild(h3);
                                        
                    h3 = document.createElement('h3');
                    h3.innerText = "Genre : <?= htmlspecialchars($this->nom_tag); ?>";
                    div.appendChild(h3);
                })
            </script>
    <?php }

    public function getTitreSerie(){
        return $this->titre_serie;
    }

}

?>