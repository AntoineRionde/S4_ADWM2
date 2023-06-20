import { affichageArticles } from './modules/affichageArticles';
import { affichageCategories } from './modules/affichageCategories';


const displayCat = document.getElementById('displayCat');
const displayArt = document.getElementById('displayArt');


displayCat.addEventListener('click', () => {
    window.location.href = window.location.href + '?reloadedCat=true';
});

if (window.location.search.includes('reloadedCat=true')) {

    const newUrl = window.location.href.replace('?reloadedCat=true', '');
    window.history.replaceState("", document.title, newUrl);

    setTimeout(() => {
        affichageCategories();
    }, 100);
}


displayArt.addEventListener('click', () => {
    window.location.href = window.location.href + '?reloadedArt=true';
});

if (window.location.search.includes('reloadedArt=true')) {

    const newUrl = window.location.href.replace('?reloadedArt=true', '');
    window.history.replaceState("", document.title, newUrl);

    setTimeout(() => {
        affichageArticles();
    }, 100);
}


