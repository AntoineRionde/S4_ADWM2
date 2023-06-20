import { affichageArticles, affichageArticlesByMotCle } from './modules/affichageArticles';
import { affichageCategories } from './modules/affichageCategories';


const displayCat = document.getElementById('displayCat');
const displayArt = document.getElementById('displayArt');


displayCat.addEventListener('click', () => {
    affichageCategories();
});

displayArt.addEventListener('click', () => {
    affichageArticles(true);
});

affichageArticlesByMotCle("sain");

