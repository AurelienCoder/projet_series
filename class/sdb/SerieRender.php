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

                            <a href="dashboard.php?idModif=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: blue;">MODIFIER</button></a>

                            <a href="dashboard.php?idSupp=<?= $this->id_serie; ?>" ><button class="category-btn" type="button" style="background-color: red;" onclick="return confirm('Es-tu sûr de vouloir supprimer cette série ?');">SUPPRIMER</button></a>
                        <?php endif; ?>

                        <h2><?= htmlspecialchars($this->titre_serie); ?></h2>
                        
                        <span class="tag"><?= $this->nom_tag ?></span>
                    </div>
            </div>

            <!-- PETIT PROBLEME -->
            <script>
                document.getElementsByClassName("model_serie")[<?= $this->id_serie-1 ?>].addEventListener('click', function(){
                let container = document.createElement('div');
                container.id = 'alert';
                container.style.width = window.innerWidth + "px";
                container.style.height = window.innerHeight + "px";
                document.getElementsByTagName('body')[0].appendChild(container);

                let section = document.createElement('section');
                section.style = "color: black";
                section.id = 'page-serie';
                container.appendChild(section);

                let h1 = document.createElement('h1');
                h1.innerText = "<?= $this->titre_serie ?>";
                section.appendChild(h1);

                let div = document.createElement('div');
                div.style = "overflow: hidden; max-width: 500px; margin-bottom: 20px;";
                section.appendChild(div);

                let img = document.createElement('img');
                img.src = "<?= $this->affiche_serie ?>";
                img.alt = "<?= $this->titre_serie ?>";
                img.style = "width: 150px; height: auto;";
                div.appendChild(img);

                div = document.createElement('div');
                div.style = "background: rgba(255,255,255,0.8); padding: 20px; border-radius: 10px;";
                section.appendChild(div);

                let p = document.createElement('p');
                p.style = "bold";
                /* A VOIR nl2br();*/
                p.innerText = "Synopsis : " + "<?= $this->synopsis_serie ?>";
                div.appendChild(p);

                div = document.createElement('div');
                div.style = "margin-top: 20px;";
                section.appendChild(div);

                let a = document.createElement("a");
                a.href = "home.php";
                a.style = "color: black";
                a.innerText = "Retour à la liste";
                div.appendChild(a);
                })
            </script>
    <?php }

    public function getTitreSerie(){
        return $this->titre_serie;
    }

    //getter pour l'ID si besoin
    public function getIdSerie(){
        return $this->id_serie;
    }

    // getter pour l'affiche si besoin
    public function getAfficheSerie(){
        return $this->affiche_serie;
    }

    //getter pour le synopsis si besoin
    public function getSynopsisSerie(){
        return $this->synopsis_serie;
    }
}

?>