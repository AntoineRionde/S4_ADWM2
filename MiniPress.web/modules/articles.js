import {apiMiniPress} from "./config.js";

const getDataArticles = async () => {
  try {
    let resp = await fetch(`${apiMiniPress}articles`);
    if (resp.ok) {
      return await resp.json();
    }
  } catch (err) {
    console.log(err);
  }
}

const getDataArticlesByIdCateg = async (id) => {
  const data = getDataArticles(); 

  return data.then(data => {
    const promises = data.articles.map(element => {
      return fetch(element.url.self.href)
      .then(response => response.json())
      .then(articleDetail => {
        if(articleDetail.article.idCateg == id){
          return articleDetail.article;
        }
      });
    });

    return Promise.all(promises).then(articlesList => {
      return articlesList.filter(article => article != undefined);
    });
  });
}

export default {
    getDataArticles: getDataArticles,
    getDataArticlesByIdCateg: getDataArticlesByIdCateg
}