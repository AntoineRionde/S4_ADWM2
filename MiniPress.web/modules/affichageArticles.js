import articles from './articles.js';
import categories from './categorie.js';
import { resetAffichage } from '../index.js';

export function affichageArticles(ascendant = true) {
  resetAffichage();
  const galleryContainer = document.createElement('ul');
  galleryContainer.id = 'listArticles';
  galleryContainer.innerHTML = '';
  let data = articles.getDataArticlesSortDateAsc();
  if(!ascendant){
    data = articles.getDataArticlesSortDateDesc();
  }

  data.then((dataArticles) => {
  
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
            galleryContainer.innerHTML="";
            galleryContainer.outerHTML="";
          });
        });
    });
  });
  let button = document.createElement('BUTTON');
  button.appendChild(document.createTextNode('Trier par date descendante'));
  button.addEventListener('click',function(){
    affichageArticles(false);
    galleryContainer.innerHTML="";
    galleryContainer.outerHTML="";
  });
  galleryContainer.appendChild(button);

  let buttonAsc = document.createElement('BUTTON');
  buttonAsc.appendChild(document.createTextNode('Trier par date ascendante'));
  buttonAsc.addEventListener('click',function(){
    affichageArticles();
    galleryContainer.innerHTML="";
    galleryContainer.outerHTML="";
  });
  galleryContainer.appendChild(buttonAsc);

  document.getElementById('articles').appendChild(galleryContainer);
}

export const affichageArticlesBycat_id = function (id) {
  resetAffichage();
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
  resetAffichage();
  const data = articles.getArticleDetail(id);
  const html = document.querySelector('articles');

  data.then(article => {
    const articleElement = document.createElement('div');
    articleElement.id='article';
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
  resetAffichage();
  const data = articles.getDataArticlesByAuteur(auteur);
  const html = document.getElementById('auteur');

  data.then(data => {
    let content = '<h2>Articles de ' + auteur + '</h2>';
    data.forEach(article => {
      content += `
        <li><h1
          <h2>${article.titre}</h2>
          <h3>écrit par ${article.auteur} et publié le ${article.date_creation}</h3>
        </li>
      `;
    });
    html.innerHTML = '<div class="articles"><ul>' + content + '</ul></div>';
  });
 
}

export const affichageArticlesByMotCle = function(mot, ascendant=false){
  resetAffichage();
  const galleryContainer = document.createElement('ul');
  galleryContainer.id = 'listArticles';
  galleryContainer.innerHTML = '';

  let data = articles.getDataArticlesSortDateAsc();
  if(!ascendant){
    data = articles.getDataArticles();
  }
  
  data.then(dataArticles => {
    return dataArticles.articles = dataArticles.articles.map(article => {
      return fetch(article.url.self.href)
        .then(response => response.json())
        .then(articleDetail => {
          if(articleDetail.article.titre.includes(mot)||articleDetail.article.resume.includes(mot)){
            return articleDetail;
          }
        }).then(article => {
          if(article != undefined){
            const titre = "Titre : " + article.article.titre + " ";
            const date = "Creation : " + article.article.date_creation + " ";
            const auteur = "Auteur : " + article.article.auteur + " ";

            const artTitreElement = document.createElement('art_titre');
            artTitreElement.textContent = titre;

            const artAuteurElement = document.createElement('art_auteur');
            artAuteurElement.textContent = auteur;

            artAuteurElement.addEventListener('click', function() {
              affichageArticlesByAuteur(article.article.auteur);
              galleryContainer.style.display = 'none';
            });

            const artCreaElement = document.createElement('art_crea');
            artCreaElement.textContent = date;

            const listItem = document.createElement('li');
            listItem.appendChild(artTitreElement);
            listItem.appendChild(artAuteurElement);
            listItem.appendChild(artCreaElement);
            galleryContainer.appendChild(listItem);
            
            artTitreElement.addEventListener('click', function() {
              affichageArticleDetail(article.article.id);
              galleryContainer.style.display = 'none';
            });
          }
      });
    });
  });
  let button = document.createElement('BUTTON');
  button.appendChild(document.createTextNode('Trier par date descendante'));
  button.addEventListener('click',function(){
    affichageArticlesByMotCle(mot);
    galleryContainer.innerHTML="";
  });
  galleryContainer.appendChild(button);

  let buttonAsc = document.createElement('BUTTON');
  buttonAsc.appendChild(document.createTextNode('Trier par date ascendante'));
  buttonAsc.addEventListener('click',function(){
    affichageArticlesByMotCle(mot, true);
    galleryContainer.innerHTML="";
  });
  galleryContainer.appendChild(buttonAsc);

  document.getElementById('articles').appendChild(galleryContainer);
}