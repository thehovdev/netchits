// bootstrap
require('./includes/bootstrap');

//стартовый скрипт
require('./api/start');

//объект Ajax, тут хранятся ajax методы
require('./api/ajax.js');

//роуты приложения для javascript кода, как web.php для php кода
require('./api/routes.js');
