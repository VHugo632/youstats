// Déclaration des constantes (const)

const bodyHV = document.body;

const themeHV = document.getElementById("theme");
const ancreHV = document.getElementById("ancre");

const elementsDomHV = [themeHV, ancreHV];

// Déclaration des fonctions

/* themeAutomatiqueHV : applique le thème sélectionné par l'utilisateur automatiquement au lancement des pages grâce au "localStorage" */
function themeAutomatiqueHV() {
    if (localStorage.length == 0) { // Si l'utilisateur n'a jamais appuyé sur le bouton de changement de thème, on applique le thème par défaut (nuit) et on sauvegarde la sélection pour qu'elle subsite entre toutes les pages dès leur lancement
        localStorage.setItem("theme", "nuit");
    }
    else {
        if (localStorage.getItem("theme") == "jour") {  // Si l'utilisateur a sélectionné le thème "jour", on applique ce thème sur toutes les pages dès leur lancement
            bodyHV.classList.add("jour");
        }
    }
}

/* changerThemeHV : applique le thème opposé lorsque l'utilisateur clique sur le bouton concerné et sauvegarde cette sélection dans le "localStorage" */
function changerThemeHV() {
    if (localStorage.getItem("theme") == "nuit") {  // Si l'utilisateur change de thème alors qu'il était sur le thème "nuit", on applique le thème "jour"
        localStorage.setItem("theme", "jour");
    }
    else {
        localStorage.setItem("theme", "nuit");  // Si l'utilisateur change de thème alors qu'il était sur le thème "jour", on applique le thème "nuit"
    }
    bodyHV.classList.toggle("jour");
}

/* retourHautHV : ramène l'utilisateur tout en haut de la page */
function retourHautHV() {
    window.scrollTo({ top: 0 });
}

/* apparitionAncreHV : fait apparaître l'ancre de la page lorsque l'utilisateur a parcouru plus de 300 pixels, sinon on la masque */
function apparitionAncreHV() {
    if (document.documentElement.scrollTop > 300) {
        ancreHV.style.pointerEvents = "auto";
        ancreHV.style.filter = "opacity(100%)";
    }
    else {
        ancreHV.style.pointerEvents = "none";
        ancreHV.style.filter = "opacity(0%)";
    }
}

/* setupListenersHV : met en place les différents abonnements de la page uniquement lorsque l'élément concerné existe sur celle-ci */
function setupListenersHV() {
    for (let indexHV = 0; indexHV < elementsDomHV.length; indexHV = indexHV + 1) {
        if (elementsDomHV[indexHV] != null) {   // Pour éviter d'avoir des erreurs, on vérifie si l'élément existe afin de lui appliquer ensuite un abonnement (certaines pages ne possède pas tous les éléments)
            switch (elementsDomHV[indexHV]) {
                case themeHV :
                    themeHV.addEventListener("click", changerThemeHV);
                    break;
                case ancreHV :
                    ancreHV.addEventListener("click", retourHautHV);
                    window.addEventListener("scroll", apparitionAncreHV);
                    break;
            }
        }
    }
}

// Appel des fonctions au lancement de la page

window.addEventListener("load", function() {
    themeAutomatiqueHV();
    setupListenersHV();
});