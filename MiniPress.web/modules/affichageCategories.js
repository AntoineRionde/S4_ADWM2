import { apiMiniPress } from "./config";
import categorie from "./categorie";

export const affichageCategories = function(){
    const data = categorie.getDataCategories();

    const html = document.querySelector('body');
    html.innerHTML+='<div class="categories" id ="categories"><ul>';

    data.then(data => {
        let content='';
        data.categories.forEach(element => {
            content+=`
                <li><p>Categorie ${element.id} : ${element.titre}, ${element.description}</p></li>
            `;
        });
        html.innerHTML=`
        '<div class="categories" id ="categories">
            <h1>Bienvenue sur MiniPress</h1>
            <div class="categories" id ="categories">
            <ul>${content}</ul>
        </div>
        `;
    });
};