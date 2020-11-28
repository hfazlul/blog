export default {
    state: {
        catData: [],
        postData: [],
      },

      getters:{
          categories(state){
            return state.catData;

          },
          posts(state){
            return state.postData;

          }
      },

      actions: {
        getCategories(data){
          axios.get("getCategories").then((response)=>{
              data.commit("categories",response.data.categories);
          }).catch((error)=>{

          })
        },
        getPosts(data){
          axios.get("getPosts").then((response)=>{
              data.commit("posts",response.data.posts);
          }).catch((error)=>{

          })
        }
      },

       mutations: {
       categories(state,data){
         return state.catData = data;

       },
       posts(state,data){
         return state.postData = data;

       }
      },
};
