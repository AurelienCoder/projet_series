-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 30 avr. 2025 à 12:42
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `seriesdb`
--

-- --------------------------------------------------------

--
-- Structure de la table `acteur`
--

DROP TABLE IF EXISTS `acteur`;
CREATE TABLE IF NOT EXISTS `acteur` (
  `id_acteur` int NOT NULL AUTO_INCREMENT,
  `nom_acteur` text NOT NULL,
  `photo_acteur` text NOT NULL,
  PRIMARY KEY (`id_acteur`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `acteur`
--

INSERT INTO `acteur` (`id_acteur`, `nom_acteur`, `photo_acteur`) VALUES
(1, 'Bryan Cranston', 'https://m.media-amazon.com/images/M/MV5BMTA2NjEyMTY4MTVeQTJeQWpwZ15BbWU3MDQ5NDAzNDc@._V1_.jpg\n'),
(2, 'Anna Gunn', 'https://fr.web.img5.acsta.net/pictures/18/10/01/17/09/0077364.jpg'),
(3, 'Aaron Paul', 'https://fr.web.img3.acsta.net/c_310_420/pictures/20/01/27/11/03/5568116.jpg'),
(4, 'Dean Norris', 'https://fr.web.img3.acsta.net/c_310_420/pictures/16/01/12/15/57/364496.jpg'),
(5, 'Alexander Dreymon', 'https://i.pinimg.com/736x/91/3a/f2/913af28991cc1d98f13e320dfd16ac06.jpg'),
(6, 'Emily Cox', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSTVPg3X0-SUa1YY1W-GuS8h-kAZXGUCFK0Jg&s'),
(7, 'David Dawson', 'https://resizing.flixster.com/08MXSnZKtNV-8xMWB-PyGDWYtHU=/fit-in/705x460/v2/https://resizing.flixster.com/-XZAfHZM39UwaGJIFWKAE8fS0ak=/v3/t/assets/568565_v9_bb.jpg'),
(8, 'Millie Bobby Brown', 'https://upload.wikimedia.org/wikipedia/commons/thumb/9/9b/Millie_Bobby_Brown_-_MBB_-_Portrait_1_-_SFM5_-_July_10%2C_2022_at_Stranger_Fan_Meet_5_People_Convention.jpg/500px-Millie_Bobby_Brown_-_MBB_-_Portrait_1_-_SFM5_-_July_10%2C_2022_at_Stranger_Fan_Meet_5_People_Convention.jpg'),
(9, 'Finn Wolfhard', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRyvDOG3rAZOlAOVzGhALzg98AmDaA5480cyw&s'),
(10, 'Noah Schnapp', 'https://fr.web.img6.acsta.net/pictures/19/07/01/11/28/3898122.jpg'),
(11, 'Bob Odenkirk', 'https://fr.web.img5.acsta.net/pictures/20/01/27/11/02/2911620.jpg'),
(12, 'Rhea Seehorn', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQWdrNjppLou0SHtdGpu6Bm0Lr71FjHuN6P7g&s'),
(13, 'Jonathan Banks', 'https://fr.web.img3.acsta.net/c_310_420/pictures/16/07/15/12/17/522276.jpg'),
(14, 'Jared Harris', 'https://fr.web.img4.acsta.net/c_310_420/pictures/19/05/29/15/06/5091357.jpg'),
(15, 'Stellan Skarsgard', 'https://fr.web.img4.acsta.net/c_310_420/pictures/210/520/21052035_20131023120717545.jpg'),
(16, 'Paul Ritter', 'https://fr.web.img3.acsta.net/c_310_420/pictures/14/11/19/10/44/390575.jpg'),
(17, 'Jessie Buckley', 'https://fr.web.img5.acsta.net/c_310_420/pictures/20/01/14/15/08/2896019.jpg'),
(18, 'Jung-jae Lee', 'https://fr.web.img2.acsta.net/c_310_420/img/af/93/af9368b665be3164c05ddb8949ebaaa7.jpg'),
(19, 'Park Hae-Soo', 'https://fr.web.img4.acsta.net/c_310_420/pictures/21/10/05/11/33/4584495.jpg'),
(20, 'Jung Ho-Yeon', 'https://fr.web.img4.acsta.net/c_310_420/pictures/21/10/05/11/42/3681096.jpg'),
(21, 'Lee Byung-Hun', 'https://fr.web.img3.acsta.net/c_310_420/img/c2/c3/c2c3f461fb5a8b120167402e9362e738.jpg'),
(22, 'Wi Ha-Joon', 'https://fr.web.img4.acsta.net/c_310_420/pictures/22/05/11/09/45/4627158.jpg'),
(23, 'Michael C. Hall', 'https://fr.web.img3.acsta.net/pictures/18/05/25/16/54/2970400.jpg'),
(24, 'Jennifer Carpenter', 'https://m.media-amazon.com/images/M/MV5BMTA3Mzk2NTk0MDReQTJeQWpwZ15BbWU3MDQ1MDQyNzY@._V1_FMjpg_UX1000_.jpg'),
(25, 'David Zayas', 'https://m.media-amazon.com/images/M/MV5BMjA5NTkwMTg1N15BMl5BanBnXkFtZTcwNzU2ODE3Mw@@._V1_FMjpg_UX1000_.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `episode`
--

DROP TABLE IF EXISTS `episode`;
CREATE TABLE IF NOT EXISTS `episode` (
  `id_episode` int NOT NULL AUTO_INCREMENT,
  `titre_episode` text NOT NULL,
  `synopsis_episode` text NOT NULL,
  `duree_episode` int NOT NULL,
  PRIMARY KEY (`id_episode`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `episode`
--

INSERT INTO `episode` (`id_episode`, `titre_episode`, `synopsis_episode`, `duree_episode`) VALUES
(1, 'Chute libre', 'Un homme en sous-vêtements (Bryan Cranston) et portant un masque à gaz conduit à toute allure un camping-car sur une route du désert du Nouveau-Mexique. Un jeune homme, portant également un masque à gaz, le visage boursouflé, occupe inconscient le siège passager du véhicule. Alors que la caravane s\'enfonce dans un fossé, deux corps inertes roulent sur le sol du véhicule. Le conducteur, essoufflé, s\'échappe du véhicule une caméra à la main, équipé d\'un revolver et de son porte-feuilles. Se présentant comme Walter Hartwell White, il enregistre un adieu désespéré adressé à sa femme, son fils et sa fille au son lointain des sirènes de la police. Son message terminé, il s\'écarte de la route, un pistolet à la main.', 58),
(2, 'Le choix', 'A l’aide d’un remorqueur, Walter et Jesse ont fait sortir le camping-car du fossé sans attirer les soupçons, et doivent maintenant se débarrasser des corps d’Emilio et de Krazy-8, à l’arrière du véhicule. Alors qu’ils s’apprêtent à partir, ils découvrent avec stupéfaction que Krazy-8 est vivant, et ne sont pas d’accord sur la marche à suivre. Le camping-car est caché dans le jardin de la maison de Jesse. Alors que Walt prend le petit-déjeuner en famille, son associé l’appelle et l’informe que leur prisonnier reste en vie malgré ses blessures. Intrigué par l’appel, Skyler mène son enquête et découvre que son mari fréquente Jesse Pinkman.', 42),
(3, 'Traqués', 'Après avoir terminé leur échange avec Tuco dans la casse, Walt et Jesse réalisent que Tuco est fou. En effet, ce dernier tue son homme de main pour une raison futile en le tabassant violemment, sous leurs yeux. Une fois rentrés, les deux hommes sont persuadés qu\'ils sont les prochains sur la liste. Jesse est même convaincu d\'avoir vu Tuco dans une voiture noire passant dans sa rue. Pour lui, la seule solution est de tuer Tuco avant qu\'il ne les tue. Il s\'achète une arme. Mais Walt a une meilleure idée et pense à utiliser de la ricine, un poison biologique qu\'il sait fabriquer. En effet aucun des deux ne sait utiliser une arme à feu. Un soir, Walt rentre chez lui mais a à peine le temps de se poser que son téléphone sonne. C\'est alors qu\'il sort et voit Jesse dans sa voiture. Walt demande à Jesse ce qu\'il fait là puis aperçoit Tuco armé sur la banquette arrière qui lui demande de grimper dans le véhicule. Tuco kidnappe les deux hommes.', 47),
(4, 'Chasse à l\'homme', 'Walt a disparu. Toute sa famille, profondément inquiète, le cherche activement. En réalité, Walt et Jesse ont été enlevés par Tuco qui a paniqué après la disparition de son bras droit et beau-frère, Gonzo. Il les conduit dans une maison dans la campagne et on découvre son oncle (Tio) en fauteuil roulant qui ne communique qu’en faisant sonner une cloche. Walt et Jesse essayent d\'empoisonner la nourriture de Tuco, en vain : l\'oncle, même s\'il ne peut plus parler, a toute sa tête. Il comprend le stratagème du duo et empêche Tuco de manger.', 42),
(5, 'Crash', 'Des jumeaux mexicains demandent l\'aide d\'une divinité locale pour provoquer la mort de « Heisenberg » en affichant son portrait, un portrait robot le représentant portant un chapeau et des lunettes de soleil.\r\n\r\nDeux semaines après la collision de deux avions au-dessus d\'Albuquerque, la ville est en émoi. En effet, le père de Jane, contrôleur aérien, est en grande partie responsable de cet accident : il avait repris le travail peu de temps après la mort de sa fille alors que son état psychologique était encore instable.', 42),
(6, 'Tensions', 'Walt vient récupérer Jesse à sa sortie de cure et lui propose de rester dans son appartement personnel quelque temps. Même s\'il est clean, il semble toujours terriblement mal. Il apprend par son père en passant dans le quartier qu\'ils ont entrepris des travaux pour vendre l\'ancienne maison de Jesse.\r\n\r\nSkyler consulte une avocate afin d\'obtenir la garde exclusive de ses enfants. Elle annonce à Walt qu\'elle a compris qu\'il était un dealer de drogues. Il révèle alors qu\'il n\'est pas un dealer mais un cooker de meth, le « cuisinier ». Choquée, elle annonce qu\'elle ne dira rien à la police uniquement s\'il renonce à sa famille.', 45),
(7, 'Le cutter', 'Jesse a tué Gale d\'une balle sous l’œil gauche. Victor, l\'homme de main de Gustavo retrouve le jeune homme, en état de choc, et le ramène au labo où Mike détient Walter. Lorsque Victor revient avec Jesse, Walt essaie de négocier avec Mike pour qu\'ils reprennent le travail, mais à leur grande surprise Victor commence à « cuisiner » : il a retenu tous les gestes des chimistes et s\'estime prêt à gérer le laboratoire. Quand Gus apparaît enfin, il ne dit mot, enfile une combinaison et après un moment de suspense égorge Victor avec un cutter sous les yeux de tous, avant de partir pour les laisser reprendre le travail. Les trois hommes se débarrassent du corps en le dissolvant dans de l\'acide fluorhydrique puis rentrent chez eux. Walt et Jesse savent à quoi s\'en tenir : ils sont en vie, mais vont regretter leur geste. Ils sont alors tous menacés car une enquête de police est lancée dans l\'appartement de Gale.', 48),
(8, 'Snub 38', 'Walt se procure une arme dans l\'idée de se débarrasser de Gus (qui ne veut plus avoir affaire à lui) et finit par demander de l\'aide auprès de Mike, qui refuse en le tabassant.\r\n\r\nJesse ne se remet toujours pas de la fin tragique de Gale et décide d\'organiser une grande fête chez lui pour se changer les idées, impliquant alcool, cigarettes, drogue et nuits blanches.', 44),
(9, 'Vivre libre ou mourir', 'Walt s\'assure que rien ne pourra mener Hank sur ses traces. Quelques jours après avoir brûlé le labo, il repense aux caméras de surveillance dont il existe certainement des enregistrements vidéo contenus dans l\'ordinateur portable de Gus que la DEA a saisi et mis sous scellé. Pour Mike, il est désormais impossible de s\'en tirer et il suggère à tous de prendre la fuite. Jesse a cependant une idée, qui paraît d\'abord saugrenue : utiliser un aimant géant. Walter s\'en inspire pour concevoir un nouveau stratagème à base scientifique : un électro-aimant d\'une casse automobile, capable de générer une onde électromagnétique suffisamment puissante pour effacer les données, alimenté avec un assemblage de batteries de voiture.', 50),
(10, 'Madrigal', 'Continuant l\'enquête et tirant parti de la liste cachée retrouvée après le sabotage du dépôt des scellés, la DEA commence à se pencher sur les finances et les partenaires professionnels de Gus, ce qui met la pression sur ses anciens collaborateurs. Les autorités se concentrent sur la Madrigal Electromotive, une société allemande dans laquelle Gus avait des parts. La mystérieuse Lydia, son ancien contact dans cette société, rencontre Mike afin de savoir si ses anciens subordonnés incarcérés sont parfaitement fiables. Mike lui assure qu\'ils ne parleront pas, Gus ayant prévu une prime pour acheter leur silence en pareil cas, et refuse catégoriquement sa proposition de les faire exécuter ; mais Lydia n\'est pas convaincue, et décide de payer un autre associé pour éliminer les onze hommes, ainsi que Mike afin de se protéger elle-même.', 45),
(11, 'Uhtred, fils d\'Uhtred', 'En 866, le fils aîné du seigneur saxon de Bebbanburg voit arriver des drakkars et est tué par le jarl danois Ragnar. Le roi de Bebbanburg décide de renommer son plus jeune fils Uhtred, du nom de son frère, et le père Beocca le rebatipse. Lors d\'une bataille, le seigneur est tué et son fils kidnappé pour servir d\'esclave dans le clan de Ragnar. Il est élevé comme un Danois. Mais quand Ragnar est tué, Uhtred décide de partir retrouver ses terres... ', 59),
(12, 'Le Royaume de Wessex', 'Venu proclamer aux portes de Bebbanburg qu\'il récupérerait son bien, Uhtred est pris en chasse par son oncle Alferic. Accompagné de Brida, il veut raconter à Ubba ce qui est arrivé à Ragnar, son père adoptif mort assassiné, quand il apprend la rumeur qui court déjà : ce serait lui, Uhtred, qui l\'aurait tué. Ubba croyant la rumeur, ce sont deux camps qui veulent la mort d\'Uhtred. Brida veut se tourner vers Ragnar le Jeune, mais Uhtred l\'en dissuade et l\'emmène dans le Wessex le dernier royaume anglais indépendant, où il pense trouver de l\'aide auprès du roi Aethelred et de son frère Alfred, à Winchester. Mais Alfred se méfie des informations d\'Uhtred sur l’attaque imminente des Vikings. Il conseille à Aethelred de l\'emprisonner. ', 59),
(13, 'Un nouvel espoir', 'L\'intrépide guerrier Uhtred entame son périple vers le nord pour accomplir son destin : venger la mort du comte Ragnar et reconquérir ses terres ancestrales de Bebbanburg. Alfred est toujours plus convaincu de son projet d\'unification de l\'Angleterre, et a des vues sur les terres du Nord, tombées sous le joug des sauvages. Alfred prend sous son aile un nouveau roi, un Danois chrétien, Guthred, pour étendre son influence au-delà du Wessex. Ce roi a été réduit en esclavage, et Uhtred s\'embarque dans une mission de sauvetage qui l\'amène face à un vieil ennemi. ', 57),
(14, 'Jeux de pouvoir', 'Quand des espions infiltrent l\'armée du Cumberland, Uhtred doit compter sur ses troupes pour le sauver d\'une attaque périlleuse. Il reprend l\'habit du cavalier mort une fois de plus, alors que la soif de vengeance de Kjartan est plus forte que jamais. Hild fait son introspection et envisage d\'échanger sa vie de nonne pour celle de guerrière, et les efforts de Guthred pour mettre en œuvre les tactiques conciliantes d\'Alfred se retournent contre lui quand son indécision et son manque de dureté mettent à mal la position des Saxons. Alors que Uhtred et Gisela se rapprochent, les ennemis d\'Uhtred surgissent et ce dernier subit une terrible trahison... ', 59),
(15, 'Episode 1', 'Le temps presse pour le roi Alfred dont la santé décline. Alors qu\'il cherche encore un moyen d\'unir les royaumes d\'Angleterre, son plus grand guerrier, Uthred doit mener le Wessex dans la bataille contre le redoutable Bloodhair. Mais quand Uhtred est maudit par Skade, la divinatrice, la tragédie s\'ensuit. ', 55),
(16, 'Episode 2', 'Quand Uthred commet un crime grave, le roi Alfred tente de tourner les évènements à son avantage. Poussé dans ses retranchements, Uthred riposte par un acte de violence qui le conduit à prendre la fuite. Le guerrier entreprend un nouveau voyage loin du Wessex et il emmène la divinatrice Skade avec lui. ', 53),
(17, 'Episode 1', 'Alors que le Wessex vit des temps troublés, Uthred apprend que les défenses de Bebbanburg ont été affaiblies par les attaques écossaises et décide d\'en profiter pour reprendre ce qui lui revient de droit. Mais lorsqu\'il va demander de l\'aide au roi Edward, ce dernier refuse. ', 56),
(18, 'Episode 2', 'Alors qu\'Uthred et ses hommes se rapprochent de Bebbanburg, le fils prodigue Whitgar revient dans la cité avec une troupe de mercenaires. Ignorant le danger qui les guette, Uthred envoie son propre fils en reconnaissance... Menés par Brida et Cnut, les danois attaquent la Mercie, tandis qu\'Aethelred s\'en prend aux femmes et aux enfants laissés derrière. A Winchester, la reine Aelswith tente de réparer une injustice. ', 55),
(19, 'Episode 1', 'Islande. Des années ont passé. Brida, oubliée de tous sauf d’Uhtred, dispose d’une armée grandissante. Elle bande les yeux de sa fille, devenue adolescente, et dit à la foule silencieuse qu’elle est une voyante, qu’elle va sélectionner une personne à sacrifier aux Dieux. L’homme désigné plonge dans un geyser bouillant. Ensuite, un volcan entre en éruption, ce que Brida interprète comme un signal des Dieux. Son armée prend le large. Sur la frontière entre la Mercie et la Northumbrie, c’est le mois des battues. Uhtred sent que quelque chose a changé. Aethelstan, un peu plus âgé, a l’intention de saigner un sanglier pour montrer sa valeur.', 53),
(20, 'Episode 2', 'A York, les hommes de Brida sont déterminés à trouver Stiorra. Avec sa femme de chambre, celle-ci parvient à tuer l’un d’eux. Sigtryggr, seul dans sa bataille, est forcé de céder. Brida lui coupe une mèche de cheveux. Son frère Rognvaldr part à la recherche de Stiorra, qui parvient à s’enfuir. Brida tranche la gorge d’une femme de chambre. Elle souhaite aussi tuer Sigtryggr, toutefois, elle demande à Rognvaldr de le faire pour tester sa loyauté. Poussé par le regard de Brida, ce dernier s’exécute, à contre-cœur, mais Brida l’arrête à temps. Elle demande à Sigtryggr de lui livrer Uhtred, ce contre quoi elle épargnera Stiorra.', 59),
(21, 'La Disparition de Will Byers', 'Le 6 novembre 1983, à Hawkins dans l\'Indiana, une créature s\'échappe d\'un laboratoire du Département de l\'énergie, emportant un scientifique dans sa fuite. Plus tard, Will Byers, un garçon de 12 ans, rentre chez lui après une longue partie de Donjons et Dragons et se fait attaquer par une créature. Le lendemain, une jeune fille aux cheveux rasés, avec pour seul signe distinctif un tatouage montrant les chiffres 011 sur l\'avant-bras, apparaît près d\'un restaurant. Le gérant et cuisinier, Benny, décide de s\'occuper d\'elle avant d\'appeler les services sociaux, mais se fait tuer par une équipe venant récupérer la jeune fille, qui s\'échappe. Le shérif Hopper se charge sans entrain de rechercher Will et retrouve son vélo en forêt ; Lucas, Mike et Dustin, ses amis, sortent dans la nuit pluvieuse rechercher leur ami et trouvent la jeune fille.', 48),
(22, 'La barjot de Maple Street', 'Lucas, Mike et Dustin ramènent la fille chez Mike et la cachent dans le sous-sol. Elle commence à se confier à Mike, lui montrant son tatouage. Joyce, la mère de Will, a reçu un appel téléphonique étrange où elle jure avoir entendu son fils avant qu\'un court-circuit ne grille le téléphone. Le lendemain, alors que Joyce part faire des photocopies de l’avis de recherche et que Jonathan, son fils aîné, est parti chez son père vérifier que Will n\'est pas avec lui, les scientifiques fouillent la maison des Byers et repèrent une substance coulant des murs. Mike sèche l\'école pour rester avec la fille, qu\'il surnomme Elf, et elle reconnait Will sur une photo. Quand Lucas et Dustin l\'apprennent et veulent prévenir les adultes de la présence de Onze, celle-ci montre ses pouvoirs de télékinésie pour les retenir.', 55),
(23, 'MADMAX', 'À Pittsburgh, en 1984, un gang réussit à échapper à la police grâce à l’une de leurs membres, possédant des pouvoirs psychiques et portant un tatouage 008 au poignet.\r\n\r\nHawkins se prépare à fêter Halloween. Will, Mike, Dustin et Lucas continuent à trainer ensemble et découvrent que quelqu\'un a battu leurs scores à la salle d\'arcade, signant son record « MADMAX ». Le lendemain, une nouvelle élève arrive dans leur classe : Maxine (Max). Dustin et Lucas la suivent pour vérifier qu\'elle est bien MADMAX.', 48),
(24, 'Des bonbons ou un sort, espèce de taré', 'Une série de flashbacks montre comment Onze a survécu : après avoir vaincu le Démogorgon, elle s\'est réveillée dans le Monde à l\'envers et a trouvé un passage vers le vrai monde. Découvrant que des agents du gouvernement la recherchent activement, elle s\'est réfugiée dans les bois, vivant de chasse jusqu\'à ce que Hopper la retrouve.', 56),
(25, 'Suzie, tu me reçois ?', 'En juin 1984, une équipe de scientifiques soviétiques mène des tests pour une machine capable d\'ouvrir un portail vers le Monde à l\'Envers. Devant leur échec, le général en charge leur laisse un an.', 50),
(26, 'Comme des rats', 'Billy parvient à sortir de l\'entrepôt mais en regagnant sa voiture, il se retrouve dans le Monde à l\'Envers face à un double de lui-même.\r\n\r\nPlutôt que de suivre les conseils de Joyce, Hopper terrorise Mike et lui interdit de revoir Elfe. Ravi de voir qu\'il suit ses ordres, Hopper invite Joyce à dîner. Elfe sent que Mike lui ment et demande conseil à Max, qui l\'emmène au centre commercial pour lui changer les idées. Mike s\'y rend également avec Lucas et Will pour trouver un cadeau et se faire pardonner, mais quand il croise les filles et s\'enferme dans ses mensonges, elle préfère rompre. Hopper est chargé par le maire de faire évacuer les citoyens manifestant contre le centre commercial. Le commissaire part ensuite pour son rendez-vous mais Joyce est absorbée par un phénomène étrange : les aimants ne semblent plus fonctionner ; elle se rend chez Mr Clarke, le professeur de Mike, Will, Dustin, Lucas et Max pour comprendre.', 50),
(27, 'Le Club Hellfire', 'Ce premier épisode suit les divers protagonistes tandis qu\'ils tentent de revenir à une vie normale après les événements tragiques décrits dans la saison précédente. Alors que l\'adaptation à ces nouvelles conditions est plus ou moins difficile pour chacun, un nouveau drame sanglant frappe la ville de Hawkins.', 78),
(28, 'La Malédiction de Vecna', 'Hopper a survécu à l\'explosion sous le centre commercial Starcourt mais a été capturé par des soldats soviétiques et envoyé dans un camp de prisonniers au Kamtchatka. Joyce et Murray appellent alors le numéro de téléphone sur la note qui lui a été envoyée et parlent à Dmitri Antonov, un gardien de prison que Hopper a soudoyé. Antonov leur fait remettre une rançon de 40 000 $ à son contact en Alaska. Pendant ce temps, Mike s\'envole pour la Californie pour rendre visite à Onze, où lui et Will la voient se faire intimider par sa camarade de classe Angela ; ', 50),
(29, 'Uno ', 'Saul Goodman a changé d\'identité après son implication dans l\'affaire Heisenberg, il se cache comme employé dans une cafétéria. Il se remémore comment, en 2001, alors qu\'il portait son nom de naissance, James McGill, il essayait de vivre comme avocat indépendant, gagnant un maigre salaire quand il défendait des dossiers comme avocat commis d\'office. Sous-payé et lassé d\'être déconsidéré par les avocats associés de son frère Chuck, qui lui volent les quelques clients qu\'il essaie d\'avoir, James a l\'idée de monter une arnaque grâce à deux jeunes skateurs qui ont tenté de l\'arnaquer : ils vont simuler un accident avec la femme de Craig Kettleman que McGill espère obtenir comme cliente. Mais l\'incident se déroule mal puisque la voiture s\'enfuit.', 53),
(30, 'Mijo', 'Tuco Salamanca enferme Jimmy McGill et les deux skaters chez lui. Malgré les explications de Jimmy, qui cherche à lui montrer qu\'il y a eu erreur, Tuco les emmène dans le désert pour les exécuter. Le bras droit de Tuco, Nacho, convainc alors Tuco de laisser la vie sauve à Jimmy. Ce dernier use ensuite de ses talents d\'avocat pour négocier la « peine » des skateurs : Tuco se contentera de leur briser une jambe chacun. Voulant oublier ce triste épisode, Jimmy reprend sa vie d\'avocat commis d\'office. Mais un jour, Nacho vient frapper à sa porte : il lui demande de l\'aider à voler le million de dollars que Craig Kettleman aurait volé à la ville.', 47),
(31, 'Un nouveau chapitre', 'Dans le présent, Jimmy travaille dans une cafétéria et se retrouve coincé pendant quelques heures dans le local poubelle du centre commercial. En attendant d\'être libéré, il grave un message dans le mur : « SG was here. »\r\n\r\nEn 2002, encore troublé d\'avoir rendu les 1,6 million de dollars détournés par les Kettleman, Jimmy décide de s\'amuser, il refuse l\'offre du cabinet Davis & Main et ferme son cabinet. Kim essaie de comprendre son attitude et pour cela, Jimmy l\'enrôle dans une de ses arnaques où il dupe un trader en lui faisant payer une énorme addition au restaurant. Amusée et ivre, Kim passe la nuit avec Jimmy.', 47),
(32, 'Le Gâteau à la crème', 'Howard rend visite à Chuck et lui fait part du poste que Jimmy a obtenu chez Davis & Main. Mike rencontre Pryce au poste de police, il comprend vite que ce dernier est suspecté d\'activité illicite. Il retrouve Nacho et trouve un arrangement : en échange des cartes de baseball et de 10 000 $, il obtient le Hummer de Pryce et toute l\'histoire reste secrète.', 46),
(33, 'Mabel', 'Tandis que Chuck prépare son prochain coup, un autre mensonge vient hanter Jimmy. Ébranlé, Mike essaie de trouver qui peut bien le surveiller et par quel moyen.', 51),
(34, 'Témoignage', 'Mike suit l\'homme de main jusqu\'à un restaurant Los Pollos Hermanos. Kim et Jimmy recherchent une secrétaire, Jimmy écourte la sélection en choisissant la première candidate. Peu après, Mike téléphone au cabinet, la secrétaire le prend pour un client. Il demande à Jimmy de venir espionner à l\'intérieur du restaurant. Le lendemain matin, Jimmy vient prendre un petit déjeuner dans le restaurant pour surveiller l\'homme de main lors de son passage. Il ne remarque rien mais le gérant, Gus Fring, a repéré l\'avocat. Finalement, Gus s\'arrange pour éloigner Mike du restaurant en l\'incitant à suivre une voiture contenant le traqueur GPS, Mike retrouve le traqueur accompagné d\'un téléphone et il reçoit aussitôt un appel.', 47),
(35, 'Fumée', 'Séquence d\'introduction, dans le futur : Jimmy (qui se fait appeler Gene) est hospitalisé après sa perte de connaissance mais les médecins ne lui trouvent rien. Il est nerveux quand le personnel de l\'hôpital a du mal à saisir ses informations personnelles car il craint que sa fausse identité soit découverte.', 47),
(36, 'Respirez', 'Jimmy commence à prospecter pour trouver un nouveau travail maintenant qu\'il n\'a plus l’autorisation d\'exercer le droit. Il convainc les patrons d\'une entreprise de photocopieuses de l’embaucher mais refuse finalement le poste car il trouve ses futurs employeurs trop naïfs. Il a toutefois eu le temps de repérer une figurine Hummel d\'une grande valeur.', 47),
(37, 'Magic Man', 'Séquence d\'introduction, dans le futur : Jimmy part quelques jours après son passage à l\'hôpital. En reprenant son poste dans le centre commercial, il retrouve le chauffeur de taxi qui l\'a raccompagné à sa sortie et l\'a reconnu comme Saul Goodman. Paniqué, Jimmy appelle Ed Galbraith pour une nouvelle extraction avant de se raviser.', 53),
(38, 'Moins 50 % !', 'Gus force Nacho à gagner la confiance de Lalo et obtenir des informations sur ses plans. Quand deux drogués, galvanisés par l\'offre de Saul Goodman, font un gros achat de cocaïne et Krazy-8 se fait surprendre à décoincer les doses de la gouttière où elles étaient coincées, Nacho saisit l\'occasion et s\'infiltre dans la maison par les toits juste avant que la police n\'entre.', 46),
(39, 'Du vin et des roses', 'Séquence d\'introduction dans le futur : une équipe perquisitionne le domicile luxueux de Saul et récupère ses biens.\r\n\r\nAprès avoir été impliqué dans la tentative d\'assassinat de Lalo Salamanca, Nacho prend la fuite et se réfugie dans un motel, où il trouve une enveloppe contenant de l\'argent et une arme. Juan Bolsa apprend à Gus que Lalo est mort et que Nacho est recherché pour trahison, mais Gus émet des doutes quant à la réussite de la mission.', 56),
(40, 'La Carotte et le Bâton', 'Jimmy et Kim continuent de peaufiner leur stratagème contre Howard en le faisant passer pour un accro à la drogue. Kim a alors une idée : elle envoie Jimmy au nouveau service d\'aide fiscale opéré par la famille Kettleman pour leur dire qu\'il possède des preuves pour attaquer Howard en justice pour assistance inappropriée dans leur affaire. Les Kettleman préfèrent rendre visite à Clifford Main pour le convaincre de lancer un procès contre Howard, mais l\'avocat ne croit pas à ces rumeurs et refuse l\'affaire. Le lendemain, Jimmy et Kim retournent voir les Kettleman, qui ont compris leur plan pour salir la réputation d\'Howard et projettent de tout lui raconter. Kim contre-attaque en menaçant de dénoncer la fraude à laquelle se livrent les Kettleman dans leur nouveau métier. Alors que Jimmy et Kim s\'en vont, ils sont suivis par une mystérieuse voiture.', 47),
(41, '1:23:45', 'La catastrophe nucléaire survient à la centrale de Tchernobyl. Les employés et les pompiers tentent de réagir sans comprendre l\'ampleur du désastre, tandis que l\'État minimise la situation.', 60),
(42, 'Please Remain Calm', 'Le scientifique Legasov et le vice-président du Conseil des ministres Chervina tentent de convaincre Moscou que la situation est bien plus grave que prévu, pendant que la radiation se propage silencieusement.', 65),
(43, 'Open Wide, O Earth', 'Legasov et son équipe luttent pour limiter les dégâts. Pendant ce temps, Ulana Khomyuk enquête pour comprendre les causes précises de l\'explosion et affronte la censure du gouvernement.', 66),
(44, 'The Happiness of All Mankind', 'Les liquidateurs doivent nettoyer les zones contaminées, souvent au péril de leur vie. Le gouvernement soviétique organise l\'évacuation forcée de populations entières et impose des mesures drastiques.', 62),
(45, 'Vichnaya Pamyat', 'Le procès de ceux jugés responsables commence. Legasov révèle enfin toute la vérité sur la catastrophe, malgré la menace de représailles de la part de l\'État soviétique.', 72),
(46, 'Un, deux, trois, soleil', 'Seong Gi-hun est un homme malchanceux. Il a accumulé d\'énormes dettes auprès d\'usuriers tout en s\'éloignant de sa fille et de son ex-épouse. Dans le métro, un homme lui propose de jouer au ddakji pour de l\'argent, et lui offre l\'occasion de jouer à d\'autres jeux avec des gains beaucoup plus élevés. Gi-hun accepte, est endormi, et se réveille dans un dortoir avec 455 autres personnes identifiées seulement par un numéro sur leurs survêtements verts.', 60),
(47, 'Enfer', 'Avec plus de la moitié des joueurs tués dans le premier jeu, de nombreux survivants demandent à être libérés. Utilisant la troisième clause du règlement, ils votent de justesse pour annuler le Jeu et renvoyer tout le monde chez soi, mais sans prix.', 63),
(48, 'Du pain et des jeux de hasard', 'Seong Gi-hun reste en Corée, déterminé à affronter l\'Organisateur derrière le Jeu. Réalisant qu\'il est surveillé, il retire un dispositif de traçage implanté derrière son oreille. Hwang Jun-ho a survécu à sa chute de la falaise. Deux ans plus tard, Gi-hun travaille avec Kim, son ancien prêteur sur gages, et ses sbires pour retrouver le recruteur des jeux à Séoul. Kim et son associé, Choi Woo-seok, localisent le recruteur et l\'observent proposer à des sans-abris du pain ou un jeu à gratter ; la plupart choisissent le jeu, et le recruteur détruit le pain rejeté devant eux.', 65),
(49, 'La fête d\'Halloween', 'Gi-hun, Jun-ho et Woo-seok découvrent dans la veste du recruteur une carte qui les conduit à une fête d\'Halloween. Woo-seok recrute une équipe de mercenaires, Gi-hun s\'implante un traceur, et les trois hommes élaborent un plan pour localiser l\'Organisateur. Gi-hun continue de s\'occuper de Cheol et la mère de Sang-woo : il travaille à réunir l\'enfant avec sa mère nord-coréenne, et appelle sa fille qui vit à Los Angeles avec sa mère et son beau-père, mais il reste silencieux au téléphone.', 51),
(50, 'Dexter', 'Dexter Morgan est expert médico-légal spécialisé en analyse et projection de sang à la police scientifique de Miami le jour, et tueur en série la nuit. Un cas inhabituel se présente avec la découverte de cadavres découpés et vidés de leur sang. Dexter est intrigué par la méthode du tueur, ainsi que par le message personnel que celui-ci lui adresse.', 53),
(51, 'Les Larmes du crocodile', 'Dexter assiste Angel et Doakes sur l\'enquête du meurtre d\'un officier sous couverture. Debra découvre un indice dans un camion frigorifique conduit par le meurtrier, ce qui lui vaut une promotion.', 53),
(52, 'L\'Ombre d\'un doute', '38 jours ont passé depuis que Dexter a éliminé Brian Moser. Dexter est suivi nuit et jour par Doakes, ce qui l\'empêche d\'assouvir ses envies de meurtre, et sa première occasion est ruinée par quelque chose de beaucoup plus inattendu. Debra revient au travail et se retrouve sous les flashes des journalistes et du public. Chose qu\'elle n\'apprécie guère. Paul, le mari de Rita, est tué en prison dans une rixe. Des chasseurs de trésor font de plus une découverte horrible au fond de l\'océan que Dexter va avoir du mal à avaler.', 53),
(53, 'Faire le deuil', 'La chasse contre le Boucher de Bay Harbor commence, menée par l\'agent Lundy du FBI. Dexter et son département de police sont sur ses traces dans le Little Chinatown de Miami. Rita a de plus en plus de soupçons sur Dexter à cause de la mort de Paul, et devine qu\'il a provoqué le retour en prison de ce dernier ; mais Dexter se sent contraint de répondre affirmativement à la question de Rita qui lui demande s\'il est aussi accro (aux drogues). Il a trouvé un bon moyen de détourner l\'attention de sa véritable addiction, mais pas sans conséquences.', 54),
(54, 'Notre Père', 'Lors d\'une de ses chasses nocturnes, Dexter tue un homme inconnu qui l\'agresse. Il vient de bafouer le « code de Harry » : il a ôté la vie à un innocent, frère du procureur. De plus, sa vraie cible a disparu dans la nature, après avoir vu le visage de Dexter. L\'affaire est confiée à Debra, qui espère passer inspecteur. De son côté, Dexter se rapproche de plus en plus de Rita, qui lui annonce qu\'elle est enceinte.', 56),
(55, 'À la recherche de Freebo', 'La grossesse de Rita est confirmée, mais Dexter a d’autres soucis. Il doit retrouver Freebo et l’éliminer avant que ses collègues ne lui mettent la main dessus. Miguel Prado s’impatiente et, alors que personne ne le voit venir, Debra pourrait bien répondre à ses attentes en reliant son enquête à celle d’Angel.', 51),
(56, 'Morphée contre Trinité', 'Six mois se sont écoulés, Dexter, père du petit Harrison et sa compagne vivent maintenant dans une nouvelle maison avec leurs trois enfants. Concilier paternité, travail et meurtre est devenu difficile. La fatigue des nuits blanches entraîne des tensions avec ses collègues. L\'agent Lundy, maintenant retraité, revient à Miami dans le but de capturer un serial killer surnommé « Trinité ». Plus tard, alors qu\'il vient d\'assassiner une nouvelle victime, Dexter s\'endort au volant.', 52),
(57, 'Et les restes, alors ?', 'Exténué par sa triple casquette de père de famille, de laborantin pour la police criminelle de Miami et de tueur, Dexter a été victime d\'un accident de la route. Hospitalisé, il souffre d\'une légère amnésie et ne sait plus où est passé le corps de sa dernière victime. Commence alors une course contre la montre pour retrouver les indices du meurtre qu\'il a commis, sans se faire remarquer par ses collègues ou Rita. De son côté, le « tueur de la Trinité » poursuit son sinistre rituel. Debra est chargée de l\'enquête, épaulée par l\'agent Lundy. Le poste de police est encore une fois soumis aux flashs de la presse qui suit avidement l\'affaire. La tension monte et met à rude épreuve les relations qui se nouent à l\'intérieur même du commissariat.', 51),
(58, 'Ma faute', 'Rita est morte. Dexter, portant Harrison dans ses bras, est totalement perdu et commence à ressentir des sentiments humains, insoupçonnés pour lui. Tandis que le FBI prend en charge l\'affaire, Quinn commence à enquêter de son côté sur l\'analyste.', 54),
(59, 'Santa Muerte', 'Après l’enterrement de Rita, Dexter essaie de tourner la page et pense à reconstruire sa vie avec les enfants en cherchant une nouvelle maison et se remet en chasse. Quinn ne sait pas trop quoi faire avec Debra. Angel découvre un compte secret de LaGuerta, avec beaucoup d\'argent.', 52),
(60, 'Ces choses-là', 'Un an a passé depuis la rupture entre Lumen et Dexter. Celui-ci est parvenu à trouver un équilibre entre son activité de tueur en série et son rôle de père. Il s\'occupe de son fils avec l\'aide de Jamie, la sœur d\'Angel Batista. Mais Harrison grandit et doit entrer à l\'école, ce qui force Dexter à s\'interroger sur les valeurs qu\'il veut inculquer à son fils, notamment d\'un point de vue religieux. Son athéisme intrigue la directrice de l\'établissement. Parallèlement, il participe à une réunion d\'anciens élèves de son lycée. Sur place, il tente de prendre un échantillon d\'ADN de Joe Walker, un ancien quaterback, car il croit qu\'il a assassiné son épouse, Janet. De son côté, Maria LaGuerta, désormais divorcée de Batista, est promue capitaine. Quant à Quinn, il souhaite aller plus loin dans sa relation avec Debra. Pendant ce temps, un tueur et son apprenti font leur première victime, agissant selon un schéma biblique.', 52),
(61, 'Il était une fois…', 'L\'acte d\'héroïsme de Debra a des conséquences sur sa vie personnelle et professionnelle : le même jour, elle est demandée en mariage par son petit ami et promue lieutenant au détriment de Batista. L\'enquête sur l\'épicier avec les serpents dans le ventre ramène l\'équipe de la criminelle vers le frère Sam, un ancien délinquant accusé de meurtre apparemment rentré dans le droit chemin, et d\'une des personnes « sauvées » par Frère Sam, un jeune métis nommé Nick. En faisant son enquête sur frère Sam, devenu garagiste et surtout très croyant, Dexter le soupçonne d\'être toujours un tueur en série. Pendant ce temps, les deux tueurs religieux préparent leur nouveau crime.', 52),
(62, 'Es-tu un… ?', 'Dexter assure à Debra qu\'il a tué Travis Marshall en état de légitime défense, et qu\'il n\'a pas agi avec préméditation. Debra se laisse convaincre et ensemble, Dexter et Debra modifient la scène de crime pour laisser croire à un suicide. Le lendemain de la découverte du corps par les forces de l\'ordre, LaGuerta découvre une plaquette du sang de Travis que Dexter a égarée. De son côté, Mike Anderson découvre le cadavre d\'une jeune femme dans un coffre de voiture, et se fait tirer dessus par le conducteur de celle-ci, Viktor Baskov, un mafieux ukrainien. ', 57),
(63, 'Le Code a changé', 'Debra décide de guérir Dexter de son « addiction » en le surveillant 24 heures sur 24, de ce fait il emménage chez elle. Dexter découvre que c\'est Louis qui lui a envoyé la main du tueur du camion de glace. Après avoir voulu le faire fuir, sans succès, il décide de le tuer mais se ravise au dernier moment. ', 55),
(64, 'La Neuro-psychopathe', 'Six mois ont passé depuis la mort du capitaine LaGuerta, mais sa mémoire reste vive. Batista a du mal à faire son deuil. Deb a quitté la Miami Metro pour devenir détective privé et travaille sur des affaires dangereuses, s\'enfonçant dans la drogue et l\'alcool loin de Dexter. Une nouvelle affaire apparaît, où un tueur séquestre ses victimes avant de les abattre et de les opérer pour leur retirer un morceau de cerveau. Le lendemain, le Dr Evelyn Vogel, célèbre neuro-psychiatre spécialisée dans la psychopathie et amie de longue date du chef Matthews, rejoint la Miami Metro pour travailler sur l\'affaire.', 55),
(65, 'Vous êtes parfait', 'Dexter découvre que le Dr Vogel a aidé Harry à mettre en place le code et faire de Dexter le tueur qu\'il est. Elle espère aussi son aide afin de capturer le chirurgien du cerveau, qu\'elle soupçonne être un de ses anciens patients. Debra prend des risques pour mener son affaire à bien mais son employeur craint qu\'elle n\'aille trop loin.', 54);

-- --------------------------------------------------------

--
-- Structure de la table `episode_realisateur`
--

DROP TABLE IF EXISTS `episode_realisateur`;
CREATE TABLE IF NOT EXISTS `episode_realisateur` (
  `id_episode` int NOT NULL,
  `id_real` int NOT NULL,
  PRIMARY KEY (`id_episode`,`id_real`),
  KEY `real_fk_episode` (`id_real`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `episode_realisateur`
--

INSERT INTO `episode_realisateur` (`id_episode`, `id_real`) VALUES
(1, 1),
(29, 1),
(33, 1),
(34, 1),
(40, 1),
(2, 2),
(6, 2),
(7, 2),
(3, 3),
(5, 3),
(4, 4),
(8, 5),
(10, 5),
(30, 5),
(36, 5),
(9, 6),
(11, 7),
(12, 7),
(13, 8),
(14, 8),
(15, 8),
(16, 8),
(17, 10),
(18, 10),
(19, 11),
(20, 11),
(21, 12),
(22, 12),
(23, 12),
(24, 12),
(25, 12),
(26, 12),
(27, 12),
(28, 12),
(21, 13),
(22, 13),
(23, 13),
(24, 13),
(25, 13),
(26, 13),
(27, 13),
(28, 13),
(31, 14),
(32, 15),
(35, 16),
(37, 17),
(38, 18),
(39, 19),
(41, 20),
(42, 20),
(43, 20),
(44, 20),
(45, 20),
(46, 21),
(47, 21),
(48, 21),
(49, 21),
(50, 22),
(51, 22),
(52, 23),
(53, 24),
(55, 24),
(56, 24),
(57, 24),
(54, 25),
(64, 25),
(58, 26),
(63, 26),
(59, 27),
(60, 27),
(62, 27),
(61, 28),
(65, 29);

-- --------------------------------------------------------

--
-- Structure de la table `realisateur`
--

DROP TABLE IF EXISTS `realisateur`;
CREATE TABLE IF NOT EXISTS `realisateur` (
  `id_real` int NOT NULL AUTO_INCREMENT,
  `nom_real` text NOT NULL,
  `photo_real` text NOT NULL,
  PRIMARY KEY (`id_real`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `realisateur`
--

INSERT INTO `realisateur` (`id_real`, `nom_real`, `photo_real`) VALUES
(1, 'Vince Gilligan', 'https://m.media-amazon.com/images/M/MV5BNTUyNzUxOTAxMV5BMl5BanBnXkFtZTcwNzk0MDM0Nw@@._V1_.jpg'),
(2, 'Adam Bernstein', 'https://images.mubicdn.net/images/cast_member/6868/cache-129144-1455132428/image-w856.jpg'),
(3, 'Bryan Cranston', 'https://m.media-amazon.com/images/M/MV5BMTA2NjEyMTY4MTVeQTJeQWpwZ15BbWU3MDQ5NDAzNDc@._V1_.jpg\n'),
(4, 'Charles Haid', 'https://m.media-amazon.com/images/M/MV5BOTJmOTViZGItZDA3OC00YjhlLTliOWMtN2YwNzY3ZTc2ZDFhXkEyXkFqcGc@._V1_.jpg'),
(5, 'Michelle MacLaren', 'https://static.wikia.nocookie.net/westworld/images/2/2a/Michelle_MacLaren.jpg/revision/latest?cb=20170403165438&path-prefix=fr'),
(6, 'Michael Slovis', 'https://m.media-amazon.com/images/M/MV5BNTdiNDM2OWMtZmRlMy00OTFmLWFiYzctYmQ4MDY3Nzc0YTRhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(7, 'Nick Murphy', 'https://m.media-amazon.com/images/M/MV5BNTIyMDEwMmUtNjcyNi00OTM1LWFhN2UtZWIwOWIzZjIxMGY2XkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(8, 'Peter Hoar', 'https://static.wikia.nocookie.net/marvelcinematicuniverse/images/2/29/Peter_Hoar.jpg/revision/latest?cb=20190922183032'),
(9, 'Erik Leijonborg', 'https://fr.web.img6.acsta.net/pictures/20/02/13/14/52/5413722.jpg'),
(10, 'Ed Bazalgette', 'https://static.wikia.nocookie.net/the-last-kingdom/images/4/46/Ed_Bazalgette.PNG/revision/latest?cb=20200629203620'),
(11, 'Andy Hay', 'https://m.media-amazon.com/images/M/MV5BMDBmMWRmOGEtY2Q0MS00M2VmLWJjN2EtOThiZWE5ZDY4OGZiXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(12, 'Matt Duffer', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSIR2iY0U0XeypMY9_xQnoQAfYMiAFZ0kW1zQ&s'),
(13, 'Ross Duffer', 'https://m.media-amazon.com/images/M/MV5BMDk1MGQ1YzQtMTg3Yi00MDcxLWJhNzUtZGQzNmU4MDhhMjRhXkEyXkFqcGc@._V1_.jpg'),
(14, 'Thomas Schnauz', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQUzacckJlN8MDC5pIdeccaE1MPTjaYbapTuw&s'),
(15, 'Terry McDonough', 'https://cdn1.cinenode.com/author_picture/134/terry-mcdonough-134478-250-400.jpg'),
(16, 'Minkie Spiro', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQgWI8aobwGErG6MHeAIrtTWB3P5J9LRo3Weg&s'),
(17, 'Brown Hughes', 'https://cdn.tv-programme.com/photos/bronwen-hughes-people-0-7182-1200.webp'),
(18, 'Norberto Barba', 'https://upload.wikimedia.org/wikipedia/commons/8/81/Norberto_Barba_by_Gage_Skidmore.jpg'),
(19, 'Michael Morris', 'https://fr.web.img3.acsta.net/img/22/87/22872390e84c9e6eea566084bb4abfb5.jpg'),
(20, 'Johan Renck', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRTjExr-BA5oMHkZeJ07eaBFHXyzFTEzIV97Q&s'),
(21, 'Hwang Dong-hyeok', 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f7/20140114_Hwang_Dong-hyuk.jpg/500px-20140114_Hwang_Dong-hyuk.jpg'),
(22, 'Michael Cuesta', 'https://m.media-amazon.com/images/M/MV5BMTU1OTc4Nzc0NF5BMl5BanBnXkFtZTcwMTU0NTA1OA@@._V1_.jpg'),
(23, 'Tony Goldwyn', 'https://m.media-amazon.com/images/M/MV5BMTk3NTI3ODgwM15BMl5BanBnXkFtZTgwMjM2NTE2NzE@._V1_FMjpg_UX1000_.jpg'),
(24, 'Marcos Siega', 'https://upload.wikimedia.org/wikipedia/commons/thumb/e/e1/Marcos_Siega_%2814617470159%29_%28cropped%29.jpg/960px-Marcos_Siega_%2814617470159%29_%28cropped%29.jpg'),
(25, 'Keith Gordon', 'https://cdn.tv-programme.com/photos/keith-gordon-people-1-13357-1200.webp'),
(26, 'Steve Shill', 'https://m.media-amazon.com/images/M/MV5BMjE1ODk4NDI2NF5BMl5BanBnXkFtZTcwNTA0Mjk3Mw@@._V1_.jpg'),
(27, 'John Dahl', 'https://m.media-amazon.com/images/M/MV5BMTg4OTE2MzQ5MV5BMl5BanBnXkFtZTYwNTg0MTQ1._V1_FMjpg_UX1000_.jpg'),
(28, 'SJ Clarkson', 'https://m.media-amazon.com/images/M/MV5BZTJkOGI1YzctOGNjNy00YjI5LWE3NjgtMjliN2JlOGZiYTlhXkEyXkFqcGc@._V1_FMjpg_UX1000_.jpg'),
(29, 'Michael C. Hall', 'https://fr.web.img3.acsta.net/pictures/18/05/25/16/54/2970400.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `saison`
--

DROP TABLE IF EXISTS `saison`;
CREATE TABLE IF NOT EXISTS `saison` (
  `id_saison` int NOT NULL AUTO_INCREMENT,
  `titre_saison` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `numero_saison` int NOT NULL,
  `affiche_saison` text NOT NULL,
  `id_serie` int NOT NULL,
  PRIMARY KEY (`id_saison`),
  KEY `serie_fk_saison` (`id_serie`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `saison`
--

INSERT INTO `saison` (`id_saison`, `titre_saison`, `numero_saison`, `affiche_saison`, `id_serie`) VALUES
(1, 'Saison 1', 1, 'https://fr.web.img2.acsta.net/pictures/18/07/23/11/26/1237965.jpg', 1),
(2, 'Saison 2', 2, 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQH9-0Nd3FZ1adSpF92pfcfnaNZB_QPMoQJJA&s', 1),
(3, 'Saison 3', 3, 'https://fr.web.img4.acsta.net/pictures/18/07/23/11/26/2167658.jpg', 1),
(4, 'Saison 4', 4, 'https://fr.web.img3.acsta.net/c_310_420/pictures/19/06/18/12/11/3956503.jpg', 1),
(5, 'Saison 5', 5, 'https://fr.web.img2.acsta.net/pictures/18/07/23/11/26/3445791.jpg', 1),
(6, 'Saison 1', 1, 'https://fr.web.img5.acsta.net/pictures/18/11/08/16/17/0749526.jpg', 2),
(7, 'Saison 2', 2, 'https://fr.web.img6.acsta.net/pictures/18/11/08/16/17/1194841.jpg', 2),
(8, 'Saison 3', 3, 'https://fr.web.img4.acsta.net/pictures/19/01/10/05/52/4604925.jpg', 2),
(9, 'Saison 4', 4, 'https://m.media-amazon.com/images/I/81W6lHMWJYL._AC_UF1000,1000_QL80_.jpg', 2),
(10, 'Saison 5', 5, 'https://fr.web.img3.acsta.net/pictures/22/02/10/12/54/0686446.jpg', 2),
(11, 'Saison 1', 1, 'https://fr.web.img5.acsta.net/pictures/17/08/31/23/41/560893.jpg', 3),
(12, 'Saison 2', 2, 'https://m.media-amazon.com/images/I/61J4i7njqBL.jpg', 3),
(13, 'Saison 3', 3, 'https://m.media-amazon.com/images/I/71ReBq5rq6L.jpg', 3),
(14, 'Saison 4', 4, 'https://i.ebayimg.com/00/s/MTYwMFgxMDgw/z/k3IAAOSwwlNilM3t/$_57.JPG?set_id=880000500F', 3),
(15, 'Saison 1', 1, 'https://upload.wikimedia.org/wikipedia/en/1/1c/Better_Call_Saul_season_1.jpg', 4),
(16, 'Saison 2', 2, 'https://fr.web.img5.acsta.net/pictures/16/01/05/11/51/278230.jpg', 4),
(17, 'Saison 3', 3, 'https://i.redd.it/exqb5d8meb7a1.jpg', 4),
(18, 'Saison 4', 4, 'https://fr.web.img6.acsta.net/pictures/18/07/02/14/12/3309351.jpg', 4),
(19, 'Saison 5', 5, 'https://fr.web.img6.acsta.net/pictures/20/01/10/10/29/2311348.jpg', 4),
(20, 'Saison 6', 6, 'https://www.benzinemag.net/wp-content/uploads/2022/08/Better-Call-Saul-S6-affiche.jpg', 4),
(22, 'Saison 1', 1, 'https://fr.web.img4.acsta.net/pictures/23/01/03/14/05/3165194.jpg', 5),
(23, 'Saison 1', 1, 'https://fr.web.img6.acsta.net/pictures/21/09/14/10/18/1090569.jpg', 6),
(24, 'Saison 2', 2, 'https://fr.web.img3.acsta.net/img/b4/6d/b46d660ec6b885e4b322f96e378781de.jpg', 6),
(25, 'Première saison', 1, 'https://fr.web.img5.acsta.net/pictures/210/481/21048151_20131010001105699.jpg', 7),
(26, 'Deuxième saison', 2, 'https://fr.web.img6.acsta.net/pictures/210/485/21048577_20131010205021954.jpg', 7),
(27, 'Troisième saison', 3, 'https://fr.web.img3.acsta.net/pictures/210/485/21048591_20131010233819786.jpg', 7),
(28, 'Quatrième saison', 4, 'https://fr.web.img3.acsta.net/r_1280_720/pictures/18/10/31/14/58/0260356.jpg', 7),
(29, 'Cinquième saison', 5, 'https://fr.web.img3.acsta.net/r_1280_720/pictures/210/489/21048933_20131011194636374.jpg', 7),
(30, 'Sixième saison', 6, 'https://fr.web.img4.acsta.net/pictures/210/489/21048935_20131011201954176.jpg', 7),
(31, 'Septième saison', 7, 'https://fr.web.img2.acsta.net/pictures/210/489/21048948_20131011212508917.jpg', 7),
(32, 'Huitième saison', 8, 'https://fr.web.img5.acsta.net/pictures/210/489/21048952_20131011215818987.jpg', 7);

-- --------------------------------------------------------

--
-- Structure de la table `saison_acteur`
--

DROP TABLE IF EXISTS `saison_acteur`;
CREATE TABLE IF NOT EXISTS `saison_acteur` (
  `id_saison` int NOT NULL,
  `id_acteur` int NOT NULL,
  PRIMARY KEY (`id_saison`,`id_acteur`),
  KEY `acteur_fk_saison` (`id_acteur`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `saison_acteur`
--

INSERT INTO `saison_acteur` (`id_saison`, `id_acteur`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(1, 2),
(2, 2),
(3, 2),
(4, 2),
(5, 2),
(1, 3),
(2, 3),
(3, 3),
(4, 3),
(5, 3),
(1, 4),
(2, 4),
(3, 4),
(4, 4),
(5, 4),
(6, 5),
(7, 5),
(8, 5),
(9, 5),
(10, 5),
(6, 6),
(7, 6),
(8, 6),
(9, 6),
(10, 6),
(6, 7),
(7, 7),
(8, 7),
(9, 7),
(10, 7),
(11, 8),
(12, 8),
(13, 8),
(14, 8),
(11, 9),
(12, 9),
(13, 9),
(14, 9),
(11, 10),
(12, 10),
(13, 10),
(14, 10),
(15, 11),
(16, 11),
(17, 11),
(18, 11),
(19, 11),
(20, 11),
(15, 12),
(16, 12),
(17, 12),
(18, 12),
(19, 12),
(20, 12),
(15, 13),
(16, 13),
(17, 13),
(18, 13),
(19, 13),
(20, 13),
(22, 14),
(22, 15),
(22, 16),
(22, 17),
(23, 18),
(24, 18),
(23, 19),
(23, 20),
(24, 21),
(24, 22),
(25, 23),
(26, 23),
(27, 23),
(28, 23),
(29, 23),
(30, 23),
(31, 23),
(32, 23),
(25, 24),
(26, 24),
(27, 24),
(28, 24),
(29, 24),
(30, 24),
(31, 24),
(32, 24),
(25, 25),
(26, 25),
(27, 25),
(28, 25),
(29, 25),
(30, 25),
(31, 25),
(32, 25);

-- --------------------------------------------------------

--
-- Structure de la table `saison_episode`
--

DROP TABLE IF EXISTS `saison_episode`;
CREATE TABLE IF NOT EXISTS `saison_episode` (
  `id_saison` int NOT NULL,
  `id_episode` int NOT NULL,
  PRIMARY KEY (`id_saison`,`id_episode`),
  KEY `episode_fk_saison` (`id_episode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `saison_episode`
--

INSERT INTO `saison_episode` (`id_saison`, `id_episode`) VALUES
(1, 1),
(1, 2),
(2, 3),
(2, 4),
(3, 5),
(3, 6),
(4, 7),
(4, 8),
(5, 9),
(5, 10),
(6, 11),
(6, 12),
(7, 13),
(7, 14),
(8, 15),
(8, 16),
(9, 17),
(9, 18),
(10, 19),
(10, 20),
(11, 21),
(11, 22),
(12, 23),
(12, 24),
(13, 25),
(13, 26),
(14, 27),
(14, 28),
(15, 29),
(15, 30),
(16, 31),
(16, 32),
(17, 33),
(17, 34),
(18, 35),
(18, 36),
(19, 37),
(19, 38),
(20, 39),
(20, 40),
(22, 41),
(22, 42),
(22, 43),
(22, 44),
(22, 45),
(23, 46),
(23, 47),
(24, 48),
(24, 49),
(25, 50),
(25, 51),
(26, 52),
(26, 53),
(27, 54),
(27, 55),
(28, 56),
(28, 57),
(29, 58),
(29, 59),
(30, 60),
(30, 61),
(31, 62),
(31, 63),
(32, 64),
(32, 65);

-- --------------------------------------------------------

--
-- Structure de la table `serie`
--

DROP TABLE IF EXISTS `serie`;
CREATE TABLE IF NOT EXISTS `serie` (
  `id_serie` int NOT NULL AUTO_INCREMENT,
  `titre_serie` text NOT NULL,
  `synopsis_serie` text NOT NULL,
  `affiche_serie` text NOT NULL,
  PRIMARY KEY (`id_serie`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `serie`
--

INSERT INTO `serie` (`id_serie`, `titre_serie`, `synopsis_serie`, `affiche_serie`) VALUES
(1, 'Breaking Bad', 'Walter White, 50 ans, est professeur de chimie dans un lycée du Nouveau-Mexique. Pour subvenir aux besoins de Skyler, sa femme enceinte, et de Walt Junior, son fils handicapé, il est obligé de travailler doublement. Son quotidien déjà morose devient carrément noir lorsqu\'il apprend qu\'il est atteint d\'un incurable cancer des poumons. Les médecins ne lui donnent pas plus de deux ans à vivre. Pour réunir rapidement beaucoup d\'argent afin de mettre sa famille à l\'abri, Walter ne voit plus qu\'une solution : mettre ses connaissances en chimie à profit pour fabriquer et vendre du crystal meth, une drogue de synthèse qui rapporte beaucoup. Il propose à Jesse, un de ses anciens élèves devenu un petit dealer de seconde zone, de faire équipe avec lui. Le duo improvisé met en place un labo itinérant dans un vieux camping-car. Cette association inattendue va les entraîner dans une série de péripéties tant comiques que pathétiques.', 'https://fr.web.img5.acsta.net/pictures/19/06/18/12/11/3956503.jpg'),
(2, 'The Last Kingdom', 'En Angleterre, au IXème siècle, Uhtred, le fils d\'un noble, kidnappé par les Vikings lorsqu\'il était enfant, doit choisir entre son pays natal et le peuple qui l\'a élevé.', 'https://fr.web.img6.acsta.net/pictures/15/07/23/12/02/293866.jpg'),
(3, 'Stranger Things ', 'Un soir de novembre 1983 dans la ville américaine fictive d\'Hawkins en Indiana, le jeune Will Byers, âgé de douze ans, disparaît brusquement sans laisser de traces, hormis son vélo. Plusieurs personnages vont alors tenter de le retrouver : sa mère Joyce, ses amis : Lucas Sinclair, Dustin Henderson et Mike Wheeler, guidés par la mystérieuse Eleven, une jeune fille ayant des pouvoirs psychiques, ainsi que le chef de la police Jim Hopper.', 'https://fr.web.img5.acsta.net/pictures/17/08/31/23/41/560893.jpg'),
(4, 'Better Call Saul', 'Six ans avant de croiser le chemin de Walter White et de Jesse Pinkman, James McGill, dit « Jimmy », est un avocat qui peine à faire décoller sa carrière, à Albuquerque, au Nouveau-Mexique. Devenu avocat sous l\'influence de son frère Charles McGill, dit « Chuck », lui-même avocat renommé et partenaire cofondateur du cabinet Hamlin, Hamlin et McGill au côté de Howard Hamlin , Jimmy tente de lui prouver sa valeur ainsi qu\'auprès de Kim Wexler , sa compagne qu\'il a rencontrée du temps où il travaillait au service du courrier de HHM.', 'https://fr.web.img4.acsta.net/pictures/15/12/17/16/57/343857.jpg'),
(5, 'Chernobyl', 'Le 26 avril 1986, une explosion secoue la centrale nucléaire soviétique Lénine et réveille la ville de Prypiat. Tant à l\'intérieur qu\'à l\'extérieur de la centrale, scientifiques, ingénieurs et habitants n\'ont aucune idée du drame qui se joue.', 'https://m.media-amazon.com/images/M/MV5BNzU0OTI4YTQtNGQ1ZS00ZjA4LTg3MTMtZjkyZWNjN2RiZDJmXkEyXkFqcGc@._V1_.jpg'),
(6, 'Squid Game', '456 personnes, qui ont toutes des difficultés financières, sont invitées à prendre part à une mystérieuse compétition de survie qu\'elles ne peuvent pas quitter d\'elles-mêmes, dans des locaux situés sur une île dont l\'emplacement est tenu secret. Participant à une série de jeux à première vue enfantins, elles risquent leur vie pour gagner jusqu\'à 45,6 milliards de wons.', 'https://images-cdn.ubuy.co.in/64271944a0278c4d900691f8-cinemaflix-squid-game-poster-tv-series.jpg'),
(7, 'Dexter', 'Brillant expert scientifique du service médico-légal de la police de Miami, Dexter Morgan est spécialisé dans l\'analyse de prélèvements sanguins. Mais voilà, Dexter cache un terrible secret : il est également tueur en série. Un serial killer pas comme les autres, avec sa propre vision de la justice.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRT2RdgdCrJN2oUBFXthmt1zESNftd4RV1TQw&s'),
(8, 'Prison Break', 'Lincoln Burrows, un petit truand, est accusé à tort d\'avoir tué le frère de la vice-présidente des États-Unis. Condamné à mort, il est incarcéré dans le pénitencier d\'État de Fox River, dans l\'attente de son exécution. Son frère, Michael Scofield, un ingénieur surdoué convaincu de son innocence, l\'aide à s\'évader avant la date fatidique. Pour cela, Michael se fait tatouer les plans de la prison sur le torse, les bras et le dos, puis il commet un braquage afin d\'y être incarcéré à son tour. Une fois emprisonné à Fox River, Michael cherche à s\'évader en compagnie de son frère, à l\'aide des plans dessinés sur son corps.', 'https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQA7Rmn7ggeZGaPRiCsxG5Ol35ZbMKXFInZtQ&s');

-- --------------------------------------------------------

--
-- Structure de la table `serie_tag`
--

DROP TABLE IF EXISTS `serie_tag`;
CREATE TABLE IF NOT EXISTS `serie_tag` (
  `id_serie` int NOT NULL,
  `id_tag` int NOT NULL,
  PRIMARY KEY (`id_serie`,`id_tag`),
  KEY `tag_fk_serie` (`id_tag`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `serie_tag`
--

INSERT INTO `serie_tag` (`id_serie`, `id_tag`) VALUES
(1, 1),
(4, 1),
(6, 1),
(7, 1),
(2, 2),
(5, 2),
(3, 3),
(6, 4),
(7, 4);

-- --------------------------------------------------------

--
-- Structure de la table `tag`
--

DROP TABLE IF EXISTS `tag`;
CREATE TABLE IF NOT EXISTS `tag` (
  `id_tag` int NOT NULL AUTO_INCREMENT,
  `nom_tag` text NOT NULL,
  PRIMARY KEY (`id_tag`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tag`
--

INSERT INTO `tag` (`id_tag`, `nom_tag`) VALUES
(1, 'Drame'),
(2, 'Historique'),
(3, 'Science-fiction'),
(4, 'Thriller');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `episode_realisateur`
--
ALTER TABLE `episode_realisateur`
  ADD CONSTRAINT `episode_fk_real` FOREIGN KEY (`id_episode`) REFERENCES `episode` (`id_episode`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `real_fk_episode` FOREIGN KEY (`id_real`) REFERENCES `realisateur` (`id_real`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `saison`
--
ALTER TABLE `saison`
  ADD CONSTRAINT `serie_fk_saison` FOREIGN KEY (`id_serie`) REFERENCES `serie` (`id_serie`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `saison_acteur`
--
ALTER TABLE `saison_acteur`
  ADD CONSTRAINT `acteur_fk_saison` FOREIGN KEY (`id_acteur`) REFERENCES `acteur` (`id_acteur`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `saison_fk_acteur` FOREIGN KEY (`id_saison`) REFERENCES `saison` (`id_saison`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `saison_episode`
--
ALTER TABLE `saison_episode`
  ADD CONSTRAINT `episode_fk_saison` FOREIGN KEY (`id_episode`) REFERENCES `episode` (`id_episode`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `saison_fk_episode` FOREIGN KEY (`id_saison`) REFERENCES `saison` (`id_saison`) ON DELETE CASCADE ON UPDATE RESTRICT;

--
-- Contraintes pour la table `serie_tag`
--
ALTER TABLE `serie_tag`
  ADD CONSTRAINT `serie_fk_tag` FOREIGN KEY (`id_serie`) REFERENCES `serie` (`id_serie`) ON DELETE CASCADE ON UPDATE RESTRICT,
  ADD CONSTRAINT `tag_fk_serie` FOREIGN KEY (`id_tag`) REFERENCES `tag` (`id_tag`) ON DELETE CASCADE ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
