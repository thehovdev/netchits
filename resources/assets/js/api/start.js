Api = {

    prepare:function() {
        Api.boot();
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
        var id = $(this).closest('div').attr('id')
        Api.deleteChits(id);
    });

},

//-------------------- User Evemts ----------------------------//



// Api = {

    addChits : function () {
        var chitsAddress = $("#chits-address-input").val();
        if(chitsAddress == "") {
            alert("address not be empty");
        }

        $.ajax({
          headers: Route.header,
          url: Route.addChits,
          data: {
            chitsAddress: chitsAddress,
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
                alert(data.status);
                // $('.chits-list').html(data.html);
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

        $.ajax({
          headers: Route.header,
          url: Route.signUp,
          data: {
            userEmail: userEmail,
            userPassword: userPassword,
            }
        }).done(function(data) {
            if(data.status == 1) {
                // $('.parent').html(data.html);
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
                // $('.parent').html(data.html);
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
                // $('.parent').html(data.html);
                window.location.replace("/");
            }
        });
    },


}
