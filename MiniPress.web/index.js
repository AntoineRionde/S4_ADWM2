import articles from './modules/articles.js';
import categories from './modules/categorie.js';
import { affichageCategories } from './modules/affichageCategories.js';

console.log(articles.getDataArticles());
console.log(categories.getDataCategories().then(affichageCategories));