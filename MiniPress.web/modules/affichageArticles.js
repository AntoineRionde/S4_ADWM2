import articles from './articles.js';
import categories from './categorie.js';

export function affichageArticles() {
  const galleryContainer = document.createElement('ul');
  galleryContainer.id = 'articles';
  galleryContainer.innerHTML = '';

  const data = articles.getDataArticles();

  data.then((dataArticles) => {
    // Tri des articles par date de création dans l'ordre chronologique décroissant
    dataArticles.articles.sort(function(a, b) {
      return new Date(a.date_creation) - new Date(b.date_creation);
    });

    dataArticles.articles.forEach((article, index) => {
      const titre = "Titre : " + article.titre + " ";
      const date = "Creation : " + article.date_creation + " ";
      const auteur = "Auteur : " + article.auteur + " ";

      const artTitreElement = document.createElement('art_titre');
      artTitreElement.textContent = titre;

      const artAuteurElement = document.createElement('art_auteur');
      artAuteurElement.textContent = auteur;

      artAuteurElement.addEventListener('click', function() {
        affichageArticlesByAuteur(article.auteur);
      });

      const artCreaElement = document.createElement('art_crea');
      artCreaElement.textContent = date;

      const listItem = document.createElement('li');
      listItem.appendChild(artTitreElement);
      listItem.appendChild(artAuteurElement);
      listItem.appendChild(artCreaElement);
      galleryContainer.appendChild(listItem);

      fetch(article.url.self.href)
        .then(response => response.json())
        .then(articleDetail => {
          artTitreElement.addEventListener('click', function() {
            affichageArticleDetail(articleDetail.article.id);
          });
        });
    });
  });

  document.body.appendChild(galleryContainer);
}

export const affichageArticlesByIdCateg = function(id){
  const data = articles.getDataArticlesByIdCateg(id);
  const html = document.querySelector('body');

  
  data.then(data => {
    let content='';
    data.forEach(article => {
      content+=`
        <li>
          <h2>${article.titre}</h2>
          <h3> écrit par ${article.auteur} et publié le ${article.date_publication}}</h3>
          <p>${article.description}</p>
        </li>
      `;
    });
    html.innerHTML+='<div class="articles"><ul>'+content+'</ul></div>';
  });
  return html;
}


export const affichageArticleDetail = function(id) {
  const data = articles.getArticleDetail(id);
  const html = document.querySelector('body');

  data.then(article => {
    const articleElement = document.createElement('div');
    articleElement.innerHTML = `
      <h2>${article.article.titre}</h2>
      <h3>écrit par ${article.article.auteur} et publié le ${article.article.date_publication}</h3>
      <p>${article.article.resume}</p>
      <p>${article.article.contenu}</p>
    `;
    html.appendChild(articleElement);
  });

 
}


export const affichageArticlesByAuteur = function(auteur) {
  const data = articles.getDataArticlesByAuteur(auteur);
  const html = document.querySelector('body');

  data.then(data => {
    let content = '';
    data.forEach(article => {
      content += `
        <li>
          <h2>${article.titre}</h2>
          <h3>écrit par ${article.auteur} et publié le ${article.date_creation}</h3>
        </li>
      `;
    });
    html.innerHTML += '<div class="articles"><ul>' + content + '</ul></div>';
  });

  return html;
} 


