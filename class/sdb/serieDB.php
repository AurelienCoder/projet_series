<?php

namespace sdb;

//IMPORTANT car l'autoloader essaye de charger la classe PDO
use \PDO;

/**
 * Cette classe récupère la base de données seriesdb et s'occupe de mettre en place les différentes requêtes
 */
class SerieDB{

    private PDO $pdo;

    public function __construct(){
        $db_name = "seriesdb";
        $db_host = "127.0.0.1";
        $db_port = "3306";
        
        $db_user = "root";
        $db_pwd = "";

        $dsn = 'mysql:dbname=' . $db_name . ';host=' . $db_host . ';port=' . $db_port;

        try{
            $this->pdo = new PDO($dsn, $db_user, $db_pwd);
        } catch(\Exception $ex){
            die("Erreur : " . $ex->getMessage());
        }
    }

    /* LES FONCTIONS CI-DESSOUS REGROUPENT LES REQUETES POUR RECHERCHER DES INFORMATIONS SUR LA BD : tous les getters*/

    //IMPORTANT Nous ne sommes pas obligés de spécifier le type de retour

    //utilisée
    /**
     * getAllSeries récupère toutes les séries +  leurs genres associés
     */
    public function getAllSeries(){
        $sql = "SELECT * FROM serie INNER JOIN serie_tag, tag 
        WHERE serie.id_serie = serie_tag.id_serie AND tag.id_tag = serie_tag.id_tag
        ORDER BY titre_serie";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        //IMPORTANT FETCH_ASSOC pour transformer en tableau
        //FETCH_CLASS pour transmettre les données vers une classe
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");

        return $results;
    }

    //utilisée
    public function getAllActors(){
        $sql = "SELECT * FROM acteur ORDER BY nom_acteur";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");

        return $results;
    }

    //utilisée
    public function getAllRealisators(){
        $sql = "SELECT * FROM realisateur ORDER BY nom_real";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");

        return $results;
    }

    //utilisée
    public function getSaisons($id_serie){
        // Afficher les saisons d'une série
        $sql = "SELECT * FROM saison
        INNER JOIN serie ON saison.id_serie = serie.id_serie
        WHERE serie.id_serie = :id_serie";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_serie', $id_serie);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    //utilisée
    public function getActeurs($serie_id){
        // Afficher tous les acteurs d'une série

        $sql = "SELECT DISTINCT nom_acteur, photo_acteur FROM acteur INNER JOIN saison_acteur ON acteur.id_acteur = saison_acteur.id_acteur
        INNER JOIN saison ON saison.id_saison = saison_acteur.id_saison
        INNER JOIN serie ON saison.id_serie = serie.id_serie
        WHERE serie.id_serie = :serie_id
        ORDER BY nom_acteur";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':serie_id', $serie_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    //utilisée
    public function getReal($serie_id){
        // Afficher tous les real d'une série
        $sql = "SELECT DISTINCT nom_real, photo_real FROM realisateur
        INNER JOIN episode_realisateur ON realisateur.id_real = episode_realisateur.id_real
        INNER JOIN episode ON episode_realisateur.id_episode = episode.id_episode
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        INNER JOIN serie ON saison.id_serie = serie.id_serie
        WHERE serie.id_serie = :serie_id
        ORDER BY nom_real";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':serie_id', $serie_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    //utilisée
    public function getRealByNom($nom_real){
        $sql = "SELECT * FROM realisateur WHERE nom_real LIKE CONCAT('%',:nom_real,'%')";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom_real', $nom_real);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    public function getSeriesByReal($real_id){
        // Afficher toutes les séries d'un real
        $sql = "SELECT DISTINCT titre_serie, affiche_serie, synopsis_serie FROM serie
        INNER JOIN saison ON saison.id_serie = serie.id_serie
        INNER JOIN saison_episode ON saison_episode.id_saison = saison.id_saison
        INNER JOIN episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN episode_realisateur ON episode_realisateur.id_episode = episode.id_episode
        INNER JOIN realisateur ON  realisateur.id_real = episode_realisateur.id_real
        WHERE realisateur.id_real = :real_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':real_id', $real_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    public function getActByNom($nom_act){
        $sql = "SELECT * FROM acteur WHERE nom_acteur LIKE CONCAT('%',:nom_act,'%')";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom_act', $nom_act);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    public function getSeriesByAct($act_id){
        // Afficher toutes les séries d'un real
        $sql = "SELECT DISTINCT titre_serie, affiche_serie, synopsis_serie FROM serie
        INNER JOIN saison ON saison.id_serie = serie.id_serie
        INNER JOIN saison_acteur ON saison_acteur.id_saison = saison.id_saison
        INNER JOIN acteur ON acteur.id_acteur = :act_id AND acteur.id_acteur = saison_acteur.id_acteur";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':act_id', $act_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }
    
    public function getEpisodes($saison_id){
        // Afficher les épisodes d'une saison
        $sql = "SELECT * FROM episode
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        WHERE saison.id_saison = :saison_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':saison_id', $saison_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    //utilisée
    public function getSerieByTitre($titre_serie){
        $sql = "SELECT * FROM serie WHERE titre_serie LIKE CONCAT('%',:titre_serie,'%')";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre_serie', $titre_serie);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    //utilisée
    public function getSerieById($id){
        $sql = "SELECT * FROM serie WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }
    
    //utilisée
    public function getIdByTag($tag){
        $sql = "SELECT id_tag FROM tag WHERE nom_tag = :tag";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':tag', $tag);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }
        
    public function getSaisonByNum($num){
        $sql= "SELECT * FROM saison WHERE numero_saison = :num";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':num', $num);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }
    
    //utilisée
    public function getSaisonById($id_saison){
        $sql = "SELECT titre_saison FROM saison WHERE id_saison = :id_saison";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $id_saison);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    //utilisée
    public function getTitreSerieBySaison($id_saison){
        $sql = "SELECT titre_serie FROM serie
        INNER JOIN saison ON serie.id_serie = saison.id_serie
        WHERE saison.id_saison = :id_saison";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $id_saison);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    public function getEpisode($saison_id, $serie_id){
        $sql = "SELECT * FROM episode
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        INNER JOIN serie ON saisonid_serie = serie.id_serie
        WHERE saison.id_saison = :saison_id AND serie.id_serie = :serie_id";

        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    public function getTitreSerieByIdSaison($id_saison){
        $sql="SELECT titre_serie FROM serie
        INNER JOIN saison on serie.id_serie = saison.id_serie
        WHERE saison.id_saison = :id_saison";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $id_saison);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    public function getEpiBySerieId($id_serie){
        $sql="SELECT titre_episode FROM episode
        INNER JOIN saison_episode on episode.id_episode = saison_episode.id_episode
        INNER JOIN saison on saison_episode.id_saison = saison.id_saison
        INNER JOIN serie on saison.id_serie = serie.id_serie
        WHERE serie.id_serie = :id_serie";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_serie', $id_serie);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    //les séries en communs
    public function getSeriesByMultipleAct($tab){
        $nbActeurs = count($tab);

        $sql = "SELECT DISTINCT titre_serie, affiche_serie, synopsis_serie FROM serie
        INNER JOIN saison on serie.id_serie = saison.id_serie ";

        for($i=1; $i<=$nbActeurs; $i++){
            /*on INNER JOIN les saisons jouées par chaque acteur */
            $sql .= "INNER JOIN saison_acteur sai_act$i on saison.id_saison = sai_act$i.id_saison
            INNER JOIN acteur act$i on sai_act$i.id_acteur = act$i.id_acteur ";
        }

        /* et enfin on regroupe uniquement quand le nom du premier acteur = nom 2ème acteur*/
        $sql.= "WHERE act1.nom_acteur LIKE CONCAT('%',:nom_act1,'%') ";
        
        for($i=2; $i<=$nbActeurs; $i++){
            $sql .= " AND act$i.nom_acteur LIKE CONCAT('%',:nom_act$i,'%')";
        }

        $statement = $this->pdo->prepare($sql);

        for($i=1; $i<=$nbActeurs; $i++){
            $statement->bindValue(":nom_act$i", $tab[$i-1]);
        }

        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    public function getTagNames(){
        $sql = "SELECT nom_tag FROM tag";

        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    public function getSeriesByTagName($nom_tag){
        $sql = "SELECT * FROM serie
        INNER JOIN serie_tag on serie.id_serie = serie_tag.id_serie
        INNER JOIN tag on serie_tag.id_tag = tag.id_tag
        WHERE tag.nom_tag = :nom_tag";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom_tag', $nom_tag);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
    }

    /* LES FONCTIONS CI-DESSOUS REGROUPENT LES REQUETES POUR MODIFIER LA BD : AJOUTER, MODIFIER, SUPPRIMER... */

    //utilisée
    /*
    */
    public function addSerie($id_serie, $titre, $affiche, $synopsis){
        $sql = "INSERT INTO serie (id_serie, titre_serie, affiche_serie, synopsis_serie) 
                VALUES (:id_serie, :titre, :affiche, :synopsis)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_serie', $id_serie);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':synopsis', $synopsis);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addTag($id_tag, $nom_tag){
        $sql = "INSERT INTO tag (id_tag, nom_tag) 
                VALUES (:id_tag, :nom_tag)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_tag', $id_tag);
        $statement->bindParam(':nom_tag', $nom_tag);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addReal($id_real, $nom, $img){
        $sql = "INSERT INTO realisateur (id_real, nom_real, photo_real) 
                VALUES (:id_real, :nom, :img)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_real', $id_real);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':img', $img);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addAct($id_act, $nom, $img){
        $sql = "INSERT INTO acteur (id_acteur, nom_acteur, photo_acteur) 
                VALUES (:id_act, :nom, :img)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_act', $id_act);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':img', $img);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function addEp($id_ep, $titre_ep, $synopsis_ep, $duree_ep){
        $sql = "INSERT INTO episode (id_episode, titre_episode, synopsis_episode, duree_episode)
                VALUES (:id_ep, :titre_ep, :synopsis_ep, :duree_ep)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_ep', $id_ep);
        $statement->bindParam(':titre_ep', $titre_ep);
        $statement->bindParam(':synopsis_ep', $synopsis_ep);
        $statement->bindParam(':duree_ep', $duree_ep);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addSaisonActJointure($id_saison, $id_act){
        $sql = "INSERT INTO saison_acteur (id_saison, id_acteur) 
                VALUES (:id_saison, :id_act)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $id_saison);
        $statement->bindParam(':id_act', $id_act);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function addSaisonEpisodeJointure($id_saison, $id_ep){
        $sql = "INSERT INTO saison_episode (id_saison, id_episode) 
                VALUES (:id_saison, :id_ep)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $id_saison);
        $statement->bindParam(':id_ep', $id_ep);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function addEpisodeRealisateurJointure($id_ep, $id_real){
        $sql = "INSERT INTO episode_realisateur (id_episode, id_real) 
                VALUES (:id_ep, :id_real)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_ep', $id_ep);
        $statement->bindParam(':id_real', $id_real);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }
    
    //utilisée
    public function addSerieTagJointure($id_serie, $id_tag){
        $sql = "INSERT INTO serie_tag (id_serie, id_tag) 
                VALUES (:id_serie, :id_tag)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_serie', $id_serie);
        $statement->bindParam(':id_tag', $id_tag);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }


    //utilisée
    public function addSaison($id_saison, $titre, $numero, $affiche, $id_serie){
        $sql = "INSERT INTO saison (id_saison, titre_saison, numero_saison, affiche_saison, id_serie)
                VALUES (:id_saison, :titre, :numero, :affiche, :id_serie)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $id_saison);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':numero', $numero);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':id_serie', $id_serie);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function updateSerie($id, $titre, $affiche, $synopsis){

        //METTRE UN GIGA SQL
        $sql = "UPDATE serie 
                SET titre_serie = :titre, 
                    affiche_serie = :affiche, 
                    synopsis_serie = :synopsis 
                WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':synopsis', $synopsis);
        $statement->bindParam(':id', $id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function updateSaison($id, $titre, $numero, $affiche, $id_serie){
        $sql = "UPDATE saison 
                SET titre_saison = :titre, 
                    affiche_saison = :affiche, 
                    numero_saison = :numero,
                    id_serie = :id_serie
                WHERE id_saison = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':numero', $numero);
        $statement->bindParam(':id', $id);
        $statement->bindParam(':id_serie', $id_serie);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function updateEpisode($id, $titre, $duree, $synopsis){
        $sql = "UPDATE episode 
                SET titre_serie = :titre, 
                    affiche_serie = :affiche, 
                    duree_episode = :duree 
                WHERE id_episode = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':duree', $duree);
        $statement->bindParam(':synopsis', $synopsis);
        $statement->bindParam(':id', $id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function deleteSerie($id){
        $sql = "DELETE FROM serie WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function deleteAct($id){
        $sql = "DELETE FROM acteur WHERE id_acteur= :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function deleteReal($id){
        $sql = "DELETE FROM realisateur WHERE id_real = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    
    public function deleteSaison($saison_id){
        $sql = "DELETE FROM saison
        WHERE id_saison = :saison_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $saison_id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function deleteEpisode($episode_id){
        $sql = "DELETE FROM episode
        WHERE id_episode = :episode_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':episode_id', $episode_id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    // Sup toutes la base de données
    public function deleteAll(){
        $sql = "DELETE FROM serie; DELETE FROM episode; DELETE FROM realisateur; DELETE FROM acteur; DELETE FROM saison;";

        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    // Sup tous les réals
    public function deleteAllReal(){
        $sql = "DELETE FROM realisateur";

        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    // Sup tous les acteurs
    public function deleteAllActeur(){
        $sql = "DELETE FROM acteur";

        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    /* LES FONCTIONS CI-DESSOUS REGROUPENT LES REQUETES POUR COMPTER LE TOTAL DES SERIES, GENRES...*/

    //utilisée
    public function countSeries(): int{
        $sql = "SELECT COUNT(*) FROM serie";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        //POURQUOI ON UTILISE FETCH COLUMN?
        return $statement->fetchColumn();
    }

    //utilisée
    public function countTags(): int{
        $sql = "SELECT COUNT(*) FROM tag";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }

    //utilisée
    public function countActs(): int{
        $sql = "SELECT COUNT(*) FROM acteur";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }

    //utilisée
    public function countReals(): int{
        $sql = "SELECT COUNT(*) FROM realisateur";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }

    //utilisée
    public function countSaisons(): int{
        $sql = "SELECT COUNT(*) FROM saison";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }

    //utilisée
    public function countEpisodes(): int{
        $sql = "SELECT COUNT(*) FROM episode";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }

    //utilisée
    public function getTimeSerie($serie_id){
        // Durée totale de la série
        $sql = "SELECT SUM(episode.duree_episode) FROM episode
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        INNER JOIN serie ON saison.id_serie = serie.id_serie
        WHERE serie.id_serie = :serie_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':serie_id', $serie_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    //utilisée
    public function getTimeSaison($saison_id){
        // Durée de chaque saison
        $sql = "SELECT SUM(episode.duree_episode) FROM episode 
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        WHERE saison.id_saison = :saison_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':saison_id', $saison_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    public function getTimeEpisode($epi_id){
        // Durée d'un épisode
        $sql = "SELECT episode.duree_episode FROM episode
        WHERE episode.id_episode = :epi_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':epi_id', $epi_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }

    //utilisée
    public function getNbSaison($serie_id){
        // Afficher le nombre de saisons
        $sql = "SELECT COUNT(*) FROM saison
        INNER JOIN serie on saison.id_serie = serie.id_serie
        WHERE saison.id_serie = :serie_id";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':serie_id', $serie_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }
    
    //utilisée
    public function getNbEpisode($saison_id){
        // Afficher le nombre d'épisodes par saisons
        $sql = "SELECT COUNT(*) FROM episode
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        WHERE saison_episode.id_saison = :id_saison";

        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id_saison', $saison_id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
    }
}