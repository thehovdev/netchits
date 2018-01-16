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



//-------------------- User Evemts ----------------------------//
    $("#chits-add-button").click(function () {
        Api.addChits();
    });

    $("#chits-group-button").click(function() {
        Api.addGroup();
    });


    // (если элементы динамически обновляются на странице ) надо добавлять
    // $(document).on к началу события
    // делегирование

    $(document).on('click', '.chits-delete-button', function() {
        //находим id поста, который надо удалить
        var id = $(this).closest('div.chits-column-parent').attr('id')
        Api.deleteChits(id);
    });


    $(document).on('click', '.chits-group-delete-button', function() {
        //находим id поста, который надо удалить
        var id = $(this).closest('div.panel-group').attr('id');
        Api.deleteChitsGroup(id);
    });



    $('.button-update-profile').click(function() {
        Api.updateProfile();
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
        Api.timeout = setTimeout(function(){
             Api.searchBar();
         }, 3000);
    },

    searchTimeoutStop : function() {
        clearTimeout(Api.timeout);
    },

    searchBar : function() {
        var search = $('#input-navbar-search').val();
        // alert(search);
    },









    uploadProfileImage : function() {
        // var formData = new FormData(this.files[0]);
    },

}
