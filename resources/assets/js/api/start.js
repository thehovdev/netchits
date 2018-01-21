Api = {

    prepare:function() {
        Api.boot();
        Api.timeout = 1;
    },

    boot:function() {


//--------------------Auth Header Buttons--------------------------//

    $('#signup-button').click(function() {
        Api.showSignup();
    });

    $('#signin-button').click(function() {
        Api.showSignin();
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


    $(document).on('click', 'iframe', function() {
        alert('test');
    });



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



    $("#chits-add-button").click(function () {
        Api.addChits();
    });

    $("#chits-group-button").click(function() {
        Api.addGroup();
    });




    $("#button-sidebar-add-chits").click(function() {
        Api.showAddChitsPanel();
    })

    $("#button-sidebar-add-groups").click(function() {
        Api.showGroupsPanel();
    })

    $("#button-sidebar-show-chits").click(function() {
        Api.showChitsPanel();
    })

    $("#button-sidebar-show-groups").click(function() {
        Api.showGroupsPanel();
    })

    $("#button-sidebar-show-friends").click(function() {
        Api.showFriendsPanel();
    })






    $('.button-update-profile').click(function() {
        Api.updateProfile();
    });

    $('.button-add-friend').click(function() {
        Api.addFriend();
    });

    $('.button-delete-friend').click(function() {
        Api.deleteFriend();
    });


    $('.button-upload-profile-image').click(function() {
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


},



//-------------------- User Evemts ----------------------------//

//-------------------- FUNCTIONS  ----------------------------//


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

    addChits : function () {
        var chitsAddress = $("#chits-address-input").val();
        var chitsGroupId = $('#select-group').children(':selected').attr('id');

        if(chitsAddress == "") {
            alert("address not be empty");
        }

        $.ajax({
          headers: Route.header,
          url: Route.addChits,
          data: {
            chitsAddress : chitsAddress,
            chitsGroupId : chitsGroupId,
            }
        }).done(function(data) {
            if(data.status == 1) {
                $('.chits-list').html(data.html);

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
                $('.chits-list').html(data.html);
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
                $('.chits-list').html(data.html);
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
          url: Route.deleteChitsGroup,
          data: {
            groupId: groupId,
            }
        }).done(function(data) {
            if(data.status == 1) {
                $('.chits-list').html(data.html);
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



    makeSignup : function() {

        userEmail = $('.signup-container #signup-email').val();
        userPassword = $('.signup-container #signup-password').val();
        userHashTag = $('.signup-container #signup-hashtag').val();

        $.ajax({
          headers: Route.header,
          url: Route.signUp,
          data: {
            userEmail: userEmail,
            userPassword: userPassword,
            userHashTag : userHashTag,
            }
        }).done(function(data) {
            if(data.status == 1) {
                window.location.replace("/");
            }
        });
    },

    makeSignin : function() {

        userEmail = $('.signin-container #signin-email').val();
        userPassword = $('.signin-container #signin-password').val();

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

    updateProfile : function() {
        var hashtag = $('.div-user-info #hashtag').val();
        // alert(hashtag);

        $.ajax({
          headers: Route.header,
          url: Route.updateProfile,
          data: {
            hashtag: hashtag,
            }
        }).done(function(data) {
            if(data.status == 1) {
                location.reload();
            }
        });
    },


    // Search Bar
    searchTimeout : function() {
        $('.search-result-row').hide();

        Api.timeout = setTimeout(function(){
             Api.searchBar();
         }, 3000);
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
            if(data.status == 1) {
                var image_path = '/storage/user-profile-images/';
                var image = image_path + data.image_id;

                $('.search-user-image').attr('src', image);
                $('.search-user-hashtag').text(data.hashtag);

                $('.search-result-row').show();
                // location.reload();
            }
        });
    },

    addFriend : function() {
        var hashtag = $('#search-user-hashtag').text();

        $.ajax({
          headers: Route.header,
          url: Route.addFriend,
          data: {
            hashtag: hashtag,
            }
        }).done(function(data) {
            alert(data.status);
        });

    },

    deleteFriend : function() {
        var hashtag = $('.div-user-info #hashtag').val();

        $.ajax({
          headers: Route.header,
          url: Route.deleteFriend,
          data: {
            hashtag: hashtag,
            }
        }).done(function(data) {
            alert(data.status);
            window.location.replace("/");
        });

    },



    showAddChitsPanel : function() {
        $('.chits-add-row').toggle();
    },

    showChitsPanel : function() {
        $('.chits-row').toggle();
    },

    showGroupsPanel : function() {
        $('.chits-add-group-row').toggle();
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
        $('.row-friends').toggle();
    },




    uploadProfileImage : function() {
        // var formData = new FormData(this.files[0]);
    },

}
