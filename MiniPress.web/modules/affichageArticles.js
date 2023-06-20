import articles from './articles.js';
import categories from './categorie.js';

export function affichageArticles(ascendant = false) {
  const galleryContainer = document.createElement('ul');
  galleryContainer.id = 'articles';
  galleryContainer.innerHTML = '';
  let data = articles.getDataArticles();

  if(ascendant){
    data = articles.getDataArticlesSortDateAsc();
  }

  data.then((dataArticles) => {
    // Tri des articles par date de création dans l'ordre chronologique décroissant
    dataArticles.articles.sort(function(a, b) {
      if(!ascendant){
        return new Date(a.date_creation) - new Date(b.date_creation);
      }else{
        return new Date(b.date_creation) - new Date(a.date_creation);
      }
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
        galleryContainer.style.display = 'none';
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
            galleryContainer.style.display = 'none';
          });
        });
    });
  });

  document.body.appendChild(galleryContainer);
}

export const affichageArticlesBycat_id = function (id) {
  const data = articles.getDataArticlesBycat_id(id);
  const html = document.getElementById('articles');

  data.then(data => {
    let content = '';
    data.forEach(article => {
      content += `
        <li>
          <h2>${article.titre}</h2>
          <h3>écrit par ${article.auteur} et publié le ${article.date_publication}</h3>
          <p>${article.resume}</p>
        </li>
      `;
    });
    html.innerHTML = `<ul>${content}</ul>`;

    const selectedCategory = document.getElementById('selectedCategory');
    html.insertAdjacentElement('beforebegin', selectedCategory);
  });
};


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

export const affichageArticlesByMotCle = function(mot){
  const galleryContainer = document.getElementById('articles');
  galleryContainer.innerHTML = '';

  const data = articles.getDataArticles();
  return data.then(dataArticles => {

    dataArticles.articles = dataArticles.articles.map(article => {
      return fetch(article.url.self.href)
        .then(response => response.json())
        .then(articleDetail => {
          if(articleDetail.article.titre.includes(mot)||articleDetail.article.resume.includes(mot)){
            return articleDetail;
          }
        }).then(article => {
          if(article != undefined){
            console.log(article.article);
            const titre = "Titre : " + article.article.titre + " ";
            const date = "Creation : " + article.article.date_creation + " ";
            const auteur = "Auteur : " + article.article.auteur + " ";

            const artTitreElement = document.createElement('art_titre');
            artTitreElement.textContent = titre;

            artTitreElement.addEventListener('click', function() {
              affichageArticleDetail(article.article.id);
            });

            galleryContainer.appendChild(artTitreElement);

            const artAuteurElement = document.createElement('art_auteur');
            artAuteurElement.textContent = auteur;

            artAuteurElement.addEventListener('click', function() {
              affichageArticlesByAuteur(article.article.auteur);
            }); 5

            galleryContainer.appendChild(artAuteurElement);

            const artCreaElement = document.createElement('art_crea');
            artCreaElement.textContent = date;
            galleryContainer.appendChild(artCreaElement);
          }
        });
    });
  });
  
}
