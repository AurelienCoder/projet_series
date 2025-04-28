<?php
session_start();
$logged = isset($_SESSION['nickname']);
require_once "../class/Autoloader.php";
Autoloader::register();
?>

<?php ob_start() ?>

<form action="result_search.php" method="GET" class="search-form">

  <div class="form-group">
    <label for="tag">Tag :</label>
    <input type="text" id="tag" name="tag" placeholder="Comédie...">
  </div>

  <div class="form-group">
    <label for="serie">Nom de la série :</label>
    <input type="text" id="serie" name="serie" placeholder="Nom de la série">
  </div>

  <div class="form-group">
    <label for="saison">Numéro de saison :</label>
    <input type="number" id="saison" name="saison" min="1" placeholder="">
  </div>

  <div class="form-group">
    <label for="episode">Numéro d'épisode :</label>
    <input type="number" id="episode" name="episode" min="1" placeholder="">
  </div>

  <div class="form-group">
    <label for="realisateur">Réalisateur :</label>
    <input type="text" id="realisateur" name="realisateur" placeholder="Nom du réalisateur">
  </div>

  <div class="form-group">
    <label for="acteur">Acteur :</label>
    <input type="text" id="acteur" name="acteur" placeholder="Nom de l'acteur">
  </div>

  <div class="form-group">
    <button type="submit" class="favorite styled">Rechercher</button>
  </div>

</form>


<?php $code = ob_get_clean(); ?>
<?php Template::render($code); ?>
