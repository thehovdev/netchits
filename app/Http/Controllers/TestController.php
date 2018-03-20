<?php

namespace app\Http\Controllers;
use Illuminate\Http\Request;

//-------------------App Controllers---------------------//
use app\Http\Controllers\Api\Data\DataController;
//-------------------App Controllers---------------------//

//-------------------App Models---------------------//
use app\Models\Auth\UsersModel;
use app\Models\User\ChitsModel;
use app\Models\User\ChitsGroupModel;
use app\Models\Friends\FriendsModel;
//-------------------App Models---------------------//


class TestController extends Controller
{

        /*
        * SECTION Request : секция где получаем данные из запроса
        * SECTION Models : секция где объявляем модели
        * SECTİON Logics : секция с логикой приложения
        */

        // index
        public function homePage() {


            // SECTION : Models
            $usersModel = new UsersModel;
            $chitsModel = new ChitsModel;
            $chitsGroupModel = new ChitsGroupModel;
            $user = $usersModel->getUser();

            // SECTION : Logics

            // если пользователь не вошел
            // показываем статовую страницу авторизации
            if(is_null($user)) {
                return view("layouts.start");
            } else {

                // получаем группы пользователя
                $userGroups = $chitsGroupModel->getUserGroups($user);
                // получаем записки пользователя
                $userChits = $chitsModel->getUserChits($user);
                // берем друзей через laravel relations
                $friends = $user->friends->take(5);
                // берем подписчиков через laravel relations
                $followers = $user->followers->take(5);
                // берем случайное количество людей
                $peoples = $usersModel->getRandomPeoples();


                // показываем все пользователю
                return view("user.profile")
                    ->with("user", @$user)
                    ->with("peoples", @$peoples)
                    ->with("friends", @$friends)
                    ->with("followers", @$followers)
                    ->with("userChits", @$userChits)
                    ->with("userGroups", @$userGroups);
            }
        }


// ----------------------- Функции ----------------------- //

        /*
        * текст / модель - значит функция определена в модели
        * текст / контроллер - значит функция определена в контроллере
        */


        // добавить в друзья / контроллер
        public function addFriend(Request $request)
        {

            // SECTION : Models
            $friendsModel = new FriendsModel;
            $usersModel = new UsersModel;

            // SECTION : Requests
            // получаем username пользователя
            // которого хотим добавить в друзья
            $hashtag = $request->hashtag;

            // SECTION : Logics
            // получаем пользователя
            $user = $usersModel->getUser();

            // получаем друга
            $friend = $usersModel->getFriend($hashtag);

            // делаем так чтобы они подружились :)
            $addFriend = $friendsModel->add($user, $friend);

            return $addFriend;
        }
        // добавить в друзья / модель
        public function add($user, $friend)
        {
            // если пользователь решил сам себя добавить в друзья
            // возвращаем его обратно и не пускаем дальше
            if($user->id == $friend->id) {
                $result['status'] = 0;
                $result['msg'] = 'You Cannot follow yourself';
                return $result;
            }


            // проверяем если пользователь и друг уже друзья
            // если да то вернем обратно
            $is_friends = $this
            ->where('user_id', $user->id)
            ->where('friend_id', $friend->id)
            ->first();

            if(!is_null($is_friends)) {
                $result['status'] = 0;
                $result['msg'] = 'You Already Friends';
                return $result;
            }


            // дружим будующих друзей
            $this->user_id = $user->id;
            $this->friend_id = $friend->id;
            $this->save();

            $result['status'] = 1;
            $result['msg'] = 'success';
            return $result;
        }
        // удалить из друзей / контроллер
        public function deleteFriend(Request $request)
        {
            // SECTION : Models
            $friendsModel = new FriendsModel;
            $usersModel = new UsersModel;

            // SECTION : Requests
            $hashtag = $request->hashtag;

            // SECTION : Logics
            // получаем пользователя
            $user = $usersModel->getUser();
            // получаем друга
            $friend = $usersModel->getFriend($hashtag);

            // удаляем их связь
            $deleteFriend = $friendsModel->deleteFriend($user, $friend);

            // вовзращаем результат
            return $deleteFriend;
        }
        // получить текущего пользователя / модель
        public function getUser()
        {
            $email = @$_COOKIE['email'];
            $secret = @$_COOKIE['secret'];

            $user = $this
                ->where('email', $email)
                ->where('secret', $secret)
                ->first();

            return $user;
        }
        // получить друга / модель
        public function getFriend($hashtag)
        {
            $friend = $this
                ->where('hashtag', $hashtag)
                ->first();
            return $friend;
        }
        // копируем все записки с группы нпр. Плейлист -  другого пользователя
        public function copyFromGroup($user, $chits, $group)
        {
            // $user = текущий пользователь
            // $chits = массив с записками которые пользователь хочет скопировать
            // мы его получили вот так $group->chits->all() тк все записки из группы
            // $group = новая группа, которую api создает сам при клике,
            // скопировать группу у другого пользователя


            // заносим в новую группу записок пользователя
            // все записки из той группы которую он скопировал к себе
            foreach ($chits as $chit) {
                $insert = new ChitsModel;
                $insert->userid = $user->id;
                $insert->address = $chit->address;
                $insert->group_id = $group->id;
                $insert->opg_sitename = @$chit["opg_site_name"];
                $insert->opg_title = @$chit["opg_title"];
                $insert->opg_image = @$chit["opg_image"];
                $insert->save();
            }

            $result['status'] = 1;
            $result['msg'] = 'success';
            return $result;

        }



// -------------------- RELATIONS -------------------------- //



        // ------- Модель Записки -------- //

        // тут связываем таблицу Записок и таблицу Пользователей
        // у записки должен быть владелец
        public function user()
        {
            return $this->belongsTo('app\Models\Auth\UsersModel', 'userid');
        }

        // тут связываем таблицу Записок и Групп
        // у каждой записке может быть только 1 группа
        // поэтому hasOne иначе hasMany
        public function group()
        {
            return $this->hasOne('app\Models\User\ChitsGroupModel', 'id', 'group_id');
        }


        // -------- Модель Пользователи --------//

        // у пользователя может быть много записок
        public function chits()
        {
            return $this->hasMany('app\Models\User\ChitsModel', 'userid');
        }
        // у пользователя может быть много групп
        public function groups()
        {
            return $this->hasMany('app\Models\User\ChitsGroupModel', 'user_id');
        }
        // у пользователя может быть много друзей
        public function friends()
        {
            return $this->hasMany('app\Models\Friends\FriendsModel', 'user_id');
        }
        // у пользователя может быть много подписчиков
        public function followers()
        {
            return $this->hasMany('app\Models\Friends\FriendsModel', 'friend_id');
        }

        /*  благодаря relations мы можем получить легко
        *   например друзей пользователя или подписчиков
        *   $user = $usersModel->getUser();
        *
        *   все друзья пользователя
        *   $user->friends->all();
        *
        *   все подспичики пользователя
        *   $user->followers->all();
        */




}
