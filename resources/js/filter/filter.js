import Vue from 'vue';
import moment from 'moment';

  Vue.filter('time', (a)=>{
    return moment(a).format('MMM Do YYYY');
  });
  Vue.filter('subString', (content, length)=>{
    return content.substring(0,length);
  });
