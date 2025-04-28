
<form action="recherche.php" method="GET" class="search-form">

  <div class="form-group">
    <label for="tag">Tag :</label>
    <input type="text" id="tag" name="tag" placeholder="Comédie...">
  </div>

  <div class="form-group">
    <label for="serie">Nom de la série :</label>
    <input type="text" id="serie" name="serie" placeholder="Nom de la série">
  </div>

  <div class="form-group">
    <label for="season">Numéro de saison :</label>
    <input type="number" id="season" name="season" min="1" placeholder="">
  </div>

  <div class="form-group">
    <label for="episode">Numéro d'épisode :</label>
    <input type="number" id="episode" name="episode" min="1" placeholder="">
  </div>

  <div class="form-group">
    <label for="director">Réalisateur :</label>
    <input type="text" id="director" name="director" placeholder="Nom du réalisateur">
  </div>

  <div class="form-group">
    <label for="actor">Acteur :</label>
    <input type="text" id="actor" name="actor" placeholder="Nom de l'acteur">
  </div>

  <div class="form-group">
    <button type="submit" class="favorite styled">Rechercher</button>
  </div>

</form>
