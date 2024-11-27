<?php
function Requete($requete, $type) { // La fonction "Requete" permet d'effectuer des requêtes de type "SELECT" (= des projections) et de stocker les données récupérées dans un tableau (fetch => un seul enregistrement = mono-dimension, fetchAll => plusieurs enregistrements = multi-dimensions)
    require("config/config.php");

    $bdd_youtube = new PDO("mysql:host=".$hote."; port=".$port."; dbname=".$nom_bdd, $identifiant, $mot_de_passe, $options);
    
    $resultats = $bdd_youtube -> query($requete);
    if ($type == "fetch") {
        $donnees = $resultats -> fetch(PDO::FETCH_ASSOC);
    }
    elseif ($type == "fetchAll") {
        $donnees = $resultats -> fetchAll(PDO::FETCH_ASSOC);
    }
    $resultats -> closeCursor();    // On ferme l'exécution de la requête une fois qu'elle est complétement terminée pour libérer une potentielle future requête
    return $donnees;    // On retourne le tableau contenant toutes les données récupérées de la requête
}

function AffichageDuree($donnees) {
    if ($donnees["duree"] >= 60) {
        $duree_heures = floor($donnees["duree"] / 60);    // La fonction "floor" permet de transformer un nombre décimal (= avec des virgules) en un nombre entier (= sans virgules) en arrondissant à l'entier le plus bas (ex : 7.3 => 7)
        $duree_minutes = $donnees["duree"] % 60;
        if ($duree_heures >= 2 && $duree_minutes >= 2) {
            echo($duree_heures." heures ".$duree_minutes." minutes");
        }
        elseif ($duree_heures >= 2 && $duree_minutes == 1) {
            echo($duree_heures." heures ".$duree_minutes." minute");
        }
        elseif ($duree_heures == 1 && $duree_minutes >= 2) {
            echo($duree_heures." heure ".$duree_minutes." minutes");
        }
        else {
            echo($duree_heures." heure ".$duree_minutes." minute");
        }
    }
    else {
        if ($donnees["duree"] >= 2) {
            echo($donnees["duree"]." minutes");
        }
        else {
            echo($donnees["duree"]." minute");
        }
    }
}

function VerificationYoutubeur($donnees) {
    if ($donnees == null) {
        echo("Aucun invité");
    }
    else {
        for ($index = 0; $index < count($donnees); $index = $index + 1) {
            $verification_youtubeur = Requete("SELECT id_youtubeur FROM `youtubeur` WHERE prenom = '".$donnees[$index]["prenom"]."' AND nom = '".$donnees[$index]["nom"]."' ;", "fetch");
            if ($verification_youtubeur == null) {
                echo($donnees[$index]["prenom"]." ".$donnees[$index]["nom"]);
            }
            else {
                echo("<a href='youtubeur.php?id=".$verification_youtubeur["id_youtubeur"]."'>".$donnees[$index]["prenom"]." ".$donnees[$index]["nom"]."</a>");
            }
            if ($index + 1 < count($donnees)) {
                echo(", ");
            }
        }
    }
}

function CreationFormulaireAjouter($choix_table) {  // La fonction "CreationFormulaireAjouter" permet de créer tous les champs nécessaires avec les attributs adéquats pour ajouter l'élément choisi par l'administrateur (vidéo, youtubeur, invité ou invitation)
    switch($choix_table) {
        case "video" :
            echo("<h1>Ajouter une vidéo</h1>");
            $champs = ["titre", "description", "nb_vues", "nb_likes", "nb_commentaires", "date_publication", "duree", "qualite_max", "url", "id_youtubeur", "id_categorie"];
            $labels = ["Titre", "Description", "Nombre de vues", "Nombre de likes", "Nombre de commentaires", "Date de publication", "Durée (en minutes)", "Qualité maximale", "Lien de la vidéo", "Youtubeur", "Catégorie"];
            break;
        case "youtubeur" :
            echo("<h1>Ajouter un Youtubeur</h1>");
            $champs = ["pseudo", "prenom", "nom", "sexe", "pays", "date_naissance", "date_creation", "nb_abonnes", "chaine", "photo", "biographie"];
            $labels = ["Pseudo", "Prénom", "Nom", "Sexe", "Pays", "Date de naissance", "Date de création de la chaîne", "Nombre d'abonnés", "Lien de la chaîne", "Lien de la photo de profil", "Biographie"];
            break;
        case "invite" :
            echo("<h1>Ajouter un invité</h1>");
            $champs = ["prenom", "nom"];
            $labels = ["Prénom", "Nom"];
            break;
        default :
            echo("<h1>Ajouter une invitation</h1>");
            $champs = ["id_video", "id_invite"];
            $labels = ["Vidéo", "Invité"];
    }

    for ($colonne = 0; $colonne < count($champs); $colonne = $colonne + 1) {
        echo("<div>");
        if ($champs[$colonne] == "titre" || $champs[$colonne] == "pseudo" || $champs[$colonne] == "nom" || $champs[$colonne] == "prenom" || $champs[$colonne] == "pays") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<input type='text' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required'>");
        }
        elseif ($champs[$colonne] == "description" || $champs[$colonne] == "biographie") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." (facultatif) : "."</label>");
            echo("<textarea name='".$champs[$colonne]."' id='".$champs[$colonne]."'></textarea>");
        }
        elseif ($champs[$colonne] == "url" || $champs[$colonne] == "chaine" || $champs[$colonne] == "photo") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            switch($champs[$colonne]) {
                case "url" :
                    echo("<input type='url' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' pattern='https://youtu.be/.*'>");
                    break;
                case "chaine" :
                    echo("<input type='url' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' pattern='https://www.youtube.com/@.*'>");
                    break;
                default :
                    echo("<input type='url' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' pattern='https://yt3.googleusercontent.com/.*'>");
            }
        }
        elseif ($champs[$colonne] == "nb_vues" || $champs[$colonne] == "nb_likes" || $champs[$colonne] == "nb_commentaires" || $champs[$colonne] == "duree" || $champs[$colonne] == "nb_abonnes") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<input type='number' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required'>");
        }
        elseif ($champs[$colonne] == "date_publication" || $champs[$colonne] == "date_naissance" || $champs[$colonne] == "date_creation") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<input type='date' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required'>");
        }
        elseif ($champs[$colonne] == "qualite_max" || $champs[$colonne] == "id_youtubeur" || $champs[$colonne] == "id_categorie" || $champs[$colonne] == "sexe" || $champs[$colonne] == "id_video" || $champs[$colonne] == "id_invite") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<select name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required'>");
            echo("<option value=''>- Renseignez une valeur -</option>");
            switch($champs[$colonne]) {
                case "qualite_max" :
                    echo("<option value='2160p 4K'>2160p 4K</option>");
                    echo("<option value='1440p HD'>1440p HD</option>");
                    echo("<option value='1080p HD'>1080p HD</option>");
                    echo("<option value='720p'>720p</option>");
                    break;
                case "sexe" :
                    echo("<option value='Homme'>Homme</option>");
                    echo("<option value='Femme'>Femme</option>");
                    break;
                case "id_youtubeur" :
                    $donnees_youtubeurs = Requete("SELECT id_youtubeur, pseudo FROM `youtubeur` ORDER BY id_youtubeur;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_youtubeurs); $colonne_2 = $colonne_2 + 1) {
                        echo("<option value='".$donnees_youtubeurs[$colonne_2]["id_youtubeur"]."'>".$donnees_youtubeurs[$colonne_2]["pseudo"]."</option>");
                    }
                    break;
                case "id_categorie" :
                    $donnees_categories = Requete("SELECT id_categorie, intitule FROM `categorie` ORDER BY id_categorie;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_categories); $colonne_2 = $colonne_2 + 1) {
                        echo("<option value='".$donnees_categories[$colonne_2]["id_categorie"]."'>".$donnees_categories[$colonne_2]["intitule"]."</option>");
                    }
                    break;
                case "id_video" :
                    $donnees_videos = Requete("SELECT id_video, titre, pseudo FROM `video`, `youtubeur` WHERE youtubeur.id_youtubeur = video.id_youtubeur ORDER BY youtubeur.id_youtubeur;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_videos); $colonne_2 = $colonne_2 + 1) {
                        echo("<option value='".$donnees_videos[$colonne_2]["id_video"]."'>".$donnees_videos[$colonne_2]["pseudo"]." | ".$donnees_videos[$colonne_2]["titre"]."</option>");
                    }
                    break;
                default :
                    $donnees_invites = Requete("SELECT id_invite, prenom, nom FROM `invite` ORDER BY id_invite;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_invites); $colonne_2 = $colonne_2 + 1) {
                        echo("<option value='".$donnees_invites[$colonne_2]["id_invite"]."'>".$donnees_invites[$colonne_2]["prenom"]." ".$donnees_invites[$colonne_2]["nom"]."</option>");
                    }
            }
            echo("</select>");
        }
        echo("</div>");
    }
    if ($choix_table == "video") {
        echo("<p>* La miniature sera automatiquement insérée.</p>");
    }
    echo("<input type='hidden' name='choix_action' value='".$_GET["choix_action"]."'><input type='hidden' name='choix_table' value='".$_GET["choix_table"]."'>");   // On insére des champs cachés possédant les données "choix_action" et "choix_table" pour pouvoir les récupérer dans la page suivante
    echo("<input id='envoyer' type='submit' value='Envoyer'><input id='reinitialiser' type='reset' value='Réinitialiser'>");
}

function ChoixTableID($choix_table) {   // La fonction "ChoixTableID" permet de demander à l'administrateur l'enregistrement précis à mettre à jour de la table précédemment choisie
    switch($choix_table) {
        case "video" :
            echo("<h1>Choisir une vidéo</h1>");
            $donnees = Requete("SELECT id_video, titre, pseudo FROM `video`, `youtubeur` WHERE youtubeur.id_youtubeur = video.id_youtubeur ORDER BY youtubeur.id_youtubeur;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_id'>Je souhaite mettre à jour la vidéo suivante : </label>");
            break;
        case "youtubeur" :
            echo("<h1>Choisir un Youtubeur</h1>");
            $donnees = Requete("SELECT id_youtubeur, pseudo FROM `youtubeur` ORDER BY id_youtubeur;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_id'>Je souhaite mettre à jour le Youtubeur suivant : </label>");
            break;
        case "invite" :
            echo("<h1>Choisir un invité</h1>");
            $donnees = Requete("SELECT id_invite, prenom, nom FROM `invite` ORDER BY id_invite;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_id'>Je souhaite mettre à jour l'invité suivant : </label>");
            break;
        default :
        echo("<h1>Choisir une invitation</h1>");
            $donnees = Requete("SELECT invitation.id_video, invitation.id_invite, titre, pseudo, invite.prenom, invite.nom FROM `invitation`, `video`, `youtubeur`, `invite` WHERE video.id_video = invitation.id_video AND youtubeur.id_youtubeur = video.id_youtubeur AND invite.id_invite = invitation.id_invite ORDER BY youtubeur.id_youtubeur, id_invite;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_id'>Je souhaite mettre à jour l'invitation suivante : </label>");
    }
    echo("<select name='choix_table_id' id='choix_table_id' required='required'>");
    echo("<option value=''>- Renseignez une valeur -</option>");

    for ($ligne = 0; $ligne < count($donnees); $ligne = $ligne + 1) {
        switch($choix_table) {
            case "video" :
                echo("<option value='".$donnees[$ligne]["id_video"]."'>".$donnees[$ligne]["pseudo"]." | ".$donnees[$ligne]["titre"]."</option>");
                break;
            case "youtubeur" :
                echo("<option value='".$donnees[$ligne]["id_youtubeur"]."'>".$donnees[$ligne]["pseudo"]."</option>");
                break;
            case "invite" :
                echo("<option value='".$donnees[$ligne]["id_invite"]."'>".$donnees[$ligne]["prenom"]." ".$donnees[$ligne]["nom"]."</option>");
                break;
            default :
                echo("<option value='".$donnees[$ligne]["id_video"]."|".$donnees[$ligne]["id_invite"]."'>".$donnees[$ligne]["pseudo"]." | ".$donnees[$ligne]["titre"]." | avec ".$donnees[$ligne]["prenom"]." ".$donnees[$ligne]["nom"]."</option>");
                // Ici, on place les données "id_video" et "id_invite" en même temps dans la valeur de chaque "<option>" en les combinant dans la même chaîne de caractères et en les séparant par "|" (on fait cela car on a besoin de ces deux données et on ne peux pas avoir deux attributs "value" dans "<option>")
        }
    }
    echo("</select></div>");
    echo("<input type='hidden' name='choix_action' value='".$_GET["choix_action"]."'><input type='hidden' name='choix_table' value='".$_GET["choix_table"]."'>"); // On insére des champs cachés possédant les données "choix_action" et "choix_table" pour pouvoir les récupérer dans la page suivante
    echo("<input id='continuer' type='submit' value='Continuer'>");
}

function CreationFormulaireMettreAJour($choix_table, $choix_table_id) { // La fonction "CreationFormulaireMettreAJour" permet de créer tous les champs nécessaires avec les attributs adéquats pour mettre à jour l'élément choisi de la table précédemment sélectionné par l'administrateur (exemple : élément portant l'identifiant "4" de la table "video" => ici, id_video = 4)
    switch($choix_table) {
        case "video" :
            echo("<h1>Mettre à jour une vidéo</h1>");
            $donnees = Requete("SELECT titre, description, nb_vues, nb_likes, nb_commentaires, date_publication, duree, qualite_max, url, id_youtubeur, id_categorie FROM `video` WHERE id_video=".$choix_table_id.";", "fetch");
            $champs = ["titre", "description", "nb_vues", "nb_likes", "nb_commentaires", "date_publication", "duree", "qualite_max", "url", "id_youtubeur", "id_categorie"];
            $labels = ["Titre", "Description", "Nombre de vues", "Nombre de likes", "Nombre de commentaires", "Date de publication", "Durée (en minutes)", "Qualité maximale", "Lien de la vidéo", "Youtubeur", "Catégorie"];
            break;
        case "youtubeur" :
            echo("<h1>Mettre à jour un Youtubeur</h1>");
            $donnees = Requete("SELECT pseudo, prenom, nom, sexe, pays, date_naissance, date_creation, nb_abonnes, chaine, photo, biographie FROM `youtubeur` WHERE id_youtubeur=".$choix_table_id.";", "fetch");
            $champs = ["pseudo", "prenom", "nom", "sexe", "pays", "date_naissance", "date_creation", "nb_abonnes", "chaine", "photo", "biographie"];
            $labels = ["Pseudo", "Prénom", "Nom", "Sexe", "Pays", "Date de naissance", "Date de création de la chaîne", "Nombre d'abonnés", "Lien de la chaîne", "Lien de la photo de profil", "Biographie"];
            break;
        case "invite" :
            echo("<h1>Mettre à jour un invité</h1>");
            $donnees = Requete("SELECT prenom, nom FROM `invite` WHERE id_invite=".$choix_table_id.";", "fetch");
            $champs = ["prenom", "nom"];
            $labels = ["Prénom", "Nom"];
            break;
        default :
            echo("<h1>Mettre à jour une invitation</h1>");
            $champs = ["id_video", "id_invite"];
            $labels = ["Vidéo", "Invité"];
    }

    for ($colonne = 0; $colonne < count($champs); $colonne = $colonne + 1) {
        echo("<div>");
        if ($champs[$colonne] == "titre" || $champs[$colonne] == "pseudo" || $champs[$colonne] == "nom" || $champs[$colonne] == "prenom" || $champs[$colonne] == "pays") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<input type='text' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' value='".str_replace("'", " ", $donnees[$champs[$colonne]])."'>");
        }
        elseif ($champs[$colonne] == "description" || $champs[$colonne] == "biographie") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." (facultatif) : "."</label>");
            echo("<textarea name='".$champs[$colonne]."' id='".$champs[$colonne]."'>".$donnees[$champs[$colonne]]."</textarea>");
        }
        elseif ($champs[$colonne] == "url" || $champs[$colonne] == "chaine" || $champs[$colonne] == "photo") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            switch($champs[$colonne]) {
                case "url" :
                    echo("<input type='url' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' pattern='https://youtu.be/.*' value='".$donnees[$champs[$colonne]]."'>");
                    break;
                case "chaine" :
                    echo("<input type='url' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' pattern='https://www.youtube.com/@.*' value='".$donnees[$champs[$colonne]]."'>");
                    break;
                default :
                    echo("<input type='url' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' pattern='https://yt3.googleusercontent.com/.*' value='".$donnees[$champs[$colonne]]."'>");
            }
        }
        elseif ($champs[$colonne] == "nb_vues" || $champs[$colonne] == "nb_likes" || $champs[$colonne] == "nb_commentaires" || $champs[$colonne] == "duree" || $champs[$colonne] == "nb_abonnes") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<input type='number' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' value='".$donnees[$champs[$colonne]]."'>");
        }
        elseif ($champs[$colonne] == "date_publication" || $champs[$colonne] == "date_naissance" || $champs[$colonne] == "date_creation") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<input type='date' name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required' value='".$donnees[$champs[$colonne]]."'>");
        }
        elseif ($champs[$colonne] == "qualite_max" || $champs[$colonne] == "id_youtubeur" || $champs[$colonne] == "id_categorie" || $champs[$colonne] == "sexe" || $champs[$colonne] == "id_video" || $champs[$colonne] == "id_invite") {
            echo("<label for='".$champs[$colonne]."'>".$labels[$colonne]." : "."</label>");
            echo("<select name='".$champs[$colonne]."' id='".$champs[$colonne]."' required='required'>");
            switch($champs[$colonne]) {
                case "qualite_max" :
                    if ($donnees[$champs[$colonne]] == "2160p 4K") {
                        echo("<option value='2160p 4K' selected='selected'>2160p 4K</option>");
                        echo("<option value='1440p HD'>1440p HD</option>");
                        echo("<option value='1080p HD'>1080p HD</option>");
                        echo("<option value='720p'>720p</option>");
                    }
                    elseif ($donnees[$champs[$colonne]] == "1440p HD") {
                        echo("<option value='2160p 4K'>2160p 4K</option>");
                        echo("<option value='1440p HD' selected='selected'>1440p HD</option>");
                        echo("<option value='1080p HD'>1080p HD</option>");
                        echo("<option value='720p'>720p</option>");
                    }
                    elseif ($donnees[$champs[$colonne]] == "1080p HD") {
                        echo("<option value='2160p 4K'>2160p 4K</option>");
                        echo("<option value='1440p HD'>1440p HD</option>");
                        echo("<option value='1080p HD' selected='selected'>1080p HD</option>");
                        echo("<option value='720p'>720p</option>");
                    }
                    else {
                        echo("<option value='2160p 4K'>2160p 4K</option>");
                        echo("<option value='1440p HD'>1440p HD</option>");
                        echo("<option value='1080p HD'>1080p HD</option>");
                        echo("<option value='720p' selected='selected'>720p</option>");
                    }
                    break;
                case "sexe" :
                    if ($donnees[$champs[$colonne]] == "Homme") {
                        echo("<option value='Homme' selected='selected'>Homme</option>");
                        echo("<option value='Femme'>Femme</option>");
                    }
                    else {
                        echo("<option value='Homme'>Homme</option>");
                        echo("<option value='Femme' selected='selected'>Femme</option>");
                    }
                    break;
                case "id_youtubeur" :
                    $donnees_youtubeurs = Requete("SELECT id_youtubeur, pseudo FROM `youtubeur` ORDER BY id_youtubeur;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_youtubeurs); $colonne_2 = $colonne_2 + 1) {
                        if ($donnees_youtubeurs[$colonne_2]["id_youtubeur"] == $donnees[$champs[$colonne]]) {
                            echo("<option value='".$donnees_youtubeurs[$colonne_2]["id_youtubeur"]."' selected='selected'>".$donnees_youtubeurs[$colonne_2]["pseudo"]."</option>");
                        }
                        else {
                            echo("<option value='".$donnees_youtubeurs[$colonne_2]["id_youtubeur"]."'>".$donnees_youtubeurs[$colonne_2]["pseudo"]."</option>");
                        }
                    }
                    break;
                case "id_categorie" :
                    $donnees_categories = Requete("SELECT id_categorie, intitule FROM `categorie` ORDER BY id_categorie;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_categories); $colonne_2 = $colonne_2 + 1) {
                        if ($donnees_categories[$colonne_2]["id_categorie"] == $donnees[$champs[$colonne]]) {
                            echo("<option value='".$donnees_categories[$colonne_2]["id_categorie"]."' selected='selected'>".$donnees_categories[$colonne_2]["intitule"]."</option>");
                        }
                        else {
                            echo("<option value='".$donnees_categories[$colonne_2]["id_categorie"]."'>".$donnees_categories[$colonne_2]["intitule"]."</option>");
                        }
                    }
                    break;
                case "id_video" :
                    $donnees_videos = Requete("SELECT id_video, titre, pseudo FROM `video`, `youtubeur` WHERE youtubeur.id_youtubeur = video.id_youtubeur ORDER BY id_video;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_videos); $colonne_2 = $colonne_2 + 1) {
                        if ($donnees_videos[$colonne_2]["id_video"] == explode("|", $choix_table_id)[0]) {  // La fonction "explode" permet de scinder une chaîne de caractères en deux dans un tableau via un caractère passé en paramètre
                            echo("<option value='".$donnees_videos[$colonne_2]["id_video"]."' selected='selected'>".$donnees_videos[$colonne_2]["pseudo"]." | ".$donnees_videos[$colonne_2]["titre"]."</option>");
                        }
                    }
                    break;
                default :
                    $donnees_invites = Requete("SELECT id_invite, prenom, nom FROM `invite` ORDER BY id_invite;", "fetchAll");
                    for ($colonne_2 = 0; $colonne_2 < count($donnees_invites); $colonne_2 = $colonne_2 + 1) {
                        if ($donnees_invites[$colonne_2]["id_invite"] == explode("|", $choix_table_id)[1]) {
                            echo("<option value='".$donnees_invites[$colonne_2]["id_invite"]."' selected='selected'>".$donnees_invites[$colonne_2]["prenom"]." ".$donnees_invites[$colonne_2]["nom"]."</option>");
                        }
                        else {
                            echo("<option value='".$donnees_invites[$colonne_2]["id_invite"]."'>".$donnees_invites[$colonne_2]["prenom"]." ".$donnees_invites[$colonne_2]["nom"]."</option>");
                        }
                    }
            }
            echo("</select>");
        }
        echo("</div>");
    }
    if ($choix_table == "video") {
        echo("<p>* La miniature sera automatiquement insérée.</p>");
    }
    echo("<input type='hidden' name='choix_action' value='".$_GET["choix_action"]."'><input type='hidden' name='choix_table' value='".$_GET["choix_table"]."'><input type='hidden' name='choix_table_id' value='".$choix_table_id."'>");
    // On insére des champs cachés possédant les données "choix_action", "choix_table" et "choix_id" pour pouvoir les récupérer dans la page suivante
    echo("<input id='envoyer' type='submit' value='Envoyer'><input id='reinitialiser' type='reset' value='Réinitialiser'>");
}

function CreationFormulaireSupprimer($choix_table) {    // La fonction "CreationFormulaireSupprimer" permet de créer tous les champs nécessaires avec les attributs adéquats pour supprimer l'élément choisi de la table précédemment sélectionné par l'administrateur (exemple : élément portant l'identifiant "4" de la table "video" => ici, id_video = 4)
    switch($choix_table) {
        case "video" :
            echo("<h1>Supprimer une vidéo</h1>");
            $donnees = Requete("SELECT id_video, titre, pseudo FROM `video`, `youtubeur` WHERE youtubeur.id_youtubeur = video.id_youtubeur ORDER BY youtubeur.id_youtubeur;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_suppression'>Je souhaite supprimer la vidéo suivante : </label>");
            break;
        case "youtubeur" :
            echo("<h1>Supprimer un Youtubeur</h1>");
            $donnees = Requete("SELECT id_youtubeur, pseudo FROM `youtubeur` ORDER BY id_youtubeur;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_suppression'>Je souhaite supprimer le Youtubeur suivant : </label>");
            break;
        case "invite" :
            echo("<h1>Supprimer un invité</h1>");
            $donnees = Requete("SELECT id_invite, prenom, nom FROM `invite` ORDER BY id_invite;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_suppression'>Je souhaite supprimer l'invité suivant : </label>");
            break;
        default :
            echo("<h1>Supprimer une invitation</h1>");
            $donnees = Requete("SELECT invitation.id_video, invitation.id_invite, titre, pseudo, invite.prenom, invite.nom FROM `invitation`, `video`, `youtubeur`, `invite` WHERE video.id_video = invitation.id_video AND youtubeur.id_youtubeur = video.id_youtubeur AND invite.id_invite = invitation.id_invite ORDER BY youtubeur.id_youtubeur, id_invite;", "fetchAll");
            echo("<div>");
            echo("<label for='choix_table_suppression'>Je souhaite supprimer l'invitation suivante : </label>");
    }
    echo("<select name='choix_table_suppression' id='choix_table_suppression' required='required'>");
    echo("<option value=''>- Renseignez une valeur -</option>");
    
    for ($ligne = 0; $ligne < count($donnees); $ligne = $ligne + 1) {
        switch($choix_table) {
            case "video" :
                echo("<option value='".$donnees[$ligne]["id_video"]."'>".$donnees[$ligne]["pseudo"]." | ".$donnees[$ligne]["titre"]."</option>");
                break;
            case "youtubeur" :
                echo("<option value='".$donnees[$ligne]["id_youtubeur"]."'>".$donnees[$ligne]["pseudo"]."</option>");
                break;
            case "invite" :
                echo("<option value='".$donnees[$ligne]["id_invite"]."'>".$donnees[$ligne]["prenom"]." ".$donnees[$ligne]["nom"]."</option>");
                break;
            default :
                echo("<option value='".$donnees[$ligne]["id_video"]."|".$donnees[$ligne]["id_invite"]."'>".$donnees[$ligne]["pseudo"]." | ".$donnees[$ligne]["titre"]." | avec ".$donnees[$ligne]["prenom"]." ".$donnees[$ligne]["nom"]."</option>");
        }
    }
    echo("</select></div>");
    echo("<input type='hidden' name='choix_action' value='".$_GET["choix_action"]."'><input type='hidden' name='choix_table' value='".$_GET["choix_table"]."'>");   // On insére des champs cachés possédant les données "choix_action" et "choix_table" pour pouvoir les récupérer dans la page suivante
    echo("<input id='envoyer' type='submit' value='Envoyer'>");
}
?>