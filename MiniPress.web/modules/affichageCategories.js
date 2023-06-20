import categorie from "./categorie";
import { affichageArticlesByIdCateg } from './affichageArticles';

export const affichageCategories = function(){
    const data = categorie.getDataCategories();

    const html = document.getElementById('articles');
    html.innerHTML+='<ul>';

    data.then(data => {
        let content='';
        data.categories.forEach(element => {
            content+=
                
            `<li><p class="categorie" data-id="${element.id}">Categorie ${element.id} : ${element.titre}, ${element.description}</p></li>`;
       
        });
        html.innerHTML=`
            <ul>${content}</ul>
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

