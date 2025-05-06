<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<div style="margin-top: 10px; margin-bottom: 30px; color:white; text-align:center">
    <?php 
        $search = new \series\Search();
        $serieDB = new \sdb\SerieDB();

        if(isset($_GET['search'])){ //$_GET['search'] est utilisé pour afficher soit TOUS les acteurs ou TOUS les réalisateurs ou TOUTES les séries
            echo "<div id='title'></div>

            <div style='display:flex; overflow-x: auto; text-align:center;'>";
                $search->generalSearch(); 
            echo "</div>";
        } else if(isset($_GET['serie']) && $_GET['serie'] != ''){//afficher les informations d'une série
            $search->serieSearch(htmlspecialchars($_GET['serie'])); 
        } else if(isset($_GET['real']) && $_GET['real'] != ''){//afficher les séries d'un réalisateur recherché
            /* - Michelle MacLaren a réalisée 2 séries : juste écrire Michelle
               - Plusieurs réalisateurs s'appellent David  */
            $search->realSearch(htmlspecialchars($_GET['real'])); 
        } else if(isset($_GET['act']) && $_GET['act'] != ''){//afficher les séries d'un acteur recherché
            /*Emilia Et Peter ont joués dans Game Of Thrones
            */
            $search->actSearch(htmlspecialchars($_GET['act']));
        }else if(isset($_GET['saison']) && $_GET['saison'] != ''){ //afficher les caractéristiques d'une saison c-à-d les épisodes
            $search->episodesSearch(htmlspecialchars($_GET['saison']));
        }else if(isset($_GET['tag']) && $_GET['tag'] != ''){
            $search->tagSearch(htmlspecialchars($_GET['tag']));
        }else{
            //si l'utilisateur n'a pas encore fait de requête, alors on affiche le formulaire avec generateForm();
            $search->generateForm();

        }
        ?>
</div>

<!-- script qui affiche les informations d'une série/d'un réalisateur/d'un acteur/saison lorsque l'on clique dessus  -->
<script src='../js/details.js'></script>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
