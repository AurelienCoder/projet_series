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
                $dashboard->supprimerSerie(htmlspecialchars($_GET['supp']));
            }else if(isset($_GET['modif'])){
                $dashboard->modifierSerie(htmlspecialchars($_GET['modif']));
            }else{
                $dashboard->ajouterSerie();
            }
        }else if(isset($_GET['value']) && $_GET['value'] == 'act' ){
            if(isset($_GET['supp'])){
                $dashboard->supprimerAct(htmlspecialchars($_GET['supp']));
            }
        }else if(isset($_GET['value']) && $_GET['value'] == 'real' ){
            if(isset($_GET['supp'])){
                $dashboard->supprimerReal(htmlspecialchars($_GET['supp']));
            }
        }else if(isset($_GET['value']) && $_GET['value'] == 'tag' ){
            if(isset($_GET['tag'])){
                $dashboard->ajouterTag(htmlspecialchars($_GET['tag']));
            } else { ?>
                <script>
                    let tag = prompt("Saisir un tag :");
                    window.location.href = 'dashboard.php?value=tag&tag=' + tag;
                </script>
            <?php }
        }
    }else{
        echo "<h1>VOUS N'AVEZ PAS ACCES A CETTE PAGE</h1>";
    }
?>

<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>