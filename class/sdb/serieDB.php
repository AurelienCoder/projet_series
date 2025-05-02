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
    public function getRealId($nom_real){
        $sql = "SELECT id_real FROM realisateur WHERE nom_real = :nom_real";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom_real', $nom_real);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
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

        
    //utilisée
    public function getActId($nom_act){
        $sql = "SELECT id_acteur FROM acteur WHERE nom_acteur = :nom_act";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom_act', $nom_act);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
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
    public function getIdBySerie($serie){
        $sql = "SELECT id_serie FROM serie WHERE titre_serie = :titre_serie";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre_serie', $serie);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        return $statement->fetchColumn();
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
    
    public function getSaisonByNum($num){
        $sql= "SELECT * FROM saison WHERE numero_saison = :num";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':num', $num);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\Render");
        return $results;
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

    /* LES FONCTIONS CI-DESSOUS REGROUPENT LES REQUETES POUR MODIFIER LA BD : AJOUTER, MODIFIER, SUPPRIMER... */

    //utilisée
    public function addSerie($titre, $affiche, $synopsis){
        $sql = "INSERT INTO serie (titre_serie, affiche_serie, synopsis_serie) 
                VALUES (:titre, :affiche, :synopsis)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':synopsis', $synopsis);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addReal($nom, $img){
        $sql = "INSERT INTO realisateur (nom_real, photo_real) 
                VALUES (:nom, :img)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':img', $img);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addAct($nom, $img){
        $sql = "INSERT INTO acteur (nom_acteur, photo_acteur) 
                VALUES (:nom, :img)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':nom', $nom);
        $statement->bindParam(':img', $img);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    //utilisée
    public function addSaison($titre, $numero, $affiche, $id_serie){
        $sql = "INSERT INTO saison (titre_saison, affiche_saison, numero_saison, id_serie)
                VALUES(:titre, :affiche, :numero, :id_serie)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':numero', $numero);
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