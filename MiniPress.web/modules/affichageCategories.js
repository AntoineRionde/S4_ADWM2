import categorie from "./categorie";
import { affichageArticlesBycat_id } from './affichageArticles';
import { resetAffichage } from '../index.js';

export const affichageCategories = function () {
  resetAffichage();
  const data = categorie.getDataCategories();

  const html = document.getElementById('categories');
  html.innerHTML = '<ul>';

  data.then(data => {
    let content = '';
    data.categories.forEach(element => {
      content +=
        `<li>
          <p class="categorie" id="categorie" data-id="${element.id}">Categorie ${element.id} : ${element.titre}, ${element.description}</p>
        </li>`;
    });
    html.innerHTML = `<ul>${content}</ul>`;

    const categorieElements = document.getElementsByClassName('categorie');
    for (let i = 0; i < categorieElements.length; i++) {
      categorieElements[i].addEventListener('click', function () {
        const categoryId = this.getAttribute('data-id');
        affichageArticlesBycat_id(categoryId);
        const selectedCategory = document.getElementById('selectedCategory');
        selectedCategory.innerHTML = this.textContent;
      });
    }
  });
};

