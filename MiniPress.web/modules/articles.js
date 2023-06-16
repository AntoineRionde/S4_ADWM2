import { apiMiniPress } from './config.js';

export function getDataArticles() {
  return new Promise(async (resolve, reject) => {
    try {
      const articles = await fetch(`${apiMiniPress}articles`, { credentials: 'include' });
      if (articles.ok) {
        const dataArticles = await articles.json();
        resolve(dataArticles);
      } else {
        reject(new Error('Aucun article disponible'));
      }
    } catch (error) {
      reject(error);
    }
  });
}
