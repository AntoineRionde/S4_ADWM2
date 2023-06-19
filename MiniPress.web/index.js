import { affichageArticles } from './modules/affichageArticles';
import categories from './modules/categorie.js';

affichageArticles();

console.log(categories.getDataCategories().then(affichageCategories));
