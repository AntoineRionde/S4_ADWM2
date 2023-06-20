import articles from './articles.js';
import categories from './categorie.js';

export function affichageArticles(ascendant = false) {
  const galleryContainer = document.getElementById('articles');
  galleryContainer.innerHTML = '';

  const data = articles.getDataArticles();

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
      
      fetch(article.url.self.href) 
      .then(response => response.json())
      .then(articleDetail => {

        artTitreElement.addEventListener('click', function() {
          affichageArticleDetail(articleDetail.article.id);
        });

      });



      galleryContainer.appendChild(artTitreElement);

      const artAuteurElement = document.createElement('art_auteur');
      artAuteurElement.textContent = auteur;

      artAuteurElement.addEventListener('click', function() {
        affichageArticlesByAuteur(article.auteur);
      }); 5

      galleryContainer.appendChild(artAuteurElement);

      const artCreaElement = document.createElement('art_crea');
      artCreaElement.textContent = date;
      galleryContainer.appendChild(artCreaElement);

      if (index !== dataArticles.articles.length - 1) {
        const separatorDiv = document.createElement('div');
        separatorDiv.classList.add('articles_separateur');
        galleryContainer.appendChild(separatorDiv);
      }      
    });
  });
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

  return html;
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
