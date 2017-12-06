require('./includes/bootstrap');

//роуты приложения для javascript кода, как web.php для php кода
require('./api/routes.js');

//объект Ajax, тут хранятся ajax методы
require('./api/ajax.js');

//стартовый скрипт
require('./api/start');


// window.Vue = require('vue');
//
// Vue.component('example-component', require('./components/ExampleComponent.vue'));
//
// const app = new Vue({
//     el: '#app'
// });
