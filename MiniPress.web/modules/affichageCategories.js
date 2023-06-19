import { apiMiniPress } from "./config";

export const affichageCategories = function(data){
    const html = document.querySelector('body');
    let list =``;
    data.categories.forEach(element => {
        list+=`
            <li><p>Categorie ${element.id} : ${element.titre}, ${element.description}</p></li>
        `;
    });
    html.innerHTML+='<div class="categories"><ul>'+list+'</ul></div>';
    return html;
};