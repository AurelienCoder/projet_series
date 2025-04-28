<header class="main-header">
  <div style="display:flex;">
    <div id="logo">
      <a href="home.php"><h1>AlloSpoil</h1></a>
    </div>
</div>

  <div>
    <form style="color: black" action="search_result.php" method="get">
      <select name="search" class="search-input">
        <option value="">Rechercher...</option>
        <option value="series">Les séries</option>
        <option value="acteurs">Les acteurs</option>
        <option value="realisateurs">Les réalisateurs</option>
      </select>

      <button type="submit" class="search-button">
        <i class="fas fa-search"></i>
      </button>
    </form>

      <a href="search_form.php" id="options-header">▶ Plus d'options de recherche</a>
</div>
  <?php             
      //toujours mettre session_start() lorsque nous voulons accéder à $_SESSION
      //je mets une condition pour éviter de lancer 2 fois une session
      if(session_status() === PHP_SESSION_NONE) session_start();
      if(isset($_SESSION['nickname'])):
  ?>
      <a href="logout.php" id="button-header">Logout (<?php echo htmlspecialchars($_SESSION['nickname']) ?>)</a>
  <?php else: ?>
      <a href="login.php" id="button-header">Login</a>
  <?php endif;?>
</header>