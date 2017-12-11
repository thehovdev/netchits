Ajax = {

    sendSignup : function() {

        userEmail = $('.signup-container #signup-email').val();
        userPassword = $('.signup-container #signup-password').val();

        $.ajax({
          headers: Route.header,
          url: Route.signUp,
          method: "GET",
          data: {
            userEmail: userEmail,
            userPassword: userPassword,
            }
        }).done(function(data) {

            Api.makeSignup(data);

        });
    },

    sendSignin : function() {

        userEmail = $('.signin-container #signin-email').val();
        userPassword = $('.signin-container #signin-password').val();

        $.ajax({
          headers: Route.header,
          url: Route.signIn,
          method: "GET",
          data: {
            userEmail: userEmail,
            userPassword: userPassword
            }
        }).done(function(data) {

            Api.makeSignin(data);

        });
    },
}
