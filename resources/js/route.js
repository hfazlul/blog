 import home from './components/home.vue';
 import addCategory from './components/category/add.vue';
 import categoryList from './components/category/list.vue';
 import editCategory from './components/category/edit';

 export const routes = [
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

  ] ;
