<?php
require_once "config.php" ;

session_start() ;
$logged = isset($_SESSION['nickname']) ;

require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<?php if($logged): ?>
<h1>Hi <?php echo $_SESSION['nickname'] ?>, </h1>
<?php endif; ?>

<div class="title">WELCOME </div>

<div class="main_content">
<div>
    <button>Dernières séries </button>  <button>Par défaut </button>    <button>Animation</button>    <button>Action</button>    <button>Comédie</button>   <button>Aventure</button>  <button>Horreur</button>  <button>Drame</button>
</div>
<div>
<button>Voir la suite </button>
</div>

<div class="model_serie">
    <span>durée</span>
<img src=""/>
<h1>Nom serie</h1>

</div>
</div>
<?php $code = ob_get_clean() ?>
<?php Template::render($code);
