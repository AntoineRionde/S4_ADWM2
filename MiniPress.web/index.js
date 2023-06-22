import { affichageArticles, affichageArticlesByMotCle } from './modules/affichageArticles';
import { affichageCategories } from './modules/affichageCategories';


const displayCat = document.getElementById('displayCat');
const displayArt = document.getElementById('displayArt');
const displayMot = document.getElementById('displayMot');
const logoTitre = document.getElementById('titre');

logoTitre.addEventListener('click',() => {
    document.getElementById('mot').value="";
    resetAffichage();
});

displayCat.addEventListener('click', () => {
    affichageCategories();
});

displayArt.addEventListener('click', () => {
    affichageArticles();
});

displayMot.addEventListener('click', () => {
    if(document.getElementById('mot').value.length>0){
        affichageArticlesByMotCle(document.getElementById('mot').value);
    }else{
        alert('Vous n\'avez pas entré de mot clé');
    }
    setTimeout(function(){
        if(!document.getElementById('listArticles').innerHTML.includes('<li>')){
            resetAffichage();
            alert('Aucun article correspond à votre recherche');
        }}, 1000
    );
});

export const resetAffichage = function(){
    document.getElementById('selectedCategory').innerHTML="";
    document.getElementById('articles').innerHTML="";
    document.getElementById('categories').innerHTML="";
    document.getElementById('auteur').innerHTML="";
  }

