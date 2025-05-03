<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php
    $dashboard = new \series\Dashboard();

    if($logged){
        //si value = serie, alors ça veut dire que l'on souhaite ajouter/modifier ou supprimer une série
        if(isset($_GET['value']) && $_GET['value'] == 'serie' ){
            if(isset($_GET['supp'])){
                $dashboard->supprimerSerie($_GET['supp']);
            }else if(isset($_GET['modif'])){
                $dashboard->modifierSerie($_GET['modif']);
            }else{
                $dashboard->ajouterSerie();
            }
        }else if(isset($_GET['value']) && $_GET['value'] == 'act' ){
            if(isset($_GET['supp'])){
                $dashboard->supprimerAct($_GET['supp']);
            }
        }else if(isset($_GET['value']) && $_GET['value'] == 'real' ){
            if(isset($_GET['supp'])){
                $dashboard->supprimerReal($_GET['supp']);
            }
        }else if(isset($_GET['value']) && $_GET['value'] == 'tag' ){?>
            <script>prompt("Saisir un tag :")</script>
            
            <?php //$dashboard->ajouterTag();
        }
    }else{
        echo "<h1>VOUS N'AVEZ PAS ACCES A CETTE PAGE</h1>";
    }
?>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>