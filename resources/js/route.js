 import home from './components/home.vue';
 import addCategory from './components/category/add';
 import categoryList from './components/category/list';
 import editCategory from './components/category/edit';
   //  for Post
 import postList from './components/post/list';
 import postAdd from './components/post/add';
 import postEdit from './components/post/edit';
  //  for Post
 export const routes = [
    //  for category
    {
      path: '/home',
      component: home
    },

    {
      path: '/addCategory',
      component: addCategory
    },

    {
      path: '/categoryList',
      component: categoryList
    },
    {
      path: '/edit-category/:slug',
      component: editCategory
    },
     //  for category

     //  for Post

     {
        path: '/postList',
        component: postList
      },
     {
        path: '/postAdd',
        component: postAdd
      },
      {
        path: '/postEdit/:slug',
        component: postEdit
      },
      //  for Post

  ] ;
