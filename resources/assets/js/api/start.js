Api = {

    prepare:function() {
        Api.boot();
        Api.setTitle();
        Api.timeout = 1;
        Api.ytimeout = 1;
        Api.searchList = ['Top songs', 'Top Hits', 'Rock n roll'];

    },

    boot:function() {


//--------------------Auth Header Buttons--------------------------//

    // $(window).load(function() {
    //     $("#chits-address-input").val("AC/DC");
    //     keyWordsearch();
    // });


    $('[data-toggle="tooltip"]').tooltip();

    $(window).on('load', function() {
        var search = Api.getRandomSearch();

        $("#chits-address-input").val(search);
        keyWordsearch();
    });


    $(window).resize(function(){
        Api.playerMoove();
    });


    $('.back-submit-button').click(function() {
        location.reload();
    });

    $('#signup-button').click(function() {
        Api.showSignup();
        $('.alpha-container .actions').hide();
    });

    $('#signin-button').click(function() {
        var option = $(this).data('option');
        if(option == 'noauth') {
            window.location.replace("/");
        }


        Api.showSignin();
        $('.alpha-container .actions').hide();

    });

    $('#signout-button').click(function() {
        Api.makeSignout();
    });
//--------------------Auth Header Buttons--------------------------//


//--------------------Auth Form Buttons----------------------------//
    $('#signin-submit-button').click(function() {
        Api.makeSignin();
    });

    $('#signup-submit-button').click(function() {
        Api.makeSignup();
    });

//-------------------Auth Form Buttons----------------------------//



//-------------------- User Events ----------------------------//





    // делегирование
    $(document).on('click', '.chits-delete-button', function() {
        //находим id поста, который надо удалить
        var id = $(this).closest('div.chits-column-parent').attr('id')
        Api.deleteChits(id);
    });


    $(document).on('click', '.chits-copy-button', function() {
        //находим id поста, который надо удалить
        var id = $(this).closest('div.chits-column-parent').attr('id')
        Api.copyChits(id);
    });


    $(document).on('click', '.chits-group-copy-button', function() {
        //находим id поста, который надо удалить
        var id = $(this).closest('div.panel-group').attr('id');
        Api.copyGroup(id);
    });


    $(document).on('click', '.chits-group-delete-button', function() {
        //находим id поста, который надо удалить
        var id = $(this).closest('div.panel-group').attr('id');
        Api.deleteChitsGroup(id);
    });

    $(document).on('click', '.btn-loveit', function() {
        var videoId = $(this).closest('div.search-item').attr('id');
        Api.addChits(videoId);
    });


    $("#chits-add-button").click(function () {
        Api.addChits();
    });

    $("#chits-group-button").click(function() {
        Api.addGroup();
    });

    $("#button-sidebar-add-chits").click(function() {
        // Api.showAddChitsPanel();
    })

    $("#button-sidebar-add-groups").click(function() {
        // Api.showGroupsPanel();
    })

    $("#button-sidebar-show-chits").click(function() {
        Api.showChitsPanel();
    })

    $("#button-sidebar-show-groups").click(function() {
        // Api.showGroupsPanel();
    })

    $(".button-sidebar-show-friends").click(function() {
        Api.showFriendsPanel();
    })

    $("#button-forgotpass").click(function() {
        Api.showForgotPass();
    })

    $("#button-resetpass").click(function() {
        Api.makeResetPass();
    })

    $("#button-sendcode").click(function() {
        Api.sendResetCode();
    })

    $('.button-update-profile').click(function() {
        Api.updateProfile();
    });

    $('.button-add-friend').click(function() {
        var option = $(this).data('option');
        Api.addFriend(option);
    });

    $('.button-delete-friend').click(function() {
        Api.deleteFriend();
    });

    // $('.button-upload-profile-image').click(function() {
    //     $('#input-upload-profile-image').click();
    // });

    $('.btn-upload-img').click(function() {
        $('#input-upload-profile-image').click();
    });



    $('#input-upload-profile-image').change(function(e) {

                var formData = new FormData($("form[name='uploader']")[0]);

                // alert($("form[name='uploader'").attr('id'));

                $.ajax({
                    headers: Route.header,
                    url: Route.uploadProfileImage,
                    type: "POST",
                    data: formData,
                    async: false,
                    cache: false,
                    contentType: false,
                    processData: false
                }).done(function(data) {
                    // alert(data.msg);
                    location.reload();

                });

            e.preventDefault();
    });

    $("#input-navbar-search").keyup(function(){
        Api.searchTimeoutStop();
        Api.searchTimeout();
    });

    $("#chits-address-input").keyup(function() {

        var search = $(this).val();

        if ((search.indexOf('http://') != -1) || (search.indexOf('https://') != -1)) {
            $('.bar-add-text').show();
            $('.bar-search-text').hide();

            $('.button-add-chits').prop('disabled', false);
            $('.button-add-chits').addClass('button-add-chits-color');
            $('.button-add-chits').removeClass('button-add-chits-search-color');
        } else {
            $('.bar-search-text').show();
            $('.bar-add-text').hide();

            $('.button-add-chits').prop('disabled', true);
            $('.button-add-chits').removeClass('button-add-chits-color');
            $('.button-add-chits').addClass('button-add-chits-search-color');
        }



        Api.ysearchTimeoutStop();
        Api.ysearchTimeout();
    });

    // отлавливаем нажатие enter
    // update info
    $('.enter-handle#hashtag').keydown(function(e){
        //если нажали Enter
      if (e.keyCode == 13) {
          $('.button-update-profile').click();
      }
    });


    // signin
    $('.enter-handle#signin-email').keydown(function(e){
        //если нажали Enter
      if (e.keyCode == 13) {
          $(".enter-handle#signin-password").focus();
      }
    });
    $('.enter-handle#signin-password').keydown(function(e){
        //если нажали Enter
      if (e.keyCode == 13) {
          $('#signin-submit-button').click();
      }
    });

    // signup
    $('.enter-handle#signup-email').keydown(function(e){
        //если нажали Enter
      if (e.keyCode == 13) {
          $(".enter-handle#signup-hashtag").focus();
      }
    });
    $('.enter-handle#signup-hashtag').keydown(function(e){
        //если нажали Enter
      if (e.keyCode == 13) {
          $(".enter-handle#signup-password").focus();
      }
    });
    $('.enter-handle#signup-password').keydown(function(e){
        //если нажали Enter
      if (e.keyCode == 13) {
          $("#signup-submit-button").click();
      }
    });


    // отлавливаем нажатие enter

},



//-------------------- User Evemts ----------------------------//

//-------------------- FUNCTIONS  ----------------------------//


    getRandomSearch : function() {
        var search = Api.searchList[Math.floor(Math.random() * Api.searchList.length)];

        return search;

    },

    copyGroup : function (groupId) {
        if(groupId == "") {
            alert("group id not be empty");
        }
        var hashtag = $('input#hashtag').val();


        $.ajax({
          headers: Route.header,
          url: Route.copyGroup,
          data: {
            groupId : groupId,
            hashtag : hashtag
            }
        }).done(function(data) {
            if(data.status == 1) {
                alert(data.msg);
            }
        });

    },

    copyChits : function (chitId) {

        if(chitId == "") {
            alert("chit id not be empty");
        }
        $.ajax({
          headers: Route.header,
          url: Route.copyChits,
          data: {
            chitId : chitId,
            }
        }).done(function(data) {
            if(data.status == 1) {
                alert(data.msg);
            }
        });


    },

    hideFromList: function (data) {
        var list = $('.chits-list').find('#group-id-' + data.chit.group_id + '-list');
        // текущее проигрываемое видео
        var playlist = $('.playlist').val();
        // видео в удаляемом блоке
        var listvideId = $('.chits-column-parent#' + data.chit.id).find('.playerblock').data('video');

        $(list).find('.chits-column-parent#' + data.chit.id).remove();

        if(playlist == listvideId) {
            $("#player").hide();
            player.stopVideo();
        }

        Api.playerMoove();
    },

    hideFromListGroup: function (data) {
        var groupList = $('.chits-list').find('#group-id-' + data.group.id + '-list');
        var group = $('.chits-list').find('#group-id-' + data.group.id);

        // текущее проигрываемое видео
        var playlist = $('.playlist').val();
        // видео в удаляемом блоке
        var listvideId = $(groupList).find('.playerblock#player-id-' + playlist).data('video');



        if(playlist == listvideId) {
            $("#player").hide();
            player.stopVideo();
        }

        $(groupList).remove();
        $(group).remove();

        Api.playerMoove();

    },

    addToList : function (data) {

        var list = $('.chits-list').find('#group-id-' + data.chit.group_id + '-list');

        console.info(list);

        $(data.html).prependTo(list);


        Api.playerMoove();
    },

    addToListGroup : function (data) {
        var list = $('.chits-list');

        console.info(list);

        $(data.html).appendTo(list);
    },

    addChits : function (searchdataid = '0') {

        //
        if(searchdataid != '0') {
            var chitsAddress = 'https://www.youtube.com/watch?v=' + searchdataid;
        } else {
            var chitsAddress = $("#chits-address-input").val();
        }


        var chitsGroupId = $('#select-group').children(':selected').attr('id');
        if(chitsAddress == "") {
            alert("address not be empty");
        }

        $('.search-progress-bar').css('visibility', 'visible');


        $.ajax({
          headers: Route.header,
          url: Route.addChits,
          data: {
            chitsAddress : chitsAddress,
            chitsGroupId : chitsGroupId,
            }
        }).done(function(data) {
            $('.search-progress-bar').css('visibility', 'hidden');

            if(data.status == 1) {
                Api.addToList(data);
            }
        });

        return false;
    },

    addGroup : function () {
        var chitsGroup = $("#chits-group-input").val();
        if(chitsGroup == "") {
            alert("group name not be empty");
        }


        // alert(chitsGroup);

        $.ajax({
          headers: Route.header,
          url: Route.addGroup,
          data: {
            chitsGroup: chitsGroup,
            }
        }).done(function(data) {
            if(data.status == 1) {
                // location.reload();
                Api.addToListGroup(data);

                // $('.chits-list').html(data.html);
                $('.chitsgroup-select-column').html(data.html_chitsgroup_select);
            }
        });

        return false;
    },

    deleteChits : function(chitsId) {

        if(chitsId == "") {
            alert("deleted item not be empty");
        }


        $.ajax({
          headers: Route.header,
          url: Route.deleteChits,
          data: {
            chitsId: chitsId,
            }
        }).done(function(data) {
            if(data.status == 1) {
                Api.hideFromList(data);
            }
        });
        return false;
    },

    deleteChitsGroup : function(groupId) {

        if(groupId == "") {
            alert("deleted item not be empty");
        }

        $.ajax({
          headers: Route.header,
          url: Route.deleteGroup,
          data: {
            groupId: groupId,
            }
        }).done(function(data) {
            if(data.status == 1) {
                Api.hideFromListGroup(data);
                // $('.chits-list').html(data.html);
            }
        });
        return false;


    },


    showSignin : function() {
        $('.signup-container').hide();
        $('.signin-container').show();
    },

    showSignup : function() {
        $('.signin-container').hide();
        $('.signup-container').show();
    },

    showForgotPass : function() {
        $('.signin-container').hide();
        $("#button-sendcode").show();
        $('.forgotpass-container').show();
    },


    makeSignup : function(option) {

        userEmail = $('.signup-container #signup-email').val();
        userPassword = $('.signup-container #signup-password').val();
        userHashTag = $('.signup-container #signup-hashtag').val();
        userAge = $('#age').is(":checked");
        if(userAge === true) {
            userAge == 'true';
            $('.alert-signup-error').hide();
        } else {
            userAge == 'false';
            $('.alert-signup-error').show();
            $('.alert-signup-error').text('Sorry! Netchits available only for 18 years old');
            return false;
        }


        $.ajax({
          headers: Route.header,
          url: Route.signUp,
          data: {
            userEmail: userEmail,
            userPassword: userPassword,
            userHashTag : userHashTag,
            userAge : userAge,
            }
        }).done(function(data) {
            if(data.status == 1) {
                window.location.replace("/");
            } else {
                $('.alert-signup-error').show();
                $('.alert-signup-error').text(data.msg);
            }
        });
    },

    makeSignin : function() {

        userEmail = $('.signin-container #signin-email').val();
        userPassword = $('.signin-container #signin-password').val();
        $('.alert-password-incorrect').hide();

        $.ajax({
          headers: Route.header,
          url: Route.signIn,
          data: {
            userEmail: userEmail,
            userPassword: userPassword
            }
        }).done(function(data) {
            if(data.status == 1) {
                window.location.replace("/");
            } else {
                $('.alert-password-incorrect').show();
            }
        });
    },

    makeSignout : function() {

        $.ajax({
          headers: Route.header,
          url: Route.signOut,
        }).done(function(data) {
            if(data.status == 1) {
                window.location.replace("/");
            }
        });
    },

    sendResetCode : function() {
        userEmail = $('#forgotpass-email').val();
        $("#button-sendcode").prop('disabled', true);


        $.ajax({
          headers: Route.header,
          url: Route.sendResetCode,
          data: {
            userEmail: userEmail,
            }
        }).done(function(data) {
            if(data.status == 1) {

                $('.form-resetpass').show();
                $("#button-resetpass").show()
                $("#button-sendcode").hide();

            }
        });

    },



    makeResetPass : function() {
        var userEmail = $('#forgotpass-email').val();
        var code = $("#forgotpass-code").val();
        var newpass = $("#forgotpass-newpass").val();
        var repass = $("#forgotpass-repass").val();


        $.ajax({
          headers: Route.header,
          url: Route.resetPass,
          data: {
            userEmail: userEmail,
            code: code,
            newpass : newpass,
            repass : repass,
            }
        }).done(function(data) {
            if(data.status == 1) {
                $('.resetpass-error').hide();
                $('.resetpass-success').show();
                setTimeout(function(){
                    location.reload();
                }, 2000);
            } else {
                $('.resetpass-error').show();
                $('.resetpass-error').text(data.msg);

            }
        });


    },


    updateProfile : function() {
        var hashtag = $('.div-user-info #hashtag').val();
        var confirmcode = $("#confirmcode").val();
        // alert(hashtag);

        $('.alert-hashtag').hide();


        $.ajax({
          headers: Route.header,
          url: Route.updateProfile,
          data: {
            hashtag: hashtag,
            confirmcode: confirmcode,
            }
        }).done(function(data) {
            if(data.status == 1) {
                location.reload();
            } else {
                $('.alert-hashtag').show();
            }
        });
    },


    // Search Bar

    ysearchTimeout : function() {
        $('.search-progress-bar').css('visibility', 'visible');

        Api.ytimeout = setTimeout(function(){
            keyWordsearch();
         }, 2000);
    },

    ysearchTimeoutStop : function() {
        clearTimeout(Api.ytimeout);
    },

    searchTimeout : function() {
        $('.search-result-row').css('visibility', 'hidden');
        $('.search-progress-bar').css('visibility', 'visible');

        Api.timeout = setTimeout(function(){
             Api.searchBar();
         }, 2000);
    },

    searchTimeoutStop : function() {
        clearTimeout(Api.timeout);
    },

    searchBar : function() {
        var search = $('#input-navbar-search').val();

        $.ajax({
          headers: Route.header,
          url: Route.search,
          data: {
            search: search,
            }
        }).done(function(data) {
            $('.search-progress-bar').css('visibility', 'hidden');

            if(data.status == 2) {
                window.location.replace("/");
            }

            if(data.status == 1) {
                var image_path = '/storage/user-profile-images/';
                var image = image_path + data.image_id;

                $('.search-user-image').attr('src', image);
                $('.search-user-href').attr('href', '/user/' + data.id);
                $('.search-user-hashtag').text(data.hashtag);
                $('.search-result-row').css('visibility', 'visible');

                if(data.is_friends == 1) {
                    $('.search-follow-text').hide();
                    $('.search-followed-text').show();
                    $('.button-add-friend').addClass('button-is-friends');
                    $('.button-add-friend').removeClass('button-add-friend');
                    $('.button-is-friends').prop('disabled', true);
                } else {
                    $('.search-followed-text').hide();
                    $('.search-follow-text').show();
                    $('.button-is-friends').addClass('button-add-friend');
                    $('.button-is-friends').removeClass('button-is-friends');
                    $('.button-is-friends').prop('disabled', false);

                }

                // location.reload();
            }
        });
    },

    addFriend : function(option) {


        if(option == 'main') {
            var hashtag = $('#search-user-hashtag').text();
        }
        else if(option == 'noauth') {
            window.location.replace("/");
        }
        else {
            var hashtag = $('#hashtag').text();
        }


        $('.button-add-friend').removeClass('button-friend-added');



        $.ajax({
          headers: Route.header,
          url: Route.addFriend,
          data: {
            hashtag: hashtag,
            }
        }).done(function(data) {
            $('.button-add-friend').prop('disabled', true);
            $('.button-add-friend').addClass('button-friend-added');
        });

    },

    deleteFriend : function() {
        var hashtag = $('.div-user-info #hashtag').text();

        $.ajax({
          headers: Route.header,
          url: Route.deleteFriend,
          data: {
            hashtag: hashtag,
            }
        }).done(function(data) {
            // alert(data.status);
            window.location.replace("/");
        });

    },



    showAddChitsPanel : function() {
        $('.chits-list').toggle();
        $('.chits-add-row').toggle();
    },

    showGroupsPanel : function() {
        $('.chits-list').toggle();
        $('.chits-add-group-row').toggle();
    },

    showChitsPanel : function() {
        $('.row-friends').hide();

        $('.chits-row').show();
        $('.row.chits-list').show();
        $('.row.chits-add-row').show();
        $('.row.chits-add-group-row').show();
        $('.chits-search-result').show();
        $('.row-people-list').show();


        Api.playerMoove();
    },

    showFriendsPanel : function() {
        var loadStage = $('.row-friends').data('load');

        if(loadStage == 0) {
            $.ajax({
              headers: Route.header,
              url: Route.showFriends,
            }).done(function(data) {
                if(data.status == 1) {
                    $('.friends-list').html(data.html);
                    $('.row-friends').data('load', '1');
                }
            });
        }
        $('.row-friends').show();
        $('.row.chits-list').hide();
        $('.row.chits-add-row').hide();
        $('.row.chits-add-group-row').hide();
        $('.row.chits-row').hide();
        $('.chits-search-result').hide();
        $('.row-people-list').hide();


    },

    uploadProfileImage : function() {
        // var formData = new FormData(this.files[0]);
    },

    setTitle : function() {
        var title = $('#hiddentitle').val();
        if(title) {
            document.title = title;
        } else {
            document.title = 'NetChits';
        }
    },

    playerMoove : function() {
        // var videoId = $('.playlist').val();
        // var position = $('.chit-code-' + videoId).position();
        // var deviceWidth = $(window).width();
        //
        // $("#player").css({
        //     "position": "absolute",
        //     "top" : position.top + 23,
        //     "left" : position.left + 6,
        //     "z-index" : "9",
        // });


        var videoId = $('.playlist').val();
        var position = $('.chit-code-' + videoId).position();
        var deviceWidth = $(window).width();




        switch (true) {

            case (deviceWidth < 400 && deviceWidth > 300):
                $("#player").css({
                    "position": "absolute",
                    "top" : position.top + 53,
                    "left" : position.left + 84,
                    "z-index" : "9",
                });
                break;

            case (deviceWidth < 400):
                $("#player").css({
                    "position": "absolute",
                    "top" : position.top + 53,
                    "left" : position.left + 24,
                    "z-index" : "9",
                });
                break;

            default :
                $("#player").css({
                    "position": "absolute",
                    "top" : position.top + 23,
                    "left" : position.left + 6,
                    "z-index" : "9",
                });
                break;

        }









        // if(deviceWidth < 400) {
        //     $("#player").css({
        //         "position": "absolute",
        //         "top" : position.top + 53,
        //         "left" : position.left + 24,
        //         "z-index" : "9",
        //     });
        // } else {
        //     $("#player").css({
        //         "position": "absolute",
        //         "top" : position.top + 23,
        //         "left" : position.left + 6,
        //         "z-index" : "9",
        //     });
        // }





    }

}
