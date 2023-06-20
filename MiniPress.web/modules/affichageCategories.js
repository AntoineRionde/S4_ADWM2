import categorie from "./categorie";
import { affichageArticlesByIdCateg } from './affichageArticles';

export const affichageCategories = function(){
    const data = categorie.getDataCategories();

    const html = document.querySelector('body');
    html.innerHTML+='<div class="categories" id ="categories"><ul>';

    data.then(data => {
        let content='';
        data.categories.forEach(element => {
            content+=
                
            `<li><p class="categorie" data-id="${element.id}">Categorie ${element.id} : ${element.titre}, ${element.description}</p></li>`;
       
        });
        html.innerHTML=`
        '<div class="categories" id ="categories">
            <h1>Bienvenue sur MiniPress</h1>
            <div class="categories" id ="categories">
            <ul>${content}</ul>
        </div>
        `;
        
        const categorieElements = document.getElementsByClassName('categorie');
        for (let i = 0; i < categorieElements.length; i++) {
          categorieElements[i].addEventListener('click', function() {
            const categoryId = this.getAttribute('data-id');
            affichageArticlesByIdCateg(categoryId); 
          });
        }
    });
};

