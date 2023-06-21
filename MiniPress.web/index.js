import { affichageArticles, affichageArticlesByMotCle } from './modules/affichageArticles';
import { affichageCategories } from './modules/affichageCategories';


const displayCat = document.getElementById('displayCat');
const displayArt = document.getElementById('displayArt');
const displayMot = document.getElementById('displayMot');


displayCat.addEventListener('click', () => {
    affichageCategories();
});

displayArt.addEventListener('click', () => {
    affichageArticles();
});

displayMot.addEventListener('click', () => {
    if(document.getElementById('mot').value.length>0){
        affichageArticlesByMotCle(document.getElementById('mot').value);
    }
});

export const resetAffichage = function(){
    document.getElementById('articles').innerHTML="";
    document.getElementById('categories').innerHTML="";
    document.getElementById('auteur').innerHTML="";
  }

