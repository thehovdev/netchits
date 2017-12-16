$(document).ready(function() {

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

});


Api = {

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
                $('.parent').html(data.html);
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
                $('.parent').html(data.html);
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




    // makeSignin : function(data) {
    //
    //     var status = data.status;
    //     var msg = data.msg;
    //
        // if(status == 0) {
        //     alert(msg);
        //     return false;
        // }
    //
    //     $('.mainPage').hide();
    //     $('.profilePage').show();
    //
    //     $('#header-username').text(data.email);
    // },
    //
    // makeSignup : function(data) {
    //
    //     var status = data.status;
    //     var msg = data.msg;
    //
    //     if(status == 0) {
    //         alert(msg);
    //         return false;
    //     }
    //
    //     $('.mainPage').hide();
    //     $('.profilePage').show();
    //
    //     $('#header-username').text(data.email);
    //
    // }

}
