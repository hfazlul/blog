export default {
    state: {
        catData: []
      },
      
      getters:{
          categories(state){
            return state.catData;

          }
      },
     
      actions: {
        getCategories(data){
          axios.get("getCategories").then((response)=>{
              data.commit("categories",response.data.categories);
          }).catch((error)=>{
           
          })
        }
      },

       mutations: {
       categories(state,data){
         return state.catData = data;

       }
      },
};
