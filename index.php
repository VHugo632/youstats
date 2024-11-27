<?php
require("config/config.php");    // On intégre le fichier "config.php" pour se connecter à la base de données avec les bons paramètres
require("fonctions/fonctions.php");     // On intégre le fichier "fonctions.php" pour pouvoir appeller les fonctions nécessaires

$bdd_youtube = new PDO("mysql:host=".$hote."; port=".$port."; dbname=".$nom_bdd, $identifiant, $mot_de_passe, $options); // On se connecte à la base de données

$donnees_videos = Requete("SELECT miniature, titre, photo, pseudo, nb_vues, nb_likes, nb_commentaires, id_video, youtubeur.id_youtubeur FROM `video`, `youtubeur` WHERE youtubeur.id_youtubeur = video.id_youtubeur ORDER BY RAND() LIMIT 6;", "fetchAll"); // On appelle la fonction "Requete" pour récupérer les données de notre requête dans un tableau
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Hugo VILLER - MMI1 TD2 TP4">
        <meta name="description" content="YouStats est une plateforme innovante poussant à la découverte d'une infinité de vidéos YouTube à travers une expérience simple, moderne et fluide.">
        <meta name="keywords" content="YouStats, YouTube, vidéos, divertissement, découverte, exploration, partage, communauté">
        <link rel="icon" type="image/png" href="css/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>YouStats - Accueil</title>
    </head>
    <body id="accueil">
        <div id="chargement">
            <ul>
                <li><div></div></li>
                <li><div></div></li>
                <li><div></div></li>
            </ul>
        </div>
        <header>
            <a id="logo" href="#">
                <img src="css/logo.svg">
            </a>
            <ul>
                <li><a href="#">Accueil</a></li>
                <li><a href="toutes_les_videos.php">Toutes les vidéos</a></li>
                <li><a href="connexion.html">Connexion</a></li>
            </ul>
            <div id="theme" tabindex="0">
                <svg id="lune" width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.84576 0C1.61183 0.749372 0 2.8561 0 5.34458C0 8.46932 2.53085 11.0002 5.65553 11.0002C8.14396 11.0002 10.2506 9.38836 11 7.15438C10.4344 7.33819 9.82648 7.46544 9.19023 7.46544C6.06555 7.46544 3.5347 4.93454 3.5347 1.8098C3.5347 1.17354 3.64781 0.565564 3.84576 0Z" fill="white"/>
                </svg>
                <svg id="soleil" width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8 12C10.2091 12 12 10.2091 12 8C12 5.79086 10.2091 4 8 4C5.79086 4 4 5.79086 4 8C4 10.2091 5.79086 12 8 12Z" fill="white"/>
                    <path d="M8 0C8.27614 0 8.5 0.223858 8.5 0.5V2.5C8.5 2.77614 8.27614 3 8 3C7.72386 3 7.5 2.77614 7.5 2.5V0.5C7.5 0.223858 7.72386 0 8 0Z" fill="white"/>
                    <path d="M8 13C8.27614 13 8.5 13.2239 8.5 13.5V15.5C8.5 15.7761 8.27614 16 8 16C7.72386 16 7.5 15.7761 7.5 15.5V13.5C7.5 13.2239 7.72386 13 8 13Z" fill="white"/>
                    <path d="M16 8C16 8.27614 15.7761 8.5 15.5 8.5H13.5C13.2239 8.5 13 8.27614 13 8C13 7.72386 13.2239 7.5 13.5 7.5H15.5C15.7761 7.5 16 7.72386 16 8Z" fill="white"/>
                    <path d="M3 8C3 8.27614 2.77614 8.5 2.5 8.5H0.5C0.223858 8.5 -1.20706e-08 8.27614 0 8C1.20706e-08 7.72386 0.223858 7.5 0.5 7.5H2.5C2.77614 7.5 3 7.72386 3 8Z" fill="white"/>
                    <path d="M13.6569 2.34318C13.8521 2.53844 13.8521 2.85502 13.6569 3.05028L12.2426 4.4645C12.0474 4.65976 11.7308 4.65976 11.5355 4.4645C11.3403 4.26924 11.3403 3.95265 11.5355 3.75739L12.9497 2.34318C13.145 2.14792 13.4616 2.14792 13.6569 2.34318Z" fill="white"/>
                    <path d="M4.46446 11.5356C4.65973 11.7308 4.65973 12.0474 4.46446 12.2427L3.05025 13.6569C2.85499 13.8521 2.53841 13.8521 2.34314 13.6569C2.14788 13.4616 2.14788 13.145 2.34314 12.9498L3.75736 11.5356C3.95262 11.3403 4.2692 11.3403 4.46446 11.5356Z" fill="white"/>
                    <path d="M13.6569 13.6569C13.4616 13.8522 13.145 13.8522 12.9497 13.6569L11.5355 12.2427C11.3403 12.0474 11.3403 11.7308 11.5355 11.5356C11.7308 11.3403 12.0474 11.3403 12.2426 11.5356L13.6569 12.9498C13.8521 13.1451 13.8521 13.4616 13.6569 13.6569Z" fill="white"/>
                    <path d="M4.46447 4.46451C4.2692 4.65977 3.95262 4.65977 3.75736 4.46451L2.34315 3.0503C2.14788 2.85503 2.14788 2.53845 2.34315 2.34319C2.53841 2.14793 2.85499 2.14793 3.05025 2.34319L4.46447 3.7574C4.65973 3.95267 4.65973 4.26925 4.46447 4.46451Z" fill="white"/>
                </svg>
            </div>
        </header>
        <main>
            <div id="ancre" tabindex="0">
                <svg width="10" height="10" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg" transform="matrix(1,0,0,-1,0,0)">
                    <path d="M1 1L5 5.36364L9 1" stroke="white" stroke-width="2"/>
                </svg>
            </div>
            <div id="lumiere"></div>
            <section id="intro">
                <h1>Vos vidéos préférées<br>au même endroit</h1>
                <h2>Une véritable expérience alliant simplicité, modernité et fluidité<br>pour explorer un horizon infini de vidéos YouTube.</h2>
                <div>
                    <a href="#caroussel"></a>
                    <p>Découvrir</p>
                    <svg width="10" height="10" viewBox="0 0 10 5" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 1L5 5.36364L9 1" stroke="white" stroke-width="2"/>
                    </svg>
                </div>
            </section>
            <section id="caroussel">
                <?php for ($ligne = 0; $ligne < count($donnees_videos); $ligne = $ligne + 1) {  // On crée une disposition particulière des données pour chaque vidéo récupérée dans le tableau "donnees_videos" en effectuant une boucle (6 fois) ?>
                
                <div class="carte carte_accueil">
                    <a href='video.php?id="<?php echo($donnees_videos[$ligne]["id_video"]); ?>"'></a>
                    <img class="miniature" src="<?php echo($donnees_videos[$ligne]["miniature"]); ?>" alt="Miniature d'une vidéo de <?php echo($donnees_videos[$ligne]["pseudo"]); ?>">
                    <div class="informations">
                        <p><?php echo($donnees_videos[$ligne]["titre"]); ?></p>
                        <div>
                            <div class="chaîne">
                                <a href='youtubeur.php?id="<?php echo($donnees_videos[$ligne]["id_youtubeur"]); ?>"'></a>
                                <img src="<?php echo($donnees_videos[$ligne]["photo"]); ?>" alt="Photo de profil de <?php echo($donnees_videos[$ligne]["pseudo"]); ?>">
                                <p><?php echo($donnees_videos[$ligne]["pseudo"]); ?></p>
                            </div>
                            <ul class="statistiques">
                                <li>
                                    <svg width="14" height="11" viewBox="0 0 14 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.00001 6.60224C7.81033 6.60224 8.46718 5.94539 8.46718 5.13508C8.46718 4.32478 7.81033 3.66791 7.00001 3.66791C6.18973 3.66791 5.53286 4.32478 5.53286 5.13508C5.53286 5.94539 6.18973 6.60224 7.00001 6.60224Z" fill="white"/>
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0 5.13507C0.934771 2.15887 3.71527 0 6.99999 0C10.2847 0 13.0652 2.15884 14 5.13505C13.0652 8.11129 10.2847 10.2701 6.99998 10.2701C3.71527 10.2701 0.934786 8.11129 0 5.13507ZM9.93434 5.13507C9.93434 6.75563 8.62057 8.0694 7.00001 8.0694C5.37944 8.0694 4.06569 6.75563 4.06569 5.13507C4.06569 3.51449 5.37944 2.20075 7.00001 2.20075C8.62057 2.20075 9.93434 3.51449 9.93434 5.13507Z" fill="white"/>
                                    </svg>
                                    <p><?php echo(number_format($donnees_videos[$ligne]["nb_vues"], 0, ".", " ")); ?></p>
                                </li>
                                <li>
                                    <svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M7.60965 0.625C8.13321 0.624971 8.637 0.825012 9.01793 1.18419C9.39886 1.54338 9.62814 2.03455 9.65886 2.55721L9.66228 2.67763V5.41447H11.0307C11.5337 5.41439 12.0192 5.59899 12.395 5.93323C12.7709 6.26747 13.011 6.72809 13.0696 7.22763L13.0799 7.34668L13.0833 7.46711L13.0696 7.60121L12.3813 11.0442C12.1206 12.1567 11.3536 12.9572 10.4587 12.9463L10.3465 12.9408H4.87281C4.70522 12.9408 4.54347 12.8792 4.41824 12.7679C4.293 12.6565 4.21299 12.5031 4.19339 12.3366L4.1886 12.2566L4.18928 5.73195C4.1894 5.61196 4.22108 5.49412 4.28112 5.39024C4.34117 5.28636 4.42748 5.2001 4.53139 5.14011C4.82315 4.9716 5.06891 4.73382 5.24696 4.44777C5.425 4.16173 5.52985 3.83624 5.55223 3.50005L5.55702 3.36184V2.67763C5.55702 2.13324 5.77328 1.61115 6.15822 1.2262C6.54316 0.841259 7.06526 0.625 7.60965 0.625Z" fill="white"/>
                                        <path d="M2.13596 5.41447C2.30355 5.4145 2.4653 5.47602 2.59053 5.58738C2.71577 5.69875 2.79578 5.8522 2.81539 6.01863L2.82018 6.09868V12.2566C2.82015 12.4242 2.75863 12.5859 2.64726 12.7111C2.5359 12.8364 2.38245 12.9164 2.21602 12.936L2.13596 12.9408H1.45175C1.10652 12.9409 0.773998 12.8105 0.520853 12.5758C0.267708 12.341 0.112647 12.0193 0.0867545 11.675L0.0833333 11.5724V6.78289C0.0832241 6.43766 0.213611 6.10514 0.448357 5.85199C0.683104 5.59885 1.00486 5.44379 1.34912 5.41789L1.45175 5.41447H2.13596Z" fill="white"/>
                                    </svg>
                                    <p><?php echo(number_format($donnees_videos[$ligne]["nb_likes"], 0, ".", " ")); ?></p>
                                </li>
                                <li>
                                    <svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M6.74962 12.5H12.3743C12.4979 12.5 12.6187 12.4633 12.7215 12.3947C12.8242 12.326 12.9043 12.2284 12.9516 12.1142C12.9989 12 13.0113 11.8744 12.9872 11.7532C12.963 11.6319 12.9035 11.5206 12.8161 11.4332L11.5888 10.2058C12.487 9.10713 12.9846 7.73547 12.9996 6.31642C13.0147 4.89738 12.5464 3.51545 11.6718 2.39791C10.7971 1.28037 9.56818 0.493767 8.18708 0.167464C6.80598 -0.158838 5.35495 -0.0054102 4.07263 0.602515C2.79031 1.21044 1.75305 2.23667 1.13146 3.51241C0.509859 4.78816 0.340929 6.23747 0.652451 7.62198C0.963973 9.00649 1.7374 10.2438 2.84552 11.1303C3.95365 12.0169 5.33049 12.4999 6.74962 12.5Z" fill="white"/>
                                    </svg>
                                    <p><?php echo(number_format($donnees_videos[$ligne]["nb_commentaires"], 0, ".", " ")); ?></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <?php }; ?>
            </section>
            <section id="progression">
                <ul id="etapes">
                    <li>
                        <div></div>
                        <div class="en_cours"></div>
                    </li>
                    <li>
                        <div></div>
                        <div class="en_cours"></div>
                    </li>
                    <li>
                        <div></div>
                        <div class="en_cours"></div>
                    </li>
                    <li>
                        <div></div>
                        <div class="en_cours"></div>
                    </li>
                    <li>
                        <div></div>
                        <div class="en_cours"></div>
                    </li>
                    <li>
                        <div></div>
                        <div class="en_cours"></div>
                    </li>
                </ul>
                <div id="actions">
                    <div id="precedent" tabindex="0">
                        <svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 10L2 5.5L7 1" stroke="white" stroke-width="2"/>
                        </svg>
                    </div>
                    <div id="suivant" tabindex="0">
                        <svg width="8" height="11" viewBox="0 0 8 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M1 10L6 5.5L1 1" stroke="white" stroke-width="2"/>
                        </svg>
                    </div>
                </div>
            </section>
        </main>
        <footer>
            <p>© 2024 - YouStats</p>
            <ul>
                <li>
                    <a href="https://discord.com/" target="_blank">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14.3916 3.08872C13.2892 2.58282 12.126 2.22175 10.931 2.01453C10.9202 2.01271 10.909 2.01428 10.8992 2.01904C10.8893 2.0238 10.8811 2.0315 10.8757 2.04109C10.7259 2.30672 10.5602 2.65416 10.4444 2.92616C9.1562 2.73067 7.84591 2.73067 6.55775 2.92616C6.42856 2.62315 6.28242 2.32766 6.12 2.04109C6.11455 2.03161 6.10635 2.02399 6.09649 2.01925C6.08663 2.01451 6.07556 2.01286 6.06475 2.01453C4.8695 2.22091 3.70621 2.58201 2.60418 3.08872C2.59476 3.09232 2.58687 3.09908 2.58187 3.10784C0.378246 6.40053 -0.226316 9.61247 0.0701213 12.784C0.0711838 12.7989 0.0807463 12.8138 0.0924338 12.8233C1.37565 13.7739 2.81094 14.4996 4.33712 14.9696C4.3479 14.973 4.35948 14.9729 4.37018 14.9692C4.38088 14.9656 4.39014 14.9587 4.39662 14.9494C4.72387 14.5032 5.015 14.0325 5.26575 13.5373C5.26921 13.5306 5.27118 13.5232 5.27153 13.5156C5.27189 13.508 5.27061 13.5004 5.26779 13.4934C5.26497 13.4863 5.26068 13.48 5.25519 13.4747C5.24971 13.4695 5.24316 13.4655 5.236 13.463C4.77823 13.287 4.33489 13.0757 3.91 12.8308C3.90223 12.8263 3.89571 12.8199 3.891 12.8123C3.8863 12.8047 3.88356 12.796 3.88303 12.7871C3.8825 12.7781 3.88421 12.7692 3.88799 12.761C3.89176 12.7529 3.8975 12.7458 3.90468 12.7405C3.99393 12.6735 4.08318 12.6034 4.16818 12.5333C4.17569 12.5272 4.1847 12.5234 4.19425 12.5221C4.20379 12.5207 4.21351 12.5221 4.22237 12.5258C7.00506 13.7966 10.0172 13.7966 12.7659 12.5258C12.7751 12.5218 12.7852 12.5203 12.7951 12.5216C12.8051 12.5229 12.8145 12.527 12.8222 12.5333C12.9072 12.6034 12.9965 12.6735 13.0857 12.7405C13.093 12.7458 13.0988 12.7527 13.1027 12.7608C13.1065 12.7689 13.1083 12.7778 13.1079 12.7868C13.1075 12.7957 13.1049 12.8044 13.1002 12.8121C13.0956 12.8198 13.0892 12.8262 13.0815 12.8308C12.6576 13.0779 12.2136 13.289 11.7544 13.4619C11.7473 13.4646 11.7409 13.4688 11.7355 13.4742C11.7301 13.4796 11.726 13.4861 11.7232 13.4932C11.7205 13.5003 11.7194 13.5079 11.7198 13.5155C11.7202 13.5232 11.7223 13.5306 11.7257 13.5373C11.9807 14.0314 12.2729 14.5032 12.5938 14.9494C12.6003 14.9587 12.6096 14.9656 12.6203 14.9692C12.631 14.9729 12.6425 14.973 12.6533 14.9696C14.182 14.5011 15.6197 13.7752 16.9044 12.8233C16.9108 12.8188 16.9161 12.813 16.9199 12.8062C16.9238 12.7994 16.9261 12.7918 16.9267 12.784C17.2816 9.11734 16.3327 5.93197 14.4128 3.10891C14.4109 3.10424 14.408 3.10004 14.4043 3.09656C14.4007 3.09308 14.3963 3.09041 14.3916 3.08872V3.08872ZM5.68118 10.8524C4.84287 10.8524 4.15331 10.0832 4.15331 9.13966C4.15331 8.19509 4.83012 7.42584 5.68118 7.42584C6.53862 7.42584 7.22181 8.20147 7.20906 9.13966C7.20906 10.0832 6.53225 10.8524 5.68118 10.8524ZM11.3294 10.8524C10.4922 10.8524 9.80156 10.0832 9.80156 9.13966C9.80156 8.19509 10.4784 7.42584 11.3294 7.42584C12.1869 7.42584 12.8711 8.20147 12.8573 9.13966C12.8573 10.0832 12.1869 10.8524 11.3294 10.8524Z" fill="white"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://github.com/" target="_blank">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.5 0C3.80375 0 0 3.80375 0 8.5C0 12.2612 2.43312 15.4381 5.81187 16.5644C6.23687 16.6388 6.39625 16.3838 6.39625 16.1606C6.39625 15.9588 6.38563 15.2894 6.38563 14.5775C4.25 14.9706 3.6975 14.0569 3.5275 13.5787C3.43187 13.3344 3.0175 12.58 2.65625 12.3781C2.35875 12.2187 1.93375 11.8256 2.64563 11.815C3.315 11.8044 3.79313 12.4312 3.9525 12.6862C4.7175 13.9719 5.93938 13.6106 6.42813 13.3875C6.5025 12.835 6.72562 12.4631 6.97 12.2506C5.07875 12.0381 3.1025 11.305 3.1025 8.05375C3.1025 7.12937 3.43188 6.36437 3.97375 5.76937C3.88875 5.55687 3.59125 4.68562 4.05875 3.51687C4.05875 3.51687 4.77063 3.29375 6.39625 4.38813C7.07625 4.19688 7.79875 4.10125 8.52125 4.10125C9.24375 4.10125 9.96625 4.19688 10.6463 4.38813C12.2719 3.28313 12.9838 3.51687 12.9838 3.51687C13.4513 4.68562 13.1538 5.55687 13.0688 5.76937C13.6106 6.36437 13.94 7.11875 13.94 8.05375C13.94 11.3156 11.9531 12.0381 10.0619 12.2506C10.37 12.5162 10.6356 13.0263 10.6356 13.8231C10.6356 14.96 10.625 15.8738 10.625 16.1606C10.625 16.3838 10.7844 16.6494 11.2094 16.5644C12.8968 15.9947 14.3631 14.9102 15.4018 13.4636C16.4406 12.0169 16.9995 10.281 17 8.5C17 3.80375 13.1963 0 8.5 0Z" fill="white"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://twitter.com/" target="_blank">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M13.3885 0.796875H15.9953L10.3002 7.3228L17 16.2031H11.7541L7.64539 10.8173L2.94405 16.2031H0.335697L6.42711 9.22291L0 0.796875H5.37904L9.09299 5.71976L13.3885 0.796875ZM12.4736 14.6388H13.918L4.59417 2.27904H3.04413L12.4736 14.6388Z" fill="white"/>
                        </svg>
                    </a>
                </li>
                <li>
                    <a href="https://www.tiktok.com/" target="_blank">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M9.5625 1.08294e-05L11.6669 0C11.8188 0.7597 12.2406 1.71812 12.9785 2.66894C13.7014 3.6006 14.6594 4.25001 15.9375 4.25001V6.37501C14.0745 6.37501 12.6746 5.5106 11.6875 4.43211V11.6875C11.6875 14.6215 9.30901 17 6.375 17C3.44099 17 1.0625 14.6215 1.0625 11.6875C1.0625 8.7535 3.44099 6.37501 6.375 6.37501V8.50001C4.61459 8.50001 3.1875 9.9271 3.1875 11.6875C3.1875 13.4479 4.61459 14.875 6.375 14.875C8.13541 14.875 9.5625 13.4479 9.5625 11.6875V1.08294e-05Z" fill="white"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </footer>
        <script type="text/javascript" src="javascript/script_global.js"></script>
        <script type="text/javascript" src="javascript/script_accueil.js"></script>
    </body>
</html>