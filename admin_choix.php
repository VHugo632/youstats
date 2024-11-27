<?php
if (isset($_POST["identifiant"]) && isset($_POST["mot_de_passe"])) {
    if ($_POST["identifiant"] != "admin" || $_POST["mot_de_passe"] != "1234") { // On se fait automatiquement rediriger vers la page "redirections.php" si l'identifiant et/ou le mot de passe est incorrect (avec une variable désignant la raison de cette redirection)
        header("Location: redirections.php?raison=erreur_connexion");
        exit();
    }
}
elseif (isset($_GET["continuer"])) {    // Si l'administrateur exécute une requête SQL, alors il se fait rediriger vers la page "admin_choix.php" sans avoir besoin d'entrer les informations de connexion (ici, la variable "connexion" permet de contourner cette sécurité)
    if ($_GET["continuer"] != "oui") {
        header("Location: connexion.html");
        exit();
    }
}
else {  // On se fait automatiquement rediriger vers la page de connexion si on tente d'accéder à la page actuelle sans avoir saisi l'identifiant et le mot de passe
    header("Location: connexion.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Hugo VILLER - MMI1 TD2 TP4">
        <link rel="icon" type="image/png" href="css/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>YouStats - Administration - 1</title>
    </head>
    <body>
        <header>
            <a id="logo" href="index.php">
                <img src="css/logo.svg">
            </a>
            <ul>
                <li><a href="index.php">Accueil</a></li>
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
        <main id="choix">
            <div id="lumiere"></div>
            <h1>Bienvenue !</h1>
            <p>Je souhaite :</p>
            <form action="admin_traitement.php" method="GET">
                <select name="choix_action" id="choix_action">
                    <option value="ajouter" <?php if (isset($_GET["choix_action"]) && $_GET["choix_action"] == "ajouter") { echo("selected='selected'"); } // On sélectionne automatiquement l'option choisie par l'administrateur lors de sa précédente exécution SQL (2 fois => 1 fois pour chaque "select" et uniquement si l'administrateur a réalisé une requête SQL) ?>>Ajouter</option>
                    <option value="mettre_a_jour" <?php if (isset($_GET["choix_action"]) && $_GET["choix_action"] == "mettre_a_jour") { echo("selected='selected'"); } ?>>Mettre à jour</option>
                    <option value="supprimer" <?php if (isset($_GET["choix_action"]) && $_GET["choix_action"] == "supprimer") { echo("selected='selected'"); } ?>>Supprimer</option>
                </select>
                <select name="choix_table">
                    <option value="video" <?php if (isset($_GET["choix_table"]) && $_GET["choix_table"] == "video") { echo("selected='selected'"); } ?>>une vidéo</option>
                    <option value="youtubeur" <?php if (isset($_GET["choix_table"]) && $_GET["choix_table"] == "youtubeur") { echo("selected='selected'"); } ?>>un Youtubeur</option>
                    <option value="invite" <?php if (isset($_GET["choix_table"]) && $_GET["choix_table"] == "invite") { echo("selected='selected'"); } ?>>un invité</option>
                    <option value="invitation" <?php if (isset($_GET["choix_table"]) && $_GET["choix_table"] == "invitation") { echo("selected='selected'"); } ?>>une invitation</option>
                </select>
                <input type="submit" value="Continuer">
            </form>
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
    </body>
</html>