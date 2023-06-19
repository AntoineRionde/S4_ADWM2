import { apiMiniPress } from "./config";

const getDataCategories = async() => {
    try{
        let resp= await fetch(`${apiMiniPress}categories`);
        if(resp.ok){
            console.log((await resp).ok);
            return await resp.json();
        }
    }catch(err){
    }
}

export default {
    getDataCategories: getDataCategories
}