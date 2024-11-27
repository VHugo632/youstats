// Déclaration des constantes (const) et des variables (let)

const chargementHV = document.getElementById("chargement");

const carousselHV = document.getElementById("caroussel");
const tab_cartesHV = carousselHV.getElementsByClassName("carte_accueil");

const tab_etapesHV = document.getElementById("etapes").getElementsByClassName("en_cours");

const precedentHV = document.getElementById("precedent");
const suivantHV = document.getElementById("suivant");

let carte_actuelleHV = 0;

// Déclaration des fonctions

/* finChargementHV : retire l'animation de chargement au bout de 3 secondes à partir du moment où la page est complètement chargée */
function finChargementHV() {
    setTimeout(function() {
        chargementHV.style.filter = "opacity(0%)";
        setTimeout(function() {
            chargementHV.remove();  // On supprime l'élément du DOM puisque nous n'en avons plus besoin
            setTimeout(function() {
                bodyHV.style.overflowY = "visible"; // On réactive le scroll sur la page (on l'avais enlevé pour éviter de pouvoir scroller pendant le chargement)
            }, 1000)
        }, 750)
    }, 3000)
}

/* boucleCarousselHV : effectue une boucle appellant la fonction "carousselSuivantHV" toutes les 5 secondes (elle permet de faire défiler automatiquement le caroussel) */
function boucleCarousselHV() {
    temps_attenteHV = setInterval(carousselSuivantHV, 5000);
}

/* masquerCarteHV : masque la carte passée en paramètre en lui appliquant certaines propriétés CSS
    *@param {object} carteHV : la carte à masquer (c'est un élément HTML)
*/
function masquerCarteHV(carteHV) {
    carteHV.style.filter = "opacity(0%)";
    setTimeout(function() {
        carteHV.style.position = "absolute";
        carteHV.style.display = "none";
    }, 200)
}

/* afficherCarteHV : affiche la carte passée en paramètre en lui appliquant certaines propriétés CSS
    *@param {object} carteHV : la carte à afficher (c'est un élément HTML)
*/
function afficherCarteHV(carteHV) {
    setTimeout(function() {
        carteHV.style.position = "relative";
        carteHV.style.display = "block";
        setTimeout(function() {
            carteHV.style.filter = "opacity(100%)";
        }, 200)
    }, 200)
}

/* carousselPrecedentHV : effectue un retour arrière dans le caroussel (on masque la carte où nous étions initialement et on affiche la carte précédente) */
function carousselPrecedentHV() {
    if (carte_actuelleHV - 1 < 0) {
        carte_actuelleHV = tab_cartesHV.length - 1;
        masquerCarteHV(tab_cartesHV[0]);
        tab_etapesHV[0].style.transform = "scaleX(0%)";
    }
    else {
        carte_actuelleHV = carte_actuelleHV - 1;
        masquerCarteHV(tab_cartesHV[carte_actuelleHV + 1]);
        tab_etapesHV[carte_actuelleHV + 1].style.transform = "scaleX(0%)";
    }
    afficherCarteHV(tab_cartesHV[carte_actuelleHV]);
    tab_etapesHV[carte_actuelleHV].style.transform = "scaleX(100%)";
    clearInterval(temps_attenteHV); // On réinitialise le temps d'attente entre les différentes cartes pour éviter d'avoir un décalage
    boucleCarousselHV();    // On redéclare le temps d'attente lorsque tout est prêt
}

/* carousselSuivantHV : effectue une avancée dans le caroussel (on masque la carte où nous étions initialement et on affiche la carte suivante) */
function carousselSuivantHV() {
    if (carte_actuelleHV + 1 >= tab_cartesHV.length) {
        carte_actuelleHV = 0;
        masquerCarteHV(tab_cartesHV[tab_cartesHV.length - 1]);
        tab_etapesHV[tab_cartesHV.length - 1].style.transform = "scaleX(0%)";
    }
    else {
        carte_actuelleHV = carte_actuelleHV + 1;
        masquerCarteHV(tab_cartesHV[carte_actuelleHV - 1]);
        tab_etapesHV[carte_actuelleHV - 1].style.transform = "scaleX(0%)";
    }
    afficherCarteHV(tab_cartesHV[carte_actuelleHV]);
    tab_etapesHV[carte_actuelleHV].style.transform = "scaleX(100%)";
    clearInterval(temps_attenteHV); // On réinitialise le temps d'attente entre les différentes cartes pour éviter d'avoir un décalage
    boucleCarousselHV();    // On redéclare le temps d'attente lorsque tout est prêt
}

/* setupListenersHV : met en place les différents abonnements de la page */
function setupListenersAccueilHV() {
    precedentHV.addEventListener("click", carousselPrecedentHV);
    suivantHV.addEventListener("click", carousselSuivantHV);
}

// Appel des fonctions et déclarations au lancement de la page

window.addEventListener("load", function() {
    finChargementHV();
    afficherCarteHV(tab_cartesHV[carte_actuelleHV]);
    tab_etapesHV[carte_actuelleHV].style.transform = "scaleX(100%)";
    boucleCarousselHV();
    setupListenersAccueilHV();
});