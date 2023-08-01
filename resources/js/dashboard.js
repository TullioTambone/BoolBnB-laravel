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