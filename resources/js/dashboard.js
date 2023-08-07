function getPrice(price) {
    // Converto il numero in stringa per poterlo manipolare
    const numString = price.toString();

    // Divido il numero in due parti, parte intera e parte decimale
    const [intPart, decimalPart] = numString.split('.');

    // Aggiungo un punto ogni tre cifre nella parte intera
    const formattedIntPart = intPart.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

    // Ricostruisco il numero con la parte decimale (se presente) e la parte intera formattata
    const formattedNumber = decimalPart !== undefined
        ? `${formattedIntPart}.${decimalPart}`
        : formattedIntPart;

    return formattedNumber;
}

// Ottieni tutti gli elementi con attributo data-price e formatta i prezzi
document.addEventListener('DOMContentLoaded', () => {
    const priceElements = document.querySelectorAll('[data-price]');
    priceElements.forEach((element) => {
        const price = parseFloat(element.dataset.price);
        const formattedPrice = getPrice(price);
        element.textContent = 
        `
        ${formattedPrice}€
        `
    });
});

document.addEventListener("DOMContentLoaded", function() {

    // Seleziono le tabelle da mostrare
    const dashboardTables = document.querySelectorAll('.dashboard-table');
    
    // Mostro la tabella #appartamenti all'avvio
    const appartamenti = document.querySelector('#appartamenti');
    appartamenti.style.display = "block";
    const linkApart = document.querySelector('#link-apart')
    linkApart.classList.add('active');

    // Funzione per gestire il click sui link della navbar
    function handleNavClick(event) {

        // Rimuovo la classe "active" da tutti i link
        const navLinks = document.querySelectorAll('.link');
        navLinks.forEach(function(link) {
            link.classList.remove('active');
        });

        // Aggiungo la classe "active" solo al link cliccato
        event.target.classList.add('active');

        // Nascondo tutte le tabelle
        dashboardTables.forEach(function(table) {
            table.style.display = "none";
        });

        // Ottengo l'ID della tabella da mostrare dal data-target dell'elemento cliccato
        const targetTableId = event.target.getAttribute('data-target');
        const targetTable = document.getElementById(targetTableId);

        // Mostro la tabella corrispondente all'ID
        if (targetTable) {
            targetTable.style.display = "block";
        }
    }

    // Aggiungo un evento al click sui link della navbar
    const navLinks = document.querySelectorAll('.link');
    navLinks.forEach(function(link) {
        link.addEventListener('click', handleNavClick);
    });
});