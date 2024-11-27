<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="author" content="Hugo VILLER - MMI1 TD2 TP4">
        <link rel="icon" type="image/png" href="css/favicon.png">
        <link rel="stylesheet" type="text/css" href="css/styles.css">
        <title>YouStats - Redirection</title>
    </head>
    <body>
        <main id="redirection">
            <div id="lumiere"></div>
            <p>
                <?php
                if (isset($_GET["raison"])) {
                    if ($_GET["raison"] == "erreur_connexion") {    // S'il y a eu une erreur de connexion, on redirige l'utilisateur vers la page de connexion au bout de 5 secondes en affichant la raison
                        header("Refresh: 5; URL=connexion.html");
                        echo("Identifiant et/ou mot de passe incorrect.");
                    }
                    elseif ($_GET["raison"] == "reussite_execution" || $_GET["raison"] == "echec_execution") {  // Si une requête SQL a été effectuée, on redirige l'administrateur vers la page de choix au bout de 5 secondes en affichant la raison
                        header("Refresh: 5; URL=admin_choix.php?continuer=oui&choix_action=".$_GET["choix_action"]."&choix_table=".$_GET["choix_table"]);
                        if ($_GET["raison"] == "reussite_execution") {
                            echo("OK.");
                        }
                        else {
                            echo("Une erreur est survenue.");
                        }
                    }
                }
                else {  // On se fait automatiquement rediriger vers la page de connexion si on tente d'accéder à la page actuelle sans avoir été redirigé précédemment
                    header("Location: connexion.html");
                    exit();
                }
                ?>
            </p>
            <p>Redirection dans 5 secondes...</p>
        </main>
        <script type="text/javascript" src="javascript/script.js"></script>
    </body>
</html>