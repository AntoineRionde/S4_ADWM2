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

export default {
    getDataArticles: getDataArticles
}