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

    //IMPORTANT Nous ne sommes pas obligés de spécifier le type de retour
    public function getAllSeries(){
        $sql = "SELECT * FROM serie INNER JOIN serie_tag, tag 
        WHERE serie.id_serie = serie_tag.id_serie AND tag.id_tag = serie_tag.id_tag";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        //IMPORTANT FETCH_ASSOC pour transformer en tableau
        //FETCH_CLASS pour transmettre les données vers une classe
        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\SerieRender");

        return $results;
    }

    public function getAllActors(){
        $sql = "SELECT * FROM acteur";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\ActorRender");

        return $results;
    }

   /* public function getRealistorFromSerie($id){

        $sql = "FROM serie"

    }*/

    public function getAllRealisators(){
        $sql = "SELECT * FROM realisateur";

        $statement = $this->pdo->prepare($sql);

        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\RealRender");

        return $results;
    }

    
    public function getRequest(){
        // Afficher le nombre de saison
        $sql = "SELECT COUNT(id_saison) FROM saison
        WHERE saison.id_serie = ...
        INNER JOIN serie on saison.id_serie = serie.id_serie";

        // Afficher le nombre d'épisodes par saisons
        $sql = "SELECT COUNT(episode.id_episode) FROM episode
        WHERE saison_episode.id_saison = ...
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode";

        // Durée totale de la série
        $sql = "SELECT SUM(episode.duree_episode) FROM episode
        WHERE serie.id_serie = ...
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        INNER JOIN serie ON saison.id_serie = serie.id_serie";

        // Durée de chaque saison
        $sql = "SELECT SUM(episode.duree_episode) FROM episode 
        WHERE saison.id_saison = ...
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison";

        // Durée d'un épisode
        $sql = "SELECT episode.duree_episode FROM episode
        WHERE episode.id_episode = ...";

        // Afficher tous les real d'une série
        $sql = "SELECT realisateur.nom_real FROM realisateur
        WHERE serie.id_serie = ...
        INNER JOIN episode_realisateur ON realisateur.id_real = episode_realisateur.id_real
        INNER JOIN episode ON episode_realisateur.id_episode = episode.id_episode
        INNER JOIN saison_episode ON episode.id_episode = saison_episode.id_episode
        INNER JOIN saison ON saison_episode.id_saison = saison.id_saison
        INNER JOIN serie ON saison.id_serie = saison.id_serie";

        $statement = $this->pdo->prepare($sql);

        $statement->bindParam(':acteur', $acteur);


        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\SerieRender");

        return $results;

    }
    
    public function getSpecialRequest(string $acteur){
        
        /*
                if($titre != null){
            $sql= "SELECT * FROM serie WHERE $titre = serie.titre_serie";
        }

        else if($tag != null){
            $sql= "SELECT * FROM serie WHERE $tag = tag.nom_tag
            INNER JOIN serie_tag WHERE serie.id_serie = serie_tag.serie_id
            INNER JOIN tag WHERE serie_tag.id_tag = tag.id_tag
            ";
        }

        else if($acteur != null){
            $sql= "SELECT * FROM serie WHERE $acteur = acteur.nom_acteur
            INNER JOIN saison WHERE serie.id_serie = saison.id_serie
            INNER JOIN saison_acteur WHERE saison saison.id_saison = saison_acteur.id_saison
            INNER JOIN acteur WHERE saison_acteur.id_acteur = acteur.id_acteur
            ";
        }

        if($titre != null){
            $sql= "SELECT * FROM serie WHERE $titre = serie.titre_serie";
        }

        else if($tag != null){
            $sql= "SELECT * FROM serie WHERE $tag = tag.nom_tag
            INNER JOIN serie_tag WHERE serie.id_serie = serie_tag.serie_id
            INNER JOIN tag WHERE serie_tag.id_tag = tag.id_tag
            ";
        }*/

        if($acteur != null){
            $sql= "SELECT * FROM serie 
            INNER JOIN saison ON serie.id_serie = saison.id_serie
            INNER JOIN saison_acteur ON saison_acteur.id_saison = saison.id_saison
            INNER JOIN acteur ON saison_acteur.id_acteur = acteur.id_acteur
            WHERE :acteur = acteur.nom_acteur";
        }
        $statement = $this->pdo->prepare($sql);

        $statement->bindParam(':acteur', $acteur);


        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\SerieRender");

        return $results;
    }

    public function getAllTags(){
        $sql = "SELECT * FROM tag";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        $results = $statement->fetchAll(PDO::FETCH_CLASS, "\sdb\TagRender");
        return $results;
    }

    public function getSerieById($id){
        $sql = "SELECT * FROM serie WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);
        $statement->execute() or die(var_dump($statement->errorInfo()));
        $statement->setFetchMode(PDO::FETCH_CLASS, "\sdb\SerieRender");

        $serie = $statement->fetch();
        return $serie;
    }

    public function addSerie($titre, $affiche, $synopsis){
        $sql = "INSERT INTO serie (titre_serie, affiche_serie, synopsis_serie) 
                VALUES (:titre, :affiche, :synopsis)";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':titre', $titre);
        $statement->bindParam(':affiche', $affiche);
        $statement->bindParam(':synopsis', $synopsis);

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

    public function deleteSerie($id){
        $sql = "DELETE FROM serie WHERE id_serie = :id";
        $statement = $this->pdo->prepare($sql);
        $statement->bindParam(':id', $id);

        $statement->execute() or die(var_dump($statement->errorInfo()));
    }

    public function countSeries(): int{
        $sql = "SELECT COUNT(*) FROM serie";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }

    public function countTags(): int{
        $sql = "SELECT COUNT(*) FROM tag";
        $statement = $this->pdo->prepare($sql);
        $statement->execute() or die(var_dump($statement->errorInfo()));

        return $statement->fetchColumn();
    }
}