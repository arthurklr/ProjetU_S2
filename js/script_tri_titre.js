// Fonction de tri par ordre alphabétique de titre
document.querySelector(".bloc-links>ul>li:first-child>a")
    .addEventListener("click", function (event) {
        event.preventDefault();
        triDiv('asc');
    });

// Fonction de tri par ordre alphabétique inverse de titre
document.querySelector(".bloc-links>ul>li:last-child>a")
    .addEventListener("click", function (event) {
        event.preventDefault();
        triDiv('desc');
    });

function triDiv(order) {
    let conteneur = document.querySelector(".conteneur");
    let aTrier = [...conteneur.children];
    aTrier.sort((a, b) => {
        let titreA = a.querySelector("h3").innerText;
        let titreB = b.querySelector("h3").innerText;
        return order === 'asc' ? titreA.localeCompare(titreB) : titreB.localeCompare(titreA);
    });

    conteneur.innerHTML = "";
    aTrier.forEach(e => {
        conteneur.appendChild(e);
    });
}
