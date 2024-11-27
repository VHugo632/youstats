-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 05 avr. 2024 à 00:10
-- Version du serveur : 10.4.32-MariaDB
-- Version de PHP : 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bdd_youtube`
--

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

CREATE TABLE `categorie` (
  `id_categorie` int(11) NOT NULL,
  `intitule` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `icone` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`id_categorie`, `intitule`, `description`, `icone`) VALUES
(1, 'Tendances', 'Dans cette catégorie, suivez les contenus les plus populaires de YouTube. Découvrez les derniers clips musicaux, bandes-annonces, extraits de comédies et autres vidéos que les internautes regardent en ce moment.', 'https://www.youtube.com/img/trending/avatar/trending.png'),
(2, 'Musique', 'Cette catégorie expose des vidéos musicales, des performances live, des documentaires musicaux et du contenu lié à la musique d\'artistes populaires et de musiciens émergents.', 'https://yt3.googleusercontent.com/vCqmJ7cdUYpvR0bqLpWIe8ktaor4QafQLlfQyTuZy-M9W_YafT8Wo9kdsKL2St1BrkMRpVSJgA=s176-c-k-c0x00ffffff-no-rj-mo'),
(3, 'Films et séries TV', 'Cette catégorie présente des interviews de célébrités, des critiques de films et d\'émissions de télévision, ainsi que d\'autres contenus liés au divertissement rédigés par des initiés et des passionnés de l\'industrie.', 'https://www.gstatic.com/youtube/img/tvfilm/clapperboard_profile.png'),
(4, 'Jeux vidéo', 'Cette catégorie contient des vidéos de gameplay, des astuces, des critiques et d\'autres contenus liés aux jeux vidéo provenant de joueurs passionnés.', 'https://yt3.googleusercontent.com/pzvUHajbQDLDt63gKFYUX445k3VprUs8CeJFpNTxGQZlk0grOSkAqU8Th1_C97dyYM3nENgjbw=s120-c-k-c0x00ffffff-no-rj'),
(5, 'Sport', 'Cette catégorie détient des faits saillants, des analyses et des commentaires sur les événements sportifs et les athlètes, ainsi que des vidéos d\'entraînement et de fitness.', 'https://yt3.googleusercontent.com/mUhuJiCiL8jf0Ngf9sh7BFBZCO0MUL2JyH_5ElHbV2fd13hxZ9zQ3-x-YePA_-PCUUH360G0=s176-c-k-c0x00ffffff-no-rj-mo'),
(6, 'Savoirs et cultures', 'Cette catégorie possède du contenu éducatif sur un large éventail de sujets, allant de la science à de l\'histoire sous forme de nombreux formats.', 'https://yt3.googleusercontent.com/WqGyfnVyCluIyyFDPdrHzqEfKQcTbtwhIJJ4Q_F3QGMqnYNs8aKswvDhzpY1q8vhS5g8Expi=s120-c-k-c0x00ffffff-no-rj'),
(7, 'Mode et beauté', 'Cette catégorie dispose de tutoriels de maquillage, des critiques de produits de beauté, des articles de mode et d\'autres contenus liés à la beauté et à la mode rédigés par des influenceurs du milieu.', 'https://yt3.googleusercontent.com/d4wezWM9Sz96jsJXsGhZqVAnyl9HPgobo3Q2u75zU_pGBZHfgsAMoAv7cdEchj_9OpzpsQ70YQ=s120-c-k-c0x00ffffff-no-rj'),
(8, 'Podcasts', 'Cette catégorie couvre une infinité de sujets, généralement en petit comité et dans une ambiance relaxante.', 'https://www.youtube.com/img/podcasts/avatar/avatar_color_v3_circle_100x100.png');

-- --------------------------------------------------------

--
-- Structure de la table `invitation`
--

CREATE TABLE `invitation` (
  `id_video` int(11) NOT NULL,
  `id_invite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `invitation`
--

INSERT INTO `invitation` (`id_video`, `id_invite`) VALUES
(1, 1),
(1, 2),
(5, 3),
(18, 4),
(25, 5),
(25, 6),
(25, 7),
(25, 19),
(26, 7),
(26, 8),
(26, 9),
(32, 10),
(43, 11),
(43, 12),
(44, 18),
(45, 8),
(48, 14),
(52, 15),
(52, 16),
(52, 17),
(53, 15),
(54, 15),
(54, 16),
(54, 17);

-- --------------------------------------------------------

--
-- Structure de la table `invite`
--

CREATE TABLE `invite` (
  `id_invite` int(11) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `invite`
--

INSERT INTO `invite` (`id_invite`, `nom`, `prenom`) VALUES
(1, 'Cotillard', 'Marion'),
(2, 'Cottin', 'Camille'),
(3, 'Bardakoff', 'Julien'),
(4, 'Code', 'Benjamin'),
(5, 'Becker', 'Théo'),
(6, 'Jonckheere', 'Mathieu'),
(7, 'Molas', 'Frédéric'),
(8, 'Levisse', 'Théodort'),
(9, 'Odzierejko', 'Nathalie'),
(10, 'Benazzouz', 'Inès'),
(11, 'Ordonez', 'Florian'),
(12, 'Ordonez', 'Olivio'),
(14, 'Hauchard', 'Lucas'),
(15, 'Deseur', 'Thomas'),
(16, 'Jouneau', 'Étienne'),
(17, 'Casta', 'Yvan'),
(18, 'Rondelli', 'Jordan'),
(19, 'Carlier', 'Raphaël');

-- --------------------------------------------------------

--
-- Structure de la table `video`
--

CREATE TABLE `video` (
  `id_video` int(11) NOT NULL,
  `titre` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `nb_vues` int(11) NOT NULL,
  `nb_likes` int(11) NOT NULL,
  `nb_commentaires` int(11) NOT NULL,
  `date_publication` date NOT NULL,
  `duree` int(11) NOT NULL,
  `qualite_max` varchar(8) NOT NULL,
  `url` text NOT NULL,
  `miniature` text NOT NULL,
  `id_youtubeur` int(11) NOT NULL,
  `id_categorie` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `video`
--

INSERT INTO `video` (`id_video`, `titre`, `description`, `nb_vues`, `nb_likes`, `nb_commentaires`, `date_publication`, `duree`, `qualite_max`, `url`, `miniature`, `id_youtubeur`, `id_categorie`) VALUES
(1, 'QUI EST L\'IMPOSTEUR ? (ft Marion Cotillard & Camille Cottin)', 'Vous ne devinerez jamais ce qui est arrivé à Camille...', 11025612, 506000, 8702, '2023-11-15', 53, '2160p 4K', 'https://youtu.be/xG-Ef4ig07I', 'https://img.youtube.com/vi/xG-Ef4ig07I/maxresdefault.jpg', 1, 1),
(2, 'L\'histoire du projet le plus fou de ma vie', 'On a pris notre temps mais voici enfin l\'histoire du GP Explorer !', 9050373, 674000, 17194, '2022-11-13', 50, '2160p 4K', 'https://youtu.be/CmgyUYCibwA', 'https://img.youtube.com/vi/CmgyUYCibwA/maxresdefault.jpg', 1, 5),
(3, 'ma nouvelle vie commence maintenant', 'obligé de vous parler de l\'endroit où je passe mon confinement virtuel', 10667570, 538000, 22604, '2020-04-03', 13, '1080p HD', 'https://youtu.be/RlqOX0kK5G0', 'https://img.youtube.com/vi/RlqOX0kK5G0/maxresdefault.jpg', 1, 4),
(4, 'La suite PERDUE de MARIO 64 (Super Mario 128)', NULL, 324919, 18000, 869, '2022-12-22', 21, '1080p HD', 'https://youtu.be/ow5mptC5knk', 'https://img.youtube.com/vi/ow5mptC5knk/maxresdefault.jpg', 2, 4),
(5, 'Le SECRET des noms FRANÇAIS des POKÉMON - Interview Julien Bardakoff', NULL, 462191, 25000, 1771, '2022-11-12', 117, '1080p HD', 'https://youtu.be/MBCCTJ6Z4GI', 'https://img.youtube.com/vi/MBCCTJ6Z4GI/maxresdefault.jpg', 2, 4),
(6, 'MA COLLECTION DE MANGA', 'Présentation complète des mangas de ma mangathèque !', 756655, 37000, 4867, '2020-12-19', 72, '1080p HD', 'https://youtu.be/5LqLeMbp5Sc', 'https://img.youtube.com/vi/5LqLeMbp5Sc/maxresdefault.jpg', 2, 6),
(7, 'Le pire abonné que j\'ai rencontré...', 'Aujourd\'hui, je vais vous raconter mes pires rencontres avec mes abonnés...', 283503, 27000, 1100, '2024-01-18', 20, '1080p HD', 'https://youtu.be/huEH3hH8duE', 'https://img.youtube.com/vi/huEH3hH8duE/maxresdefault.jpg', 3, 1),
(8, 'J\'ai testé TOUS les secrets cachés de Google...', 'Et vous, vous les connaissiez tous ?', 398953, 32000, 968, '2024-01-09', 16, '1080p HD', 'https://youtu.be/gOPZj2EpsvA', 'https://img.youtube.com/vi/gOPZj2EpsvA/maxresdefault.jpg', 3, 6),
(9, 'J\'ai recréé Minecraft en 2D...', '', 356766, 29000, 1182, '2023-10-01', 9, '1080p HD', 'https://youtu.be/zQtiQiiReKQ', 'https://img.youtube.com/vi/zQtiQiiReKQ/maxresdefault.jpg', 3, 4),
(10, 'Quel pays code le mieux avec 100€ ?', NULL, 49290, 2200, 202, '2023-07-18', 18, '2160p 4K', 'https://youtu.be/s8lIDkjqt_s', 'https://img.youtube.com/vi/s8lIDkjqt_s/maxresdefault.jpg', 4, 6),
(11, 'Le projet web le plus abouti de ma carrière (mon SaaS)', NULL, 41863, 3600, 462, '2024-02-12', 16, '2160p 4K', 'https://youtu.be/VKQB4asVRw4', 'https://img.youtube.com/vi/VKQB4asVRw4/maxresdefault.jpg', 4, 6),
(12, 'J’ai codé le dark mode de mon décor avec JavaScript', NULL, 55278, 2300, 78, '2023-06-18', 13, '2160p 4K', 'https://youtu.be/eOiAYzs1TOw', 'https://img.youtube.com/vi/eOiAYzs1TOw/maxresdefault.jpg', 4, 1),
(13, 'La Fin du Wiki Minecraft Fandom (Et c\'est Bien)', 'Mojang a lancé un nouveau Wiki Minecraft officiel pour remplacé celui de fandom, est c\'est une chose !', 39408, 2900, 93, '2023-12-14', 5, '1080p HD', 'https://youtu.be/WXNY19I0vLY', 'https://img.youtube.com/vi/WXNY19I0vLY/maxresdefault.jpg', 5, 4),
(14, 'Les 3 Nouveaux MOB Minecraft et Snapshot 23w40a !', 'Nous savons le 3 mob du vote de mob 2023 de Minecraft ! Lequel allez vous choisir ?', 39794, 3400, 418, '2023-10-06', 4, '1080p HD', 'https://youtu.be/5TAqdhVXbfk', 'https://img.youtube.com/vi/5TAqdhVXbfk/maxresdefault.jpg', 5, 4),
(15, 'Minecraft 1.20 - La Trails & Tales Update : Résumé FR !', 'Résumé de minecraft 1.20 la cave and clif update partie 4... euh je veux dire la trails and tales update !', 127767, 6100, 308, '2023-06-07', 35, '1440p HD', 'https://youtu.be/uAAaUQc3tBk', 'https://img.youtube.com/vi/uAAaUQc3tBk/maxresdefault.jpg', 5, 4),
(16, 'YouTube est en train de perdre la guerre la plus épique d’Internet', NULL, 1155036, 61000, 5407, '2024-01-31', 20, '1080p HD', 'https://youtu.be/KoRFf7zjmmc', 'https://img.youtube.com/vi/KoRFf7zjmmc/maxresdefault.jpg', 6, 1),
(17, 'J’ai retracé un compte insta grâce à la trigonométrie', NULL, 668836, 39000, 1125, '2021-11-08', 16, '1080p HD', 'https://youtu.be/udYtHVEwbYA', 'https://img.youtube.com/vi/udYtHVEwbYA/maxresdefault.jpg', 6, 6),
(18, 'Les développeurs doivent-ils avoir peur de GPT5 ?', NULL, 633842, 28000, 992, '2023-08-29', 26, '1080p HD', 'https://youtu.be/SyamXfBVjrM', 'https://img.youtube.com/vi/SyamXfBVjrM/maxresdefault.jpg', 6, 1),
(19, 'Les tendances Design pour réussir en 2024', NULL, 25024, 2100, 162, '2024-02-05', 12, '2160p 4K', 'https://youtu.be/QqvW6jlH8KA', 'https://img.youtube.com/vi/QqvW6jlH8KA/maxresdefault.jpg', 7, 1),
(20, 'Je crée un site web comme en 2003', 'Retour dans la passé sur mon ordinateur d\'il y a 20 ans !', 58443, 2900, 204, '2023-11-23', 17, '2160p 4K', 'https://youtu.be/82jTSkTMSOQ', 'https://img.youtube.com/vi/82jTSkTMSOQ/maxresdefault.jpg', 7, 6),
(21, 'J’améliore TWITCH en seulement 2H !', 'Je vous propose 3 redesigns de l\'application Twitch ! Quelle est votre version favorite ? Est-ce que l\'une d\'entre elles ressemblera à la future version de 2023 ?', 62141, 5800, 208, '2023-02-26', 12, '2160p 4K', 'https://youtu.be/CJmt0w8eoiw', 'https://img.youtube.com/vi/CJmt0w8eoiw/maxresdefault.jpg', 7, 1),
(22, 'Pourquoi la santé de Joe Biden inquiète', 'La santé de Joe Biden, 81 ans, inquiète de + en +, peut-il encore se présenter à la présidentielle de novembre ?', 298530, 9700, 1257, '2024-02-09', 12, '1080p HD', 'https://youtu.be/KoM4jcNikBw', 'https://img.youtube.com/vi/KoM4jcNikBw/maxresdefault.jpg', 8, 6),
(23, 'La sortie de l’Apple Vision Pro peut bouleverser notre vie', 'Le casque de réalité mixte Apple Vision Pro est sorti ce vendredi aux Etats-Unis, est-ce que c’est une révolution ?', 642735, 16000, 1206, '2024-02-05', 13, '1080p HD', 'https://youtu.be/N5ibQiGb8Rg', 'https://img.youtube.com/vi/N5ibQiGb8Rg/maxresdefault.jpg', 8, 6),
(24, 'L’alerte grand froid activée cette semaine en France', 'Les actus du jour, résumées et expliquées !', 262781, 10000, 1004, '2024-01-08', 10, '1080p HD', 'https://youtu.be/LBkPcLiw3CE', 'https://img.youtube.com/vi/LBkPcLiw3CE/maxresdefault.jpg', 8, 6),
(25, 'LE MASHUP DES JEUX VIDÉO', NULL, 4690967, 423000, 8685, '2023-07-18', 8, '2160p 4K', 'https://youtu.be/77NiHeEa5Gg', 'https://img.youtube.com/vi/77NiHeEa5Gg/maxresdefault.jpg', 9, 4),
(26, 'Le SAV d\'internet (TikTok, X...)', NULL, 5543708, 453000, 4998, '2023-03-03', 9, '2160p 4K', 'https://youtu.be/sEirqnPSyro', 'https://img.youtube.com/vi/sEirqnPSyro/maxresdefault.jpg', 9, 1),
(27, 'Le CLASH des animés', 'Et toi, c\'est quoi ton animé préféré ?', 4585841, 295000, 7107, '2023-04-14', 10, '2160p 4K', 'https://youtu.be/nwo6gnOBVt4', 'https://img.youtube.com/vi/nwo6gnOBVt4/maxresdefault.jpg', 9, 3),
(28, 'MA PROPRE MARQUE DE CLAVIER : TRYHARD !', 'Découvrez mon premier clavier mécanique disponible.', 546918, 45000, 2270, '2023-12-04', 15, '1080p HD', 'https://youtu.be/nBoTSiDQvAM', 'https://img.youtube.com/vi/nBoTSiDQvAM/maxresdefault.jpg', 10, 4),
(29, 'GTA 6 mais dans la VRAIE VIE !', 'Je passe 24h dans GTA VI à Miami (Vice City...) !', 374293, 23000, 502, '2024-01-23', 18, '1080p HD', 'https://youtu.be/dHl1AdEnWcA', 'https://img.youtube.com/vi/dHl1AdEnWcA/maxresdefault.jpg', 10, 4),
(30, '24H dans un train au cercle polaire arctique !', 'On traverse le nord du cercle polaire arctique en train !', 631056, 47000, 777, '2022-06-07', 13, '1080p HD', 'https://youtu.be/yMVQFn7n1dw', 'https://img.youtube.com/vi/yMVQFn7n1dw/maxresdefault.jpg', 10, 6),
(31, 'C\'est la fin... Et maintenant ?', NULL, 2140138, 176000, 2764, '2024-02-04', 10, '2160p 4K', 'https://youtu.be/rIDJne9hiuY', 'https://img.youtube.com/vi/rIDJne9hiuY/maxresdefault.jpg', 11, 1),
(32, '1 MINUTE POUR CONVAINCRE ! (Avec Inoxtag, Theobabac)', 'Il va falloir nous convaincre en 1min !', 3377481, 197000, 4230, '2023-09-03', 36, '2160p 4K', 'https://youtu.be/eW6wnyrLs_0', 'https://img.youtube.com/vi/eW6wnyrLs_0/maxresdefault.jpg', 11, 1),
(33, 'VOICI LE VRAI FUTUR ! (Et on le teste)', 'C\'est un des trucs que je trouve les plus fou dans ce qui devrait arriver dans le futur, parce que ça commence déjà, et que c\'est déjà trop fort.', 3727134, 255000, 3031, '2022-10-30', 16, '2160p 4K', 'https://youtu.be/vmJR4Lyk1Pg', 'https://img.youtube.com/vi/vmJR4Lyk1Pg/maxresdefault.jpg', 11, 1),
(34, 'NINTENDO SWITCH 2 : la DATE de SORTIE balancée par ERREUR ?! Euuuh on se calme, DÉCRYPTAGE', 'ALERTE RUMEUR : Quoi ?! La NINTENDO SWITCH 2 sortirait en septembre 2024 selon le communiqué d\'un constructeur lors du CES 2024 ?! Euuuuh attendez, on se calme : DÉCRYPTAGE', 34604, 2000, 86, '2024-01-12', 11, '1080p HD', 'https://youtu.be/PaR-dJL1owI', 'https://img.youtube.com/vi/PaR-dJL1owI/maxresdefault.jpg', 12, 4),
(35, 'CYBERPUNK 2 : premières infos, Unreal Engine 5, Vue, Ambitions & co - Jeux Vidéo Flash', 'C\'est officiel, la pré-production de la suite de Cyberpunk 2077 a débuté et plusieurs développeurs de CD Projekt commencent à parler de ce fameux projet ORION !', 36345, 2100, 118, '2024-01-10', 19, '1080p HD', 'https://youtu.be/1lMp5FDa19w', 'https://img.youtube.com/vi/1lMp5FDa19w/maxresdefault.jpg', 12, 4),
(36, 'GTA 6 tout est RÉEL - 15 SECRETS HALLUCINANTS cachés dans le TRAILER', 'Maintenant que le trailer de GTA 6 a été diffusé, je me suis amusé à le décrypter et je vous ai ramené 15 SECRETS et éléments qui vont vous faire HALLUCINER', 285460, 11000, 600, '2023-12-05', 21, '1080p HD', 'https://youtu.be/pCR-EdiiArg', 'https://img.youtube.com/vi/pCR-EdiiArg/maxresdefault.jpg', 12, 4),
(37, 'MÉTAMORPHOSE de mon PC!', 'Aujourd\'hui, je me lance dans l\'aventure d\'une double métamorphose de mes ordinateurs !', 24787, 2700, 155, '2024-02-08', 20, '1440p HD', 'https://youtu.be/lA-P3gozFNo', 'https://img.youtube.com/vi/lA-P3gozFNo/maxresdefault.jpg', 13, 4),
(38, 'Qu\'est-ce qu\'il IA au-delà des pochettes d\'album?', 'Dans cette vidéo, je prends le trend du moment avec l\'IA qui permet de \'dézoomer\' sur les photos pour voir ce qui se cache autour d\'elles ! Parfois les résultats sont surprenants, parfois ça fait peur !', 58789, 3000, 163, '2024-01-04', 15, '1440p HD', 'https://youtu.be/_Pyk4RJiMqI', 'https://img.youtube.com/vi/_Pyk4RJiMqI/maxresdefault.jpg', 13, 1),
(39, 'J\'essaie un simulateur pro de karting FOU !', 'Parro Info fabrique des simulateurs professionnels uniques à leur manière, et aujourd\'hui, j\'ai eu la chance d\'en tester un pour réaliser une vidéo pour vous !', 45831, 2600, 142, '2023-08-18', 22, '1440p HD', 'https://youtu.be/fzLYi1TVKGQ', 'https://img.youtube.com/vi/fzLYi1TVKGQ/maxresdefault.jpg', 13, 5),
(40, '7 Jours pour survivre Seul sur une Île Déserte !', 'La vidéo tant attendue est enfin là ! Je dois réussir le challenge de survivre 7 jours seul sur une île déserte à l’autre bout du monde sans aucune aide. Vais-je réussir ? Je vous laisse découvrir ça dans cette vidéo.', 19650662, 1100000, 46381, '2022-07-09', 81, '2160p 4K', 'https://youtu.be/P7vcGR8UjBY', 'https://img.youtube.com/vi/P7vcGR8UjBY/maxresdefault.jpg', 14, 6),
(41, 'J\'ai monté le Mont-Blanc (8 mois avant l\'ascension de l\'Everest) !', 'Il y a 5 mois encore, je ne connaissais rien à l\'alpinisme et je me suis lancé mon plus gros défi : arriver au sommet de la plus haute montagne du monde en 2024.', 6929567, 445000, 19015, '2023-08-05', 63, '2160p 4K', 'https://youtu.be/5L7M55xOLp8', 'https://img.youtube.com/vi/5L7M55xOLp8/maxresdefault.jpg', 14, 6),
(42, 'CUBE - Inoxtag (Feat. Flashboy)', 'Voilà la plus grosse vidéo de ma chaîne ! J’espère ça ne sera pas la dernière, c’est ce genre de chose qui me motive à me dépasser sur YouTube !', 4529471, 401000, 30590, '2021-07-17', 9, '2160p 4K', 'https://youtu.be/UiZH6oMlWd4', 'https://img.youtube.com/vi/UiZH6oMlWd4/maxresdefault.jpg', 14, 2),
(43, 'NUIT BLANCHE avec Bigflo et Oli : La célébrité', 'Nouvel épisode du format Nuit Blanche avec Bigflo et Oli, aujourd\'hui on parle de la célébrité !', 1787880, 131000, 3976, '2023-10-21', 53, '2160p 4K', 'https://youtu.be/_8tv9ykStM8', 'https://img.youtube.com/vi/_8tv9ykStM8/maxresdefault.jpg', 15, 8),
(44, 'PHOTO FAITE PAR UNE IA OU VRAIE PHOTO ? (Avec JOYCA)', 'Petit concept studio chill avec JOYCA, j\'espère que vous allez passer un bon moment et j\'vous souhaite à tous un bon week-end !', 4545955, 277000, 6104, '2023-05-20', 24, '2160p 4K', 'https://youtu.be/KAQlI52dYQE', 'https://img.youtube.com/vi/KAQlI52dYQE/maxresdefault.jpg', 15, 1),
(45, 'INTERROGATOIRE SOUS DÉTECTEUR DE MENSONGES (Avec Theodort)', 'On se pose des questions ULTRA GÊNANTES sous détecteur de mensonges avec Theodort !', 8777573, 673000, 4207, '2022-04-09', 19, '2160p 4K', 'https://youtu.be/Z93Khk6uhyw', 'https://img.youtube.com/vi/Z93Khk6uhyw/maxresdefault.jpg', 15, 1),
(46, 'L’HISTOIRE DES SIMPSON', 'Les origines et les secrets de la série Les Simpson. Les 34 ans d’histoire de Homer, Marge, Maggie, Lisa, Bart et de leur créateur : Matt Groening.', 1607958, 76000, 962, '2023-11-26', 41, '1080p HD', 'https://youtu.be/Im5WRM2lP5Q', 'https://img.youtube.com/vi/Im5WRM2lP5Q/maxresdefault.jpg', 16, 3),
(47, 'ONE PIECE : LES DÉTAILS CACHÉS DE LA SÉRIE (ce que vous n\'avez pas vu)', 'Tous les secrets, références et easter egg de la série Netflix : One Piece !', 1374223, 57000, 1065, '2023-09-09', 24, '1080p HD', 'https://youtu.be/7cRv3y7LC2M', 'https://img.youtube.com/vi/7cRv3y7LC2M/maxresdefault.jpg', 16, 3),
(48, 'LE JEU VIDÉO PRÉFÉRÉ DES ABONNÉS (ft. Squeezie)', 'Super Smash Bros ou Call of Duty ? Pokémon ou Super Mario ? Vous avez fait des choix impossibles, c\'est au tour de Squeezie !', 5562067, 262000, 26072, '2018-12-05', 24, '1080p HD', 'https://youtu.be/meEOHcYZ0M0', 'https://img.youtube.com/vi/meEOHcYZ0M0/maxresdefault.jpg', 16, 4),
(49, 'Pourquoi J\'ai Dû Quitter Mon Appartement', NULL, 4115543, 235000, 5466, '2020-12-19', 7, '1080p HD', 'https://youtu.be/uldXs3ZrbTE', 'https://img.youtube.com/vi/uldXs3ZrbTE/maxresdefault.jpg', 17, 1),
(50, 'Halloween Est Une Fête Horrible', 'En Janvier ??', 5140784, 223000, 11565, '2019-01-26', 10, '1080p HD', 'https://youtu.be/gFDRNkRZEuM', 'https://img.youtube.com/vi/gFDRNkRZEuM/maxresdefault.jpg', 17, 1),
(51, 'Le Problème De Mes Dessins', NULL, 5708259, 293000, 13011, '2019-08-01', 11, '1080p HD', 'https://youtu.be/f1X8wi4qWZY', 'https://img.youtube.com/vi/f1X8wi4qWZY/maxresdefault.jpg', 17, 1),
(52, 'ON A CONSTRUIT UNE MAISON LEGO GÉANTE (1 Million de briques)', 'On a construit une maison entièrement en LEGO avec le crew, + de 1 million de pièces !', 4058134, 245000, 4215, '2023-10-29', 37, '1080p HD', 'https://youtu.be/k6YMMBMgvyY', 'https://img.youtube.com/vi/k6YMMBMgvyY/maxresdefault.jpg', 18, 1),
(53, 'ON MANGE 100 FRUITS ET LÉGUMES D’AFFILÉE (et on les juge)(à l’aide)', 'On mange 100 fruits et légumes et c’est plus dur qu’on le croyait !', 3647607, 189000, 6832, '2024-01-07', 56, '1080p HD', 'https://youtu.be/n73p6NeCnPQ', 'https://img.youtube.com/vi/n73p6NeCnPQ/maxresdefault.jpg', 18, 1),
(54, 'FAITES MOI RIRE, GAGNEZ 1000€ (ces gens sont des génies)', 'Si vous me faites rire, je vous donne de l\'argent...genre 1000€ !', 9905276, 484000, 4897, '2022-05-01', 24, '1080p HD', 'https://youtu.be/zIXe1UxUrOw', 'https://img.youtube.com/vi/zIXe1UxUrOw/maxresdefault.jpg', 18, 1),
(55, 'Best of lofi hip hop 2023 - beats to relax/study to', 'Happy new year to the lofi community !', 1313107, 18000, 979, '2023-12-31', 146, '2160p 4K', 'https://youtu.be/mmKguZohAck', 'https://img.youtube.com/vi/mmKguZohAck/maxresdefault.jpg', 19, 2),
(56, '2 A.M Chill Session [synthwave/chillwave]', NULL, 644061, 14000, 484, '2023-08-31', 62, '2160p 4K', 'https://youtu.be/Z-_TTyZUOLk', 'https://img.youtube.com/vi/Z-_TTyZUOLk/maxresdefault.jpg', 19, 2),
(57, 'Lonely Days [sad lofi]', NULL, 2001814, 40000, 1478, '2022-11-21', 58, '2160p 4K', 'https://youtu.be/O7RG-B6N1Vw', 'https://img.youtube.com/vi/O7RG-B6N1Vw/maxresdefault.jpg', 19, 2),
(58, 'ESSAYEZ DE DEVINER CES LOGOS DE MÉMOIRE !', 'bon j\'avoue on a un peu craqués sur Mickey', 253570, 21000, 350, '2024-02-09', 22, '1080p HD', 'https://youtu.be/W3kbhmO15G8', 'https://img.youtube.com/vi/W3kbhmO15G8/maxresdefault.jpg', 20, 6),
(59, 'Je découvre des compétitions étranges... les humains sont étonnant', 'Imaginez ces compétitions étranges aux JOs... ça serait incroyable.', 222190, 21000, 349, '2023-06-14', 10, '2160p 4K', 'https://youtu.be/KLvgXLuCvB8', 'https://img.youtube.com/vi/KLvgXLuCvB8/maxresdefault.jpg', 20, 5),
(60, 'J\'INVENTE UN POKÉMON ET JE LE FAIS ÉVOLUER', NULL, 737530, 51000, 627, '2021-12-19', 10, '1080p HD', 'https://youtu.be/8T3-sQMKXak', 'https://img.youtube.com/vi/8T3-sQMKXak/maxresdefault.jpg', 20, 4);

-- --------------------------------------------------------

--
-- Structure de la table `youtubeur`
--

CREATE TABLE `youtubeur` (
  `id_youtubeur` int(11) NOT NULL,
  `pseudo` varchar(50) NOT NULL,
  `nom` varchar(25) NOT NULL,
  `prenom` varchar(25) NOT NULL,
  `sexe` varchar(5) NOT NULL,
  `pays` varchar(25) NOT NULL,
  `date_naissance` date NOT NULL,
  `date_creation` date NOT NULL,
  `nb_abonnes` int(11) NOT NULL,
  `chaine` text NOT NULL,
  `photo` text NOT NULL,
  `biographie` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `youtubeur`
--

INSERT INTO `youtubeur` (`id_youtubeur`, `pseudo`, `nom`, `prenom`, `sexe`, `pays`, `date_naissance`, `date_creation`, `nb_abonnes`, `chaine`, `photo`, `biographie`) VALUES
(1, 'Squeezie', 'Hauchard', 'Lucas', 'Homme', 'France', '1996-01-27', '2011-01-09', 18700000, 'https://www.youtube.com/@Squeezie', 'https://yt3.googleusercontent.com/ytc/AIf8zZQchOjed7sVy5lu1zUhEz6wkdHjjKkVn4da39bDuw=s176-c-k-c0x00ffffff-no-rj', 'clique sur une vidéo nan??'),
(2, 'Farod', 'Farod', 'Clément', 'Homme', 'France', '1995-01-19', '2013-02-22', 1230000, 'https://www.youtube.com/@FarodGames', 'https://yt3.googleusercontent.com/7LgabvynpbtiVgla788T81NjTjKKkR3KCGUzBVkHfEnHyQaG54My6CsJVevHEUWcvRPPz4bsow=s176-c-k-c0x00ffffff-no-rj', NULL),
(3, 'Fuze III', 'Guichon', 'Julien', 'Homme', 'France', '1998-10-15', '2011-12-21', 2830000, 'https://www.youtube.com/@FuzeIII', 'https://yt3.googleusercontent.com/6uA6xWjDBZIcAjHvvZ9v0hursHC1TdO56n0vDBTwzMp_vdJX31EV53FI_5cDTVAHMMyyx1W7_Q=s176-c-k-c0x00ffffff-no-rj', 'Je fais des vidéos sur Minecraft... desfois...'),
(4, 'Benjamin Code', 'Code', 'Benjamin', 'Homme', 'France', '1991-04-30', '2018-01-31', 129000, 'https://www.youtube.com/@BenjaminCode', 'https://yt3.googleusercontent.com/ytc/AIf8zZQ1HhAu3x9pnUC-xMf8kO0tVGlPmucvpsJeI5IaMg=s176-c-k-c0x00ffffff-no-rj', 'Benjamin Code est une chaine dans laquelle je tente de vous montrer les bons cotés de la vie d\'un développeur freelance. J\'essaie de ne montrer que peu de code et de privilégier une approche grand public pour faire découvrir à plus de monde cet univers pas si inaccessible qu\'on ne le croît.'),
(5, 'Aurélien Sama', 'Divoy', 'Aurélien', 'Homme', 'Belgique', '1991-07-18', '2011-09-19', 575000, 'https://www.youtube.com/@AurelienSama', 'https://yt3.googleusercontent.com/ytc/AIf8zZSWPnpkdMMK2cmfBj1RUjhIN3dydMJQuJ_BTbrXcA=s176-c-k-c0x00ffffff-no-rj', 'Chaîne de Aurelien_Sama, youtubeur gaming, surtout dans minecraft notamment en terraforming et architecture !'),
(6, 'Micode', 'Marliave', 'Michaël', 'Homme', 'France', '1999-05-11', '2017-01-09', 1230000, 'https://www.youtube.com/@Micode', 'https://yt3.googleusercontent.com/vkXCI-zdBTfUN48F5WpuCo43VVzzGKi1A6bR4R8XWg0lHm4rdgYshTQmp1NpiZ_2lE_0yxpKwqw=s176-c-k-c0x00ffffff-no-rj', 'Vous n\'avez pas beaucoup de temps à consacrer à l\'Informatique ? Moi si. Autant vous faire profiter des petites choses que peu de gens savent ! Je n\'ai pas la prétention de vouloir vous former, mais si j\'ai éveillé votre curiosité en vous apprenant quelque chose, alors j\'ai atteint mon objectif !'),
(7, 'Basti Ui', 'Marecaux', 'Bastien', 'Homme', 'France', '1991-10-28', '2011-10-06', 107000, 'https://www.youtube.com/@BastiUi', 'https://yt3.googleusercontent.com/ePr4Q4DVIpU8GBSk0bAkias_6GJivzuuiHQQb804UT9eNw3BbEUWNhV9dLIjIbWf7SZbLa6tYg=s176-c-k-c0x00ffffff-no-rj', 'Design d\'interface et graphisme !'),
(8, 'HugoDécrypte', 'Travers', 'Hugo', 'Homme', 'France', '1997-04-06', '2015-11-19', 2500000, 'https://www.youtube.com/@HugoDecrypte', 'https://yt3.googleusercontent.com/9eMry-HmtijTUp4YNKtOLY5G5lMNUpnF0kNMnwfgaBPWvWooIf5upePmW-gUrhqsHcs33LUo=s176-c-k-c0x00ffffff-no-rj', 'Chaque jour du lundi au vendredi, sur cette chaîne, un résumé de l\'actualité du jour. Bienvenue !'),
(9, 'Cyprien', 'Iov', 'Cyprien', 'Homme', 'France', '1989-05-12', '2007-02-25', 14500000, 'https://www.youtube.com/@cyprien', 'https://yt3.googleusercontent.com/ytc/AIf8zZQf-pYJ3MgKDBLfb7BjJUF1tQwwM4VNo4l3j3t-_w=s176-c-k-c0x00ffffff-no-rj', 'Je fais des vidéos, en plus tu peux même les regarder ! La nature fait bien les choses...'),
(10, 'CYRILmp4', 'Soudant', 'Cyril', 'Homme', 'France', '1994-03-25', '2010-07-11', 4950000, 'https://www.youtube.com/@CYRILmp4', 'https://yt3.googleusercontent.com/wvQK5T9-od3zarWw8zFEEylg-8e9Kx-fVOEZrSGnAtKQizfKP80Xn66tQ857q6p9d7Y6tn2A1Q=s176-c-k-c0x00ffffff-no-rj', 'J’explore la création !'),
(11, 'JOYCA', 'Rondelli', 'Jordan', 'Homme', 'France', '1995-08-07', '2016-05-24', 6040000, 'https://www.youtube.com/@Joyca', 'https://yt3.googleusercontent.com/UTwKyCeNxsAhrguvwQWpGvtFgLEY9Mrl3KUJDZGUx04Xs7hb2IgJM17D0SbbphRzXtX18YUPow=s176-c-k-c0x00ffffff-no-rj', 'Jordan Aka JOYCA - Beatmaker/Youtuber'),
(12, 'Julien Chièze', 'Chièze', 'Julien', 'Homme', 'France', '1980-02-08', '2011-10-03', 786000, 'https://www.youtube.com/@julienchieze', 'https://yt3.googleusercontent.com/ytc/AIf8zZTWPZX01p-bAzjiv6RxoLhDV3YwecyZAljj_VHVfg=s176-c-k-c0x00ffffff-no-rj', 'Savourez le meilleur de l\'actualité jeux vidéo au quotidien, avec un zeste de news high tech et culture geek.'),
(13, 'Steelorse', 'Forest', 'Rock', 'Homme', 'Québec', '1990-05-07', '2014-02-28', 776000, 'https://www.youtube.com/@steelorse', 'https://yt3.googleusercontent.com/7tyYSEt7hoKis3FWZSC-jKsyBkHojsuTYFwEb-ASY02GBNgQ0kVdVCYhK9_l1KYF9YkBPonMmJg=s176-c-k-c0x00ffffff-no-rj', 'Bienvenue dans l\'écurie ! Chaîne IRL de Steelorse, Je vous amène avec moi dans mon quotidien à travers des vlogs, unboxing, découverte, expériences, évènement et plus encore !'),
(14, 'Inoxtag', 'Benazzouz', 'Inès', 'Homme', 'France', '2002-02-02', '2015-01-12', 7170000, 'https://www.youtube.com/@inoxtag', 'https://yt3.googleusercontent.com/ytc/AIf8zZRs7Y51Xt0IY2jUb6rjUelj3EzGTaqQB8UJLotnaA=s176-c-k-c0x00ffffff-no-rj', 'Bio-thétique, Biologie, Biosphère Los mejor comprendrons...'),
(15, 'Mastu', 'Becker', 'Théo', 'Homme', 'France', '1997-11-08', '2015-08-15', 5910000, 'https://www.youtube.com/@Mastu', 'https://yt3.googleusercontent.com/ytc/AIf8zZQw7ri-J9GpYyShNLaY5qoD6jSLLV3HtsH4T0b-Cw=s176-c-k-c0x00ffffff-no-rj', 'J\'essaye de te faire passer un bon moment ici, tout en me faisant plaisir !'),
(16, 'Sofyan', 'Boudouni', 'Sofyan', 'Homme', 'France', '1995-02-08', '2012-05-31', 2180000, 'https://www.youtube.com/@sofyanfaitducinema', 'https://yt3.googleusercontent.com/h7vE0b1vzK5IOck7rmVyv26E1stD3PauJGuywWrPm53EvyKKhgboP0ohtlyzNSMrGy_l0L96=s176-c-k-c0x00ffffff-no-rj', 'Anecdotes, histoires et concepts sur le cinéma et la pop culture. Je fais aussi des doublages et des tournois sur insta et twitter.'),
(17, 'DEO TOONS', 'Biandji', 'Quentin', 'Homme', 'France', '1995-07-17', '2017-04-16', 1470000, 'https://www.youtube.com/@DEOTOONS', 'https://yt3.googleusercontent.com/ytc/AIf8zZSctpy1-UH5FCcRi6oQXofYML3wIGkII9ex3wxT=s176-c-k-c0x00ffffff-no-rj', 'Description qui sert de FAQ pour l\'animation'),
(18, 'Amixem', 'Chabroud', 'Maxime', 'Homme', 'France', '1991-03-04', '2012-11-09', 8410000, 'https://www.youtube.com/@Amixem', 'https://yt3.googleusercontent.com/XX1K_IPhILS54Sgv26VgCmxTN5KltpdWYS9wwWTIJ73wIScBFlzAPB1MMFudvmp06KFklYZR3w=s176-c-k-c0x00ffffff-no-rj', 'Voyages, Expériences, Découvertes, Humour (des fois), LeBonCoin (Souvent), Amazon (Souvent aussi) et plein d\'autres vidéos qui rendent ma chaîne tellement indescriptible que du coup j\'arrive pas à finir cette phrase.'),
(19, 'Lofi Girl', 'Somoguy', 'Dimitri', 'Homme', 'France', '1995-01-31', '2015-03-18', 13900000, 'https://www.youtube.com/@LofiGirl', 'https://yt3.googleusercontent.com/M0eY1tfgiwuyqrSlWIkzf5-6RZSARiuChjpXyZe-hfl9C2fn-I4leLtxKAqYqGZv_FgE4u5TKQ=s176-c-k-c0x00ffffff-no-rj', 'That girl studying by the window non-stop.'),
(20, 'COLAS', 'Grasset', 'Colas', 'Homme', 'France', '1989-01-01', '2014-12-11', 663000, 'https://www.youtube.com/colasbimgaming', 'https://yt3.googleusercontent.com/wRZ_Vk5pB7oscZmQ8DqHZnKCW-K8LnU7sEHTzrY5p8Tnl0_KmYd5PermM0-BRhO_nWc_0Aoba48=s176-c-k-c0x00ffffff-no-rj', 'vroum');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `categorie`
--
ALTER TABLE `categorie`
  ADD PRIMARY KEY (`id_categorie`);

--
-- Index pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD PRIMARY KEY (`id_video`,`id_invite`),
  ADD UNIQUE KEY `id_invitation` (`id_video`,`id_invite`) USING BTREE,
  ADD KEY `id_invite` (`id_invite`);

--
-- Index pour la table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id_invite`);

--
-- Index pour la table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id_video`),
  ADD KEY `id_youtubeur` (`id_youtubeur`),
  ADD KEY `id_categorie` (`id_categorie`);

--
-- Index pour la table `youtubeur`
--
ALTER TABLE `youtubeur`
  ADD PRIMARY KEY (`id_youtubeur`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `categorie`
--
ALTER TABLE `categorie`
  MODIFY `id_categorie` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `invite`
--
ALTER TABLE `invite`
  MODIFY `id_invite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT pour la table `video`
--
ALTER TABLE `video`
  MODIFY `id_video` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `youtubeur`
--
ALTER TABLE `youtubeur`
  MODIFY `id_youtubeur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `invitation_ibfk_1` FOREIGN KEY (`id_video`) REFERENCES `video` (`id_video`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `invitation_ibfk_2` FOREIGN KEY (`id_invite`) REFERENCES `invite` (`id_invite`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`id_youtubeur`) REFERENCES `youtubeur` (`id_youtubeur`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `video_ibfk_2` FOREIGN KEY (`id_categorie`) REFERENCES `categorie` (`id_categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
