<?php
require("config/config.php");        // On intégre le fichier "config.php" pour se connecter à la base de données avec les bons paramètres

$bdd_youtube = new PDO("mysql:host=".$hote."; port=".$port."; dbname=".$nom_bdd, $identifiant, $mot_de_passe, $options);  // On se connecte à la base de données

if (isset($_GET["choix_action"]) && isset($_GET["choix_table"])) {
    if ($_GET["choix_action"] == "ajouter" || $_GET["choix_action"] == "mettre_a_jour") {
        switch($_GET["choix_table"]) {      // On place les champs qui vont être utilisés dans un tableau en fonction de la table choisie par l'administrateur (ici, uniquement pour les actions "ajouter" et "mettre à jour" car elles ont besoin des mêmes champs, ce qui est pratique pour effectuer des boucles)
            case "video" :
                $champs = ["titre", "description", "nb_vues", "nb_likes", "nb_commentaires", "date_publication", "duree", "qualite_max", "url", "miniature", "id_youtubeur", "id_categorie"];
                break;
            case "youtubeur" :
                $champs = ["pseudo", "nom", "prenom", "sexe", "pays", "date_naissance", "date_creation", "nb_abonnes", "chaine", "photo", "biographie"];
                break;
            case "invite" :
                $champs = ["nom", "prenom"];
                break;
            default :
                $champs = ["id_video", "id_invite"];
        }
        if ($_GET["choix_action"] == "ajouter") {
            switch($_GET["choix_table"]) {  // On commence à effectuer une requête préparée en fonction de l'action choisie par l'administrateur (ici, "ajouter") et de la table concernée
                case "video" :
                    $requete_preparee = $bdd_youtube -> prepare("INSERT INTO `video` (titre, description, nb_vues, nb_likes, nb_commentaires, date_publication, duree, qualite_max, url, miniature, id_youtubeur, id_categorie) VALUES (:titre, :description, :nb_vues, :nb_likes, :nb_commentaires, :date_publication, :duree, :qualite_max, :url, :miniature, :id_youtubeur, :id_categorie);");
                    break;
                case "youtubeur" :
                    $requete_preparee = $bdd_youtube -> prepare("INSERT INTO `youtubeur` (pseudo, nom, prenom, sexe, pays, date_naissance, date_creation, nb_abonnes, chaine, photo, biographie) VALUES (:pseudo, :nom, :prenom, :sexe, :pays, :date_naissance, :date_creation, :nb_abonnes, :chaine, :photo, :biographie);");
                    break;
                case "invite" :
                    $requete_preparee = $bdd_youtube -> prepare("INSERT INTO `invite` (nom, prenom) VALUES (:nom, :prenom);");
                    break;
                default :
                    $requete_preparee = $bdd_youtube -> prepare("INSERT INTO `invitation` (id_video, id_invite) VALUES (:id_video, :id_invite);");
            }
        }
        elseif ($_GET["choix_action"] == "mettre_a_jour") {
            switch($_GET["choix_table"]) {  // On commence à effectuer une requête préparée en fonction de l'action choisie par l'administrateur (ici, "mettre à jour") et de la table concernée en y intégrant des "placeholders" pour les données rentrées par l'utilisateur
                case "video" :
                    $requete_preparee = $bdd_youtube -> prepare("UPDATE `video` SET titre = :titre, description = :description, nb_vues = :nb_vues, nb_likes = :nb_likes, nb_commentaires = :nb_commentaires, date_publication = :date_publication, duree = :duree, qualite_max = :qualite_max, url = :url, miniature = :miniature, id_youtubeur = :id_youtubeur, id_categorie = :id_categorie WHERE id_video = ".$_GET["choix_table_id"].";");
                    break;
                case "youtubeur" :
                    $requete_preparee = $bdd_youtube -> prepare("UPDATE `youtubeur` SET pseudo = :pseudo, nom = :nom, prenom = :prenom, sexe = :sexe, pays = :pays, date_naissance = :date_naissance, date_creation = :date_creation, nb_abonnes = :nb_abonnes, chaine = :chaine, photo = :photo, biographie = :biographie WHERE id_youtubeur = ".$_GET["choix_table_id"].";");
                    break;
                case "invite" :
                    $requete_preparee = $bdd_youtube -> prepare("UPDATE `invite` SET nom = :nom, prenom = :prenom WHERE id_invite = ".$_GET["choix_table_id"].";");
                    break;
                default :
                    $requete_preparee = $bdd_youtube -> prepare("UPDATE `invitation` SET id_invite = :id_invite WHERE id_video = ".$_GET["id_video"]." AND id_invite = ".explode("|", $_GET["choix_table_id"])[1].";");
            }
        }
        if ($_GET["choix_action"] == "mettre_a_jour" && $_GET["choix_table"] == "invitation") { // On inclut la valeur de l'input dans la requête préparée à la place du "placeholder", mais à part (il n'y a pas besoin de parcourir un tableau puisqu'il n'y a qu'un seul champ)
            $requete_preparee -> bindValue(":id_invite", $_GET["id_invite"], PDO::PARAM_INT);
        }
        else {
            for ($colonne = 0; $colonne < count($champs); $colonne = $colonne + 1) {    // On parcourt tous les champs de la table concernée pour inclure les données adéquates dans la requête préparée (à la place des "placeholders")
                if ($champs[$colonne] == "nb_vues" || $champs[$colonne] == "nb_likes" || $champs[$colonne] == "nb_commentaires" || $champs[$colonne] == "duree" || $champs[$colonne] == "id_youtubeur" || $champs[$colonne] == "id_categorie" || $champs[$colonne] == "nb_abonnes" || $champs[$colonne] == "id_video" || $champs[$colonne] == "id_invite") {
                    $requete_preparee -> bindValue(":".$champs[$colonne], $_GET[$champs[$colonne]], PDO::PARAM_INT);    // On spécifie si la donnée doit être considérée comme un nombre (INT => pouvant alors être manipulé pour effectuer des calculs) ou comme une chaîne de caractères (STR)
                }
                else if ($champs[$colonne] == "miniature") {
                    $requete_preparee -> bindValue(":".$champs[$colonne], "https://img.youtube.com/vi/".substr($_GET["url"], 17)."/maxresdefault.jpg", PDO::PARAM_STR);
                }
                else {
                    $requete_preparee -> bindValue(":".$champs[$colonne], $_GET[$champs[$colonne]], PDO::PARAM_STR);
                }
            }
        }
    }
    else {
        switch($_GET["choix_table"]) {  // On place les champs qui vont être utilisés dans un tableau en fonction de la table choisie par l'administrateur (ici, uniquement pour l'action "supprimer" car elle n'a besoin que d'un seul champ)
            case "video" :
                $requete_preparee = $bdd_youtube -> prepare("DELETE FROM `video` WHERE id_video = :id_video;");
                break;
            case "youtubeur" :
                $requete_preparee = $bdd_youtube -> prepare("DELETE FROM `youtubeur` WHERE id_youtubeur = :id_youtubeur;");
                break;
            case "invite" :
                $requete_preparee = $bdd_youtube -> prepare("DELETE FROM `invite` WHERE id_invite = :id_invite;");
                break;
            default :
                $requete_preparee = $bdd_youtube -> prepare("DELETE FROM `invitation` WHERE id_video = :id_video AND id_invite = :id_invite;");
        }
        if ($_GET["choix_table"] == "video" || $_GET["choix_table"] == "youtubeur" || $_GET["choix_table"] == "invite") {
            $requete_preparee -> bindValue(":id_".$_GET["choix_table"], $_GET["choix_table_suppression"], PDO::PARAM_INT);
        }
        else {
            $requete_preparee -> bindValue(":id_video", explode("|", $_GET["choix_table_suppression"])[0], PDO::PARAM_INT);
            $requete_preparee -> bindValue(":id_invite", explode("|", $_GET["choix_table_suppression"])[1], PDO::PARAM_INT);
        }
    }
    $etat = $requete_preparee -> execute(); // On exécute la requête préparée et on stocke l'état de cette-dernière (1 = réussie, 0 = échec)
    if ($etat == 1) {   // On redirige l'administrateur vers la page "redirections.php" (avec une variable désignant la raison de cette redirection)
        header("Location: redirections.php?raison=reussite_execution&choix_action=".$_GET["choix_action"]."&choix_table=".$_GET["choix_table"]);
        exit();
    }
    else {
        header("Location: redirections.php?raison=echec_execution&choix_action=".$_GET["choix_action"]."&choix_table=".$_GET["choix_table"]);
        exit();
    }
}
else {  // On se fait automatiquement rediriger vers la page de connexion si on tente d'accéder à la page actuelle sans avoir saisi l'action à effectuer ni la table concernée par cette-dernière
    header("Location: connexion.html");
    exit();
}
?>