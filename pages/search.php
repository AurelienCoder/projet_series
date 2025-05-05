<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<div style="margin-top: 10px; margin-bottom: 30px;">
    <?php 
        $search = new \series\Search();
        $serieDB = new \sdb\SerieDB();

        if(isset($_GET['search'])){ //$_GET['search'] est utilisé pour afficher soit TOUS les acteurs ou TOUS les réalisateurs ou TOUTES les séries
            echo "<div id='title'></div>

            <div style='display:flex; overflow-x: auto;'>";
                $search->generalSearch(); 
            echo "</div>";
        }else if(isset($_GET['serie']) && $_GET['serie'] != ''){
            $search->serieSearch(); 
        }else if(isset($_GET['real']) && $_GET['real'] != ''){
            $search->realSearch(htmlspecialchars($_GET['real'])); 
        }else if(isset($_GET['act']) && $_GET['act'] != ''){
            $search->actSearch(htmlspecialchars($_GET['act']));
        }else if(isset($_GET['saison']) && $_GET['saison'] != ''){
            $search->saisonSearch(htmlspecialchars($_GET['saison']));
        }else{
            //si l'utilisateur n'a pas encore fait de requête, alors on affiche le formulaire avec generateForm();
            $search->generateForm(); 
        }
        ?>
</div>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
